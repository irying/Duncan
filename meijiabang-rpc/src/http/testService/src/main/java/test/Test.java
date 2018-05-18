package test;

/**
 * Created by wangxiaotao on 2017/11/7.
 */
public class Test {
    public static void main(String[] args) throws InterruptedException {
        Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                System.out.println(Thread.currentThread().getName());
                try {
                    Thread.sleep(1000);
                    System.out.println(Thread.currentThread().getName() + "end");
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            }
        });
        thread.start();
        thread.join();
        System.out.println("main end ");
    }
}
