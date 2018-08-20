 filebeat常见配置整理  https://blog.csdn.net/xuguokun1986/article/details/73560195

filebeat安装部署 https://www.cnblogs.com/yangxiaoyi/p/7240205.html

Filebeat 的注意事项 https://www.jianshu.com/p/d53e80e3b0bd

```
Inode 复用造成数据采集缺失
在 Linux 文件系统上，Filebeat 使用 inode 和 device 来标识文件。当文件从磁盘中删除时，可以将 inode 分配给一个新文件。在涉及文件轮换的用例中，如果旧文件被删除，并且之后立即创建新文件，则新文件可以具有与被移除的文件完全相同的 inode。在这种情况下，Filebeat 假定新文件与旧文件相同，并尝试在旧 offset 继续读取，这是不正确的。

默认情况下，永远不会从 registry_file 中删除。要解决 inode 复用问题，建议使用 clean_ * 选项，特别是 clean_inactive，以删除非活动文件的状态。例如，如果文件每 24 小时轮换一次，并且轮转的文件不再更新，可以将ignore_older 设置为48小时，将 clean_inactive 设置为72小时。

对于从磁盘中删除的文件，可以使用 clean_removed 。请注意，每当在扫描期间找不到文件时，clean_removed 会从 registry_file 清除文件状态。如果文件稍后再次显示，则将从头重新发送。
```

https://gocn.vip/question/1421



配置Filebeat https://my.oschina.net/ch66880/blog/1619567