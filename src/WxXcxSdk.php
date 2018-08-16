<?php
namespace Weixin;
/**
 * Created by PhpStorm.
 * User: liusha
 * Date: 2018/8/15
 * Time: 17:09
 */
use Weixin\Lib\Base\WxException;

class WxXcxSdk
{




    private static function request($params, $url, $method='POST', $second = 30)
    {
        $ch = curl_init();

        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch,CURLOPT_URL, $url);

        if(stripos($url,"https://")!==FALSE){
            curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }    else    {
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
            // curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        }
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if($data){
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            throw new WxException("curl出错，错误码:$error");
        }
    }
}