## TiDB初步调研与实践报告

按着官方文档玩了一遍，对TiDB有了基本认识。一开始的目标是能整理出一套数据迁移和节点伸缩的方案，但看完文档，官方都已经总结好了，剩下的就是摸索和实践。

先介绍下基本信息。

### 基本信息

TiDB由三个模块组成：TiDB、PD和TiKV。

简单来说，TiDB负责计算，接收sql 请求处理；TiKV负责存储数据；PD就是它们的桥梁，调度它们，比如TiDB想知道某个 Key 存储在哪个 TiKV 节点 ，让PD告诉它。

所以，对TiDB的运维就是对这三个模块的运维，TiDB 集群就是它们各自集群的综合。

![](https://pingcap.com/images/docs-cn/tidb-architecture.png)



作为一种数据库，无论什么架构都是服务于存储的，所以重点关注它的存储。TiDB主打分布式存储，它的核心算法实现就是家喻户晓的Raft一致性算法，目前etcd的分布式也是基于Raft算法，简单概括就是领导者选举，跟随者同步的算法。



#### 存储

TiKV 利用 Raft 来做数据复制，**每个数据变更都会落地为一条 Raft 日志，通过 Raft 的日志复制功能，将数据安全可靠地同步到 Group 的多数节点中。** 

![](https://pingcap.com/images/blog-cn/raft-rocksdb.png)



TiKV 是以 Region 为单位做数据的复制，也就是一个 Region 的数据会保存多个副本，我们将每一个副本叫做一个 Replica。Repica 之间是通过 Raft 来保持数据的一致，一个 Region 的多个 Replica 会保存在不同的节点上，构成一个 Raft Group。其中一个 Replica 会作为这个 Group 的 Leader，其他的 Replica 作为 Follower。所有的读和写都是通过 Leader 进行，再由 Leader 复制给 Follower。  

![](https://pingcap.com/images/blog-cn/raft-region.png)



看了文档，除了存储部分，比较难搞的是TIDB的调度机制，也就是PD模块。之后的运维工作目测大部分都是集中在PD Control（PD 的命令行工具，用于获取集群状态信息和调整集群），所以这里不展开，日后再单独整理一遍文档。

## 数据迁移

TIDB的数据迁移，按照官方提供了几个工具完成，暂时没踩到什么坑。

#### 背景

- 第一种场景：只全量导入历史数据 （需要 checker + mydumper + loader）；
- 第二种场景：全量导入历史数据后，通过增量的方式同步新的数据 （需要 checker + mydumper + loader + syncer）。该场景需要提前开启 binlog 且格式必须为 ROW。

| Name  | Address   | Port | User | Password |
| ----- | --------- | ---- | ---- | -------- |
| MySQL | 127.0.0.1 | 3306 | root | *        |
| TiDB  | 127.0.0.1 | 4000 | root | *        |



#### 流程分为5步

0.开启 binlog

1.checker 检查 schema 能否被 TiDB 兼容

2.mydumper 从 MySQL 导出数据

3.loader 导入数据到 TiDB

4.syncer 增量同步 MySQL 数据到 TiDB



测试了3种情况

1.单表 mb_meta_index 

2.10个分表（mb_meta_tag_relation0_9）

3.往mb_meta_index里面新加一条记录，看TIDB有没有同步过来



结果都正确。



## 节点伸缩（暂时实践失败）

我的计划是按照扩容缩容，查看数据分布情况。用的是官方提供的docker-compose单机部署方案。

折腾了许久，老是加不进去一个节点...原因是docker的pd网络在外面连接不到。试了很多次，觉得后面也不会是单机部署，暂时放弃。等到多机时再尝试。

而且还有个问题是查看节点存储空间的语句，不能正常运行。这个也要战略性等到多机时看看。









### ps：

1）TiDB兼容mysql协议，所以代码里操作TIDB也像操作mysql一样，接口一致。但有些复杂的DDL语句，例如join有点性能问题，我还没时间测试。

2）TiDB还提供了TiDB-Binlog去做数据备份，在集群故障时有用。

TiDB-Binlog 支持以下功能场景:

- *数据同步*: 同步 TiDB 集群数据到其他数据库
- *实时备份和恢复*: 备份 TiDB 集群数据，同时可以用于 TiDB 集群故障时恢复

