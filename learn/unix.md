1.设备不仅有文件名，而且支持与所有文件相关的系统调用：open、read、write、lseek、close和stat。



一块连接到麦克风和扬声器的声卡，**你对着麦克风说话，声卡将来自你声音的信号转换成数据流，使得程序能够读取这个数据流。当程序向声卡写入数据流时，声音就从扬声器中出来**。对一个程序来说，声卡既是数据的源，又是数据的目的地。

![设备文件信息](https://wx2.sinaimg.cn/mw690/e5b38bb8gy1fs4sqewilaj20ks0260sk.jpg)

文件类型是"c",表示这个文件是以字符为单位进行传送的设备。



1. **常用的磁盘文件由字节组成，磁盘文件中的字节数就是文件的大小。**
2. 设备文件的i-节点存储的是指向内核子程序的指针，而不是文件的大小和存储列表。
3. 内核中**传输设备数据的子程序被称为设备驱动程序。**
4. 目录是文件名和i-节点号的列表，i-节点可以是磁盘文件的，也可以是设备文件的。i-节点的类型被记录在结构stat的成员变量st_mode的类型区域中。**磁盘文件的i-节点包含指向数据块的指针。设备文件的i-节点包含指向内核子程序表的指针。**



read是如何工作的？

内核首先找到文件描述符的i-节点，该i-节点用于告诉内核文件的类型。如果文件是磁盘文件，那么内核通过访问块分配表来读取数据。**如果文件是设备文件，那么内核通过调用该设备驱动程序的read部分来读取数据。**