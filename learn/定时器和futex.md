### GO的for循环的坑

执行后发现，什么？居然break不出去？后来查了一下资料发现，当for 和 select结合使用时，break语言是无法跳出for之外的，因此若要break出来，这里需要加一个标签，使用goto， 或者break 到具体的位置 

### GO的定时器是堆，协程一多，锁操作就多。而且堆的操作是logn

http://xiaorui.cc/2018/03/28/%E5%88%86%E6%9E%90golang%E5%AE%9A%E6%97%B6%E5%99%A8cpu%E4%BD%BF%E7%94%A8%E7%8E%87%E9%AB%98%E7%9A%84%E7%8E%B0%E8%B1%A1/

定时器为什么会产生锁？ 定时器不外乎就那几个方法，小顶堆呀，红黑树呀…. golang使用堆来构建全局定时器，既然是堆，那么肯定就要有锁，开了几百个协程，如果有N个P，那么几百个协程会分派在不同的P上。 协程需要跑在线程上，那么这么多的线程去操作heap堆，自然就会有更多的锁冲突，锁操作了。 

## Kafka解惑之时间轮（TimingWheel）

https://juejin.im/entry/5b1618535188257d5902fb03

![](https://user-gold-cdn.xitu.io/2018/6/5/163ce4f199ed0e9a?imageView2/0/w/1280/h/960/format/webp/ignore-error/1)

Kafka中的TimingWheel专门用来执行插入和删除TimerTaskEntry的操作，而DelayQueue专门负责时间推进的任务。 

时间轮由多个时间格组成，每个时间格代表当前时间轮的基本时间跨度（tickMs）。时间轮的时间格个数是固定的，可用wheelSize来表示，那么整个时间轮的总体时间跨度（interval）可以通过公式 tickMs × wheelSize计算得出。时间轮还有一个表盘指针（currentTime），用来表示时间轮当前所处的时间，currentTime是tickMs的整数倍。c**urrentTime可以将整个时间轮划分为到期部分和未到期部分，currentTime当前指向的时间格也属于到期部分，表示刚好到期，需要处理此时间格所对应的TimerTaskList的所有任务。** 



如果此时有个定时为350ms的任务该如何处理？直接扩充wheelSize的大小么？Kafka中不乏几万甚至几十万毫秒的定时任务，这个wheelSize的扩充没有底线，就算将所有的定时任务的到期时间都设定一个上限，比如100万毫秒，那么这个wheelSize为100万毫秒的时间轮不仅占用很大的内存空间，而且效率也会拉低。**Kafka为此引入了层级时间轮的概念，当任务的到期时间超过了当前时间轮所表示的时间范围时，就会尝试添加到上层时间轮中。** 

![](https://user-gold-cdn.xitu.io/2018/6/5/163ce4f199d2dd8a?imageView2/0/w/1280/h/960/format/webp/ignore-error/1)

参考上图，复用之前的案例，第一层的时间轮tickMs=1ms, wheelSize=20, interval=20ms。第二层的时间轮的tickMs为第一层时间轮的interval，即为20ms。每一层时间轮的wheelSize是固定的，都是20，那么第二层的时间轮的总体时间跨度interval为400ms。以此类推，这个400ms也是第三层的tickMs的大小，第三层的时间轮的总体时间跨度为8000ms。 