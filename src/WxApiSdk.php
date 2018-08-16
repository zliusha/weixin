<?php
namespace Weixin;
/**
 * Created by PhpStorm.
 * User: liusha
 * Date: 2018/8/16
 * Time: 11:16
 */
use Weixin\Help\Http;
use Weixin\Lib\Base\WxBaseConfig;
use Weixin\Lib\Base\WxException;

class WxApiSdk
{
    /**
     * 获取access_token  做好缓存处理
     * @param $input
     * @return mixed
     */
    public static function GetAccessToken(WxBaseConfig $config)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token';
        $params = [
            'grant_type' => 'client_credential',
            'appid' => $config->GetAppId(),
            'secret' => $config->GetAppSecret()
        ];

        $result = Http::Get($url, $params);
        return json_decode($result, true);
    }
    /**
     * 获取ticket   做好缓存处理
     * @param $access_token
     * @return mixed
     */
    public static function GetTicket($access_token)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket";
        $params = [
            'type' => 'jsapi',
            'access_token' => $access_token
        ];

        $result = Http::Get($url, $params);
        return json_decode($result, true);
    }
    /**
     * 获取分享参数
     * @return array
     */
    public static function GetSignPackage(WxBaseConfig $config, $ticket, $url='')
    {
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $_url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $url = $url ? $url : $_url;

        $timestamp = time();
        $nonceStr = self::CreateNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $config->GetAppId(),
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }
    /**
     * 随机字符串
     * @param int $length
     * @return string
     */
    private static function CreateNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }


}