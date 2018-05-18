package net.mengkang;

import net.mengkang.rpc.RpcClient;
import net.mengkang.sdk.User;
import net.mengkang.sdk.UserService;

/**
 * Created by zhoumengkang on 2017/10/22.
 */
public class Demo {
    public static void demo(){
        RpcClient rpcClient = new RpcClient();
        UserService userService = (UserService) rpcClient.proxy(UserService.class);
        long start=System.currentTimeMillis();
        for(int i = 0; i <= 100; i++) {
            User user = userService.getUserInfo(10);
        }
        long end=System.currentTimeMillis();
        System.out.println(start);
        System.out.println(end);
        System.out.println((end-start)+"ms");
    }

    public static void main(String args[]){
        Demo.demo();
    }
}
