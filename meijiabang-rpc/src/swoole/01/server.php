<?php
define("SERVER_IP", "127.0.0.1");
define("SERVER_PORT", 9504);

$http = new swoole_http_server(SERVER_IP, SERVER_PORT);

$http->on("start", function ($server) {
    echo "http server is started at http://" . SERVER_IP . ":" . SERVER_PORT . "\n";
});

$http->on("request", function ($request, $response) {
    $res = httpRequest($request);
    $response->header("Content-Type", "text/plain");
    $response->end($res);
});

$http->start();


function httpRequest($request)
{
    $service = $request->get['service'];
    $action = $request->get['action'];

    if (!isset($service) || !isset($action)) {
        return "";
    }

    $argv = $request->rawContent();

    if ($argv) {
        $argv = json_decode($argv, true);
    }

    $res = call_user_func_array([$service, $action], $argv);

    return json_encode($res);
}

class SwooleHelloService
{
    public static function sayHello($name)
    {
        $homeOpuses = array (
            'error_code' => 0,
            'error_message' => 'SUCCESS::Api success::V3',
            'error_description' => '',
            'data' =>
                array (
                    0 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2252254,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/11/03/a5b9231da4f2d9e91c256e99144f5b20LV7PpX.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '2220276',
                                            'verified_type' => 'none',
                                            'verified_desc' => '',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/2016/09/09/59ef3f45c690d0e521208881f8283554J8cYGJ.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '_童童美甲',
                                        ),
                                ),
                        ),
                    1 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2251301,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/share/2017/11/02/c38e5a3ba30c0eac53b7e688cddd156a.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '478014',
                                            'verified_type' => 'verified',
                                            'verified_desc' => '大学时期开始做美甲的90后店主',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/47/80/14.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '大花花疯狂美甲工作室',
                                        ),
                                ),
                        ),
                    2 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2242533,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/27/0c23c7e8bf7cd47e17d9a15c9d650f70UhhlHd.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '4',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/00/00/04.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '爱米',
                                        ),
                                ),
                        ),
                    3 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2246905,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/30/046cd53617583ea685e9dcc6851b7cd9D0MfOR.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '4',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/00/00/04.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '爱米',
                                        ),
                                ),
                        ),
                    4 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2252225,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/11/03/2089ce35849523fb9055b231f41ac2dc66LY6e.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '2220666',
                                            'verified_type' => 'none',
                                            'verified_desc' => '',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/2016/09/09/1524c77876f2d09effa4b7aacc84ca2bqJF25j.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '咖啡牛奶milky',
                                        ),
                                ),
                        ),
                    5 =>
                        array (
                            'simulation_advertising' =>
                                array (
                                    'id' => 7,
                                    'image' =>
                                        array (
                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/30/e64beb8414116c7a97b3662af776c346Uxr573.jpg@375w_375h_100Q.webp',
                                            'width' => 375,
                                            'height' => 375,
                                        ),
                                    'avatar' =>
                                        array (
                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/30/a89bca4b9212b8ce33c4fb70b10ce57bd601sS.png@160w_160h_100Q.webp',
                                            'width' => 160,
                                            'height' => 160,
                                        ),
                                    'app_route' => 'meijiabang://openurl_in_app?utm_source=app&utm_campaign=%E6%96%87%E7%AB%A0%E7%B1%BB%E8%BD%AF%E5%B9%BF_7&utm_medium=simulation_advertising_opus_6&content_title=%E7%BE%8E%E5%9B%BE%E5%B9%BF%E5%91%8A%E6%96%87%E7%AB%A0%E5%AF%BC%E8%B4%AD-%E7%8C%AB%E7%9C%BC%E8%83%B6&content_business=%E5%95%86%E5%9F%8E&url=http%3A%2F%2Fm.meijiabang.cn%2Fh5page%2F1732.html%3Futm_source%3Dapp%26utm_campaign%3D%25E6%2596%2587%25E7%25AB%25A0%25E7%25B1%25BB%25E8%25BD%25AF%25E5%25B9%25BF_7%26utm_medium%3Dsimulation_advertising_opus_6%26content_title%3D%25E7%25BE%258E%25E5%259B%25BE%25E5%25B9%25BF%25E5%2591%258A%25E6%2596%2587%25E7%25AB%25A0%25E5%25AF%25BC%25E8%25B4%25AD-%25E7%258C%25AB%25E7%259C%25BC%25E8%2583%25B6%26content_business%3D%25E5%2595%2586%25E5%259F%258E',
                                    'avatar_title' => '商城推荐君',
                                    'label' => '热卖商品',
                                ),
                            'opus' => NULL,
                        ),
                    6 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2246904,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/30/9d1ac90e38265884b5be406a3c0fe1828limE0.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '58880',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/05/88/80.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '麦尼',
                                        ),
                                ),
                        ),
                    7 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2246902,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/30/c3868da257153cc8275792fccabae7d03NdAbs.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '4',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/00/00/04.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '爱米',
                                        ),
                                ),
                        ),
                    8 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2252167,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/share/2017/11/03/9b6ccaa31d2f4d00cee76460bb7bdff5.jpg@375w_502h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '1370674',
                                            'verified_type' => 'none',
                                            'verified_desc' => '',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/2016/06/20/4298f28c2250be88001044b9710a732dU6ejJM.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '美莎美甲',
                                        ),
                                ),
                        ),
                    9 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2252168,
                                    'content' => '磨砂',
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/share/2017/11/03/e272f442c10e2abe982531c573e1145b.jpg@375w_500h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '1370674',
                                            'verified_type' => 'none',
                                            'verified_desc' => '',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/2016/06/20/4298f28c2250be88001044b9710a732dU6ejJM.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '美莎美甲',
                                        ),
                                ),
                        ),
                    10 =>
                        array (
                            'simulation_advertising' =>
                                array (
                                    'id' => 8,
                                    'image' =>
                                        array (
                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/11/01/1366481a50f66d3447c8a929aa831dbbG9jgJz.jpg@375w_375h_100Q.webp',
                                            'width' => 375,
                                            'height' => 375,
                                        ),
                                    'avatar' =>
                                        array (
                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/30/a89bca4b9212b8ce33c4fb70b10ce57bd601sS.png@160w_160h_100Q.webp',
                                            'width' => 160,
                                            'height' => 160,
                                        ),
                                    'app_route' => 'meijiabang://goods_details?utm_source=app&utm_campaign=%E5%95%86%E5%93%81%E7%B1%BB%E7%A1%AC%E5%B9%BF_8&utm_medium=simulation_advertising_opus_11&goods_id=254065&sale_mode=common&content_title=%E7%BE%8E%E5%9B%BE%E5%B9%BF%E5%91%8A+%E5%95%86%E5%93%81%E7%A1%AC%E5%B9%BF&content_business=%E5%95%86%E5%9F%8E',
                                    'avatar_title' => '商城推荐君',
                                    'label' => '精选商品',
                                ),
                            'opus' => NULL,
                        ),
                    11 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2246901,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/30/3ad52454f442c66a18582a39b8cce1fdcCLZn1.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '58880',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/05/88/80.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '麦尼',
                                        ),
                                ),
                        ),
                    12 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2252083,
                                    'content' => '手绘藤蔓花',
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/share/2017/11/03/0ee88f1175368fcfe3617895a4e10e14.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '1423836',
                                            'verified_type' => 'none',
                                            'verified_desc' => '',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/2017/09/29/d3ac910e2264509b79ea539a10a25f5226E6F7.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => 'Miu匠',
                                        ),
                                ),
                        ),
                    13 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2246899,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/30/899a66ef2516e7c99094631542203809MtOMZt.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '58880',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/05/88/80.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '麦尼',
                                        ),
                                ),
                        ),
                    14 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2242803,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/27/bcee6995a21e5ec5802e2ea8fc3fe941p6t0ZZ.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '4',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/00/00/04.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '爱米',
                                        ),
                                ),
                        ),
                    15 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2242801,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/27/9ac294f84c0c8bc77f184b819a4cee31koA21l.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '4',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/00/00/04.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '爱米',
                                        ),
                                ),
                        ),
                    16 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2242800,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/27/8503d42502cd4fdd13b851360c5de6262AIoi5.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '58880',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/05/88/80.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '麦尼',
                                        ),
                                ),
                        ),
                    17 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2242799,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/27/e69b6cd6d9fe738f23483b349fa20838zc2cEI.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '4',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/00/00/04.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '爱米',
                                        ),
                                ),
                        ),
                    18 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2242798,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/27/f0c9d58f78d8606f214ee5fd51a45d8cZrBGDR.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '58880',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/05/88/80.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '麦尼',
                                        ),
                                ),
                        ),
                    19 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2242797,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/27/32da207c586f6b5f81b1b256b446c6ffyxX3It.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '4',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/00/00/04.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '爱米',
                                        ),
                                ),
                        ),
                    20 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2242796,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/27/dd4487cd41dcc82ba293e44cf3e4a31dXxr9nQ.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '58880',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/05/88/80.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '麦尼',
                                        ),
                                ),
                        ),
                    21 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2242636,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/27/a938ccba64cde12fd0e9609685edb7e88EkKv5.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '4',
                                            'verified_type' => 'official',
                                            'verified_desc' => '美甲帮认证：美甲帮官方帐号',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/origin/000/00/00/04.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '爱米',
                                        ),
                                ),
                        ),
                    22 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2238695,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/obj_image/2017/10/24/96a4a09685f49567cdb0336a2d88dbf2Fh4Xhu.jpg@375w_375h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '1385658',
                                            'verified_type' => 'official',
                                            'verified_desc' => '',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/2016/02/19/56e787d7b9ad2491f4f632eb675a53ddU2JV2w.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '美图小编',
                                        ),
                                ),
                        ),
                    23 =>
                        array (
                            'simulation_advertising' => NULL,
                            'opus' =>
                                array (
                                    'share_id' => 2251963,
                                    'content' => NULL,
                                    'video_url' => NULL,
                                    'collected' => false,
                                    'cover' =>
                                        array (
                                            's' =>
                                                array (
                                                    'url' => 'http://cdn3.meijiabang.cn/public/upload/share/2017/11/02/af3de679e99287263ada8191333e1acf.jpg@375w_315h_80Q',
                                                    'width' => 375,
                                                    'height' => 375,
                                                ),
                                        ),
                                    'user' =>
                                        array (
                                            'uid' => '772736',
                                            'verified_type' => 'none',
                                            'verified_desc' => '',
                                            'avatar' =>
                                                array (
                                                    's' =>
                                                        array (
                                                            'url' => 'http://cdn3.meijiabang.cn/public/upload/avatar/2017/09/04/ec2cadcfabb5a57c9d012661b38007e98EoDOe.jpg@160w_160h_80Q',
                                                            'width' => 160,
                                                            'height' => 160,
                                                        ),
                                                ),
                                            'nickname' => '绝爱_8',
                                        ),
                                ),
                        ),
                ),
            'extra' => NULL,
        );
        // 假设以下内容从数据库取出
        return json_encode($homeOpuses);
    }
}
