package servlet;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Map;
import java.util.logging.Logger;

/**
 * Created by yanishuang on 2017/11/6.
 */
public class TestServlet extends HttpServlet {
    public void doGet(HttpServletRequest request, HttpServletResponse response)
             throws ServletException, IOException {
        String service = request.getParameter("service");
        String action = request.getParameter("action");
        System.out.println(service + ":" + action);
        response.setCharacterEncoding("UTF-8");
        response.setContentType("application/json; charset=utf-8");
        PrintWriter out = response.getWriter();
                String str = "{'id':1, 'username':{'opus':{'share_id':2251301,'content':null,'video_url':null,'collected':false,'second':{'share_id':2251301,'content':null,'video_url':null,'collected':false,'user':{'uid':'478014','verified_type':'verified','verified_desc':'\u5927\u5b66\u65f6\u671f\u5f00\u59cb\u505a\u7f8e\u7532\u768490\u540e\u5e97\u4e3b','avatar':{'s':'s'},'nickname':'\u5927\u82b1\u82b1\u75af\u72c2\u7f8e\u7532\u5de5\u4f5c\u5ba4'}},'user':{'uid':'478014','verified_type':'verified','verified_desc':'\u5927\u5b66\u65f6\u671f\u5f00\u59cb\u505a\u7f8e\u7532\u768490\u540e\u5e97\u4e3b','avatar':{'s':'s'},'nickname':'\u5927\u82b1\u82b1\u75af\u72c2\u7f8e\u7532\u5de5\u4f5c\u5ba4'}},'opus2':{'share_id':2251301,'content':null,'video_url':null,'collected':false,'user':{'uid':'478014','verified_type':'verified','verified_desc':'\u5927\u5b66\u65f6\u671f\u5f00\u59cb\u505a\u7f8e\u7532\u768490\u540e\u5e97\u4e3b','avatar':{'s':'s'},'nickname':'\u5927\u82b1\u82b1\u75af\u72c2\u7f8e\u7532\u5de5\u4f5c\u5ba4'}},'opus3':{'share_id':2251301,'content':null,'video_url':null,'collected':false,'user':{'uid':'478014','verified_type':'verified','verified_desc':'\u5927\u5b66\u65f6\u671f\u5f00\u59cb\u505a\u7f8e\u7532\u768490\u540e\u5e97\u4e3b','avatar':{'s':'s'},'nickname':'\u5927\u82b1\u82b1\u75af\u72c2\u7f8e\u7532\u5de5\u4f5c\u5ba4'}},'opus5':{'share_id':2251301,'content':null,'video_url':null,'collected':false,'user':{'uid':'478014','verified_type':'verified','verified_desc':'\u5927\u5b66\u65f6\u671f\u5f00\u59cb\u505a\u7f8e\u7532\u768490\u540e\u5e97\u4e3b','avatar':{'s':'s'},'nickname':'\u5927\u82b1\u82b1\u75af\u72c2\u7f8e\u7532\u5de5\u4f5c\u5ba4'}},'opus6':{'share_id':2251301,'content':null,'video_url':null,'collected':false,'user':{'uid':'478014','verified_type':'verified','verified_desc':'\u5927\u5b66\u65f6\u671f\u5f00\u59cb\u505a\u7f8e\u7532\u768490\u540e\u5e97\u4e3b','avatar':{'s':'s'},'nickname':'\u5927\u82b1\u82b1\u75af\u72c2\u7f8e\u7532\u5de5\u4f5c\u5ba4'}},'opus7':{'share_id':2251301,'content':null,'video_url':null,'collected':false,'user':{'uid':'478014','verified_type':'verified','verified_desc':'\u5927\u5b66\u65f6\u671f\u5f00\u59cb\u505a\u7f8e\u7532\u768490\u540e\u5e97\u4e3b','avatar':{'s':'s'},'nickname':'\u5927\u82b1\u82b1\u75af\u72c2\u7f8e\u7532\u5de5\u4f5c\u5ba4'}}}}";
                out.println(str);
                out.flush();
                out.close();

    }
    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        doGet(req,resp);
    }
}
