http://www.uubook.net/article/detail/98477.html

http://nicholegit.github.io/go%E8%AF%AD%E8%A8%80%E6%95%B4%E5%90%88%E5%91%BD%E4%BB%A4%E8%A1%8C%EF%BC%8C%E9%85%8D%E7%BD%AE%E6%96%87%E4%BB%B6%E5%92%8C%E9%BB%98%E8%AE%A4%E5%80%BC/

代码片段

**doInfo：直接return个struct回去**

```
func (s *httpServer) doInfo(w http.ResponseWriter, req *http.Request, ps httprouter.Params) (interface{}, error) {
   hostname, err := os.Hostname()
   if err != nil {
      return nil, http_api.Err{500, err.Error()}
   }
   return struct {
      Version          string `json:"version"`
      BroadcastAddress string `json:"broadcast_address"`
      Hostname         string `json:"hostname"`
      HTTPPort         int    `json:"http_port"`
      TCPPort          int    `json:"tcp_port"`
      StartTime        int64  `json:"start_time"`
   }{
      Version:          version.Binary,
      BroadcastAddress: s.ctx.nsqd.getOpts().BroadcastAddress,
      Hostname:         hostname,
      TCPPort:          s.ctx.nsqd.RealTCPAddr().Port,
      HTTPPort:         s.ctx.nsqd.RealHTTPAddr().Port,
      StartTime:        s.ctx.nsqd.GetStartTime().Unix(),
   }, nil
}
```