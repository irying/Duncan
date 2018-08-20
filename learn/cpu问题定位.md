https://www.jianshu.com/p/0aa4f69029e9

https://www.cnblogs.com/bonelee/p/6800437.html

### 1.sar -u 查看一天内的cpu使用率(确认是否符合报警描述)

Linux 2.6.32-504.30.3.el6.x86_64 (bj6-c-dky-precise-recommend-api02.ps.wps.cn)  07/23/2018      _x86_64_        (16 CPU)

查看今天cpu的使用率，8点开始忙碌，最后一栏 **%idle**表示CPU空闲时间百分比。

持续一波到9点多，都没降下来，8：50最凶

![1532328704963](C:\Users\6JMPLP2\AppData\Local\Temp\1532328704963.png)



### 2.定位系统调用

#### top -c  

**top -H -p pid**命令查看进程内各个线程占用的CPU百分比 
**pstree -p 1872 | wc** 查看线程数

**strace -T -r -c -p pid** strace查看具体进程，查找耗时调用

**pstack pid** 可以看到每个线程的调用堆栈，找到已经找出的占用CPU最高的那个线程，然后看他的调用堆栈，很容易看出在哪一步逻辑上导致了busy loop 

再使用**trace -p tid**看看线程的调用过程接着定位到代码，修复bug，找回被偷走的cpu。 

![1532333497680](C:\Users\6JMPLP2\AppData\Local\Temp\1532333497680.png)



![1532333576315](C:\Users\6JMPLP2\AppData\Local\Temp\1532333576315.png)



#### 定位到耗时系统调用在于futex。



3.futex是什么？为什么会产生这么多次？

4.如何避免



linux futex浅析  https://yq.aliyun.com/articles/6043

自旋锁spinlock剖析http://www.suoniao.com/article/15293



一次进程的上下文切换需要多长时间 http://simplecodesky.com/2018/04/13/how-log-does-it-take-to-make-context-switch/

定时任务for循环select导致的futex，select 加个default处理解决http://www.fcong.cn/show/linux-hight-cpu.html



