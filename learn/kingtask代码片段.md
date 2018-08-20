代码片段

1.时间差

```go
func (b *Broker) HandleRequest(request *task.TaskRequest) error {
   var err error
   now := time.Now().Unix()
   if request.StartTime == 0 {
      request.StartTime = now
   }

   if request.StartTime <= now {
      err = b.AddRequestToRedis(request)
      if err != nil {
         return err
      }
   } else {
      afterTime := time.Second * time.Duration(request.StartTime-now)
      b.timer.NewTimer(afterTime, b.AddRequestToRedis, request)
   }

   return nil
}
```



2.broker及初始化代码片段

```go
type Broker struct {
   cfg         *config.BrokerConfig
   addr        string
   redisAddr   string
   redisDB     int
   running     bool
   web         *echo.Echo
   redisClient *redis.Client
   timer       *timer.Timer
}
```



有个web，装着个echo服务器实例；

有个redisClient，实例化一个redis客户端；

起个timer。

```go
broker.redisClient = redis.NewClient(
   &redis.Options{
      Addr:     broker.redisAddr,
      Password: "", // no password set
      DB:       int64(broker.redisDB),
   },
)
_, err = broker.redisClient.Ping().Result()
if err != nil {
   golog.Error("broker", "NewBroker", "ping redis fail", 0, "err", err.Error())
   return nil, err
}

return broker, nil
```