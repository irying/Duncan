package net.mengkang.rpc;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONException;

import java.lang.reflect.InvocationHandler;
import java.lang.reflect.Method;


/**
 * Created by zhoumengkang on 2017/10/22.
 */
class RpcClientInvocationHandler implements InvocationHandler{

    private Class service;

    public RpcClientInvocationHandler(Class clazz) {
        service = clazz;
    }

    public Object invoke(Object proxy, Method method, Object[] args) throws Throwable {
        System.out.println("这里的动态调用实现了 php 的 __call 方法");

        System.out.println("method : " + method.getName());
        for (int i = 0; i < args.length; i++) {
            System.out.println("args["+ i +"] : " + args[i]);
        }

        Class returnType = method.getReturnType();
        String[] serviceName =  service.getName().split("\\.");

        String url = "http://172.19.0.16:8081?service=" + serviceName[serviceName.length - 1] + "&action=" + method.getName();

        String httpResponse = RpcRequest.doPost(url, args);

        Object res = null;

        try{
            res = JSON.parseObject(httpResponse, returnType);
        }catch (JSONException e){
            e.printStackTrace();
        }

        return res;
    }
}
