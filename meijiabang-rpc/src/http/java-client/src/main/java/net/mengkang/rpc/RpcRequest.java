package net.mengkang.rpc;

import com.alibaba.fastjson.JSON;
import org.apache.http.client.config.RequestConfig;
import org.apache.http.client.methods.CloseableHttpResponse;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.util.EntityUtils;

/**
 * Created by zhoumengkang on 2017/10/22.
 */
public class RpcRequest {
    public static String doPost(String url, Object content) {
        CloseableHttpClient httpClient = HttpClients.createDefault();
        String responseText = "";
        CloseableHttpResponse httpResponse = null;

        try {
            HttpPost httpPost = new HttpPost(url);
            RequestConfig requestConfig = RequestConfig.custom().setSocketTimeout(5000).setConnectTimeout(5000).build();
            httpPost.setConfig(requestConfig);
            String json = JSON.toJSONString(content);
            StringEntity entity = new StringEntity(json,"utf-8");
            httpPost.setEntity(entity);

            httpResponse = httpClient.execute(httpPost);
            if (httpResponse.getStatusLine().getStatusCode() == 200) {
                responseText = EntityUtils.toString(httpResponse.getEntity());
            }
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            try {
                if (httpResponse != null) {
                    httpResponse.close();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }

        return responseText;
    }
}

