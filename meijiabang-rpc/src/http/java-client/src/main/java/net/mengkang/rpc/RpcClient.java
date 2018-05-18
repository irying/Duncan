package net.mengkang.rpc;


import java.lang.reflect.Proxy;

/**
 * Created by zhoumengkang on 2017/10/22.
 */
public class RpcClient {
    public final Object proxy(Class type) {
        RpcClientInvocationHandler handler = new RpcClientInvocationHandler(type);
        return Proxy.newProxyInstance(type.getClassLoader(), new Class[]{type}, handler);
    }
}
