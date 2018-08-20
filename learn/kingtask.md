![1529131680583](https://wx1.sinaimg.cn/mw690/e5b38bb8gy1fsd0s6djdaj20eg0e5aah.jpg)

kingtask的实现步骤如下所述：

1. broker收到client发送过来的异步任务（一个异步任务由一个唯一的uuid标示）之后，判断异步任务是否定时，如果未定时，则直接将异步任务封装成一个结构体，存入redis。如果定时，则通过定时器触发，将异步任务封装成一个结构体，存入redis。
2. worker从redis中获取异步任务，或者到任务之后，执行该任务，并将任务结果存入redis。
3. 对于失败的任务，如果该任务有重试机制，broker会重新发送该任务到redis，然后worker会重新执行。