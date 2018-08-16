<?php
namespace Weixin\Help;

/**
 * 简单CURL请求
 * @package Requests
 */

class Http
{

    /**
     * GET 请求
     * @param $url 请求URL
     * @param array $data 请求数据
     * @param array $headers 自定义头
     * @return mixed
     * @throws \Exception
     */
    public static function Get($url, array $data = array(), array $headers = array())
    {
        $url = empty($data) ? $url : $url.'?'.http_build_query($data);
        return self::Request($url,  null, 'GET', $headers);
    }

    /**
     * POST 请求
     * @param $url 请求URL
     * @param array $data 请求数据
     * @param array $headers 自定义头
     * @return mixed
     * @throws \Exception
     */
    public static function Post($url, $data = array(), array $headers = array())
    {
        return self::Request($url, $data, 'POST', $headers);
    }

    /**
     * 请求
     * @param $url
     * @param array $params
     * @param string $type
     * @param array $headers
     * @param int $timeOut
     * @return mixed
     * @throws \Exception
     */
    public static function Request($url, $params = array(), $type = 'GET', $headers = array(), $timeOut = 30)
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
        //设置请求头
        !empty($headers) && curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //设置请求接口URL
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
        if(strtolower($type) == 'post')
        {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if($data){
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            throw new \Exception("curl出错，错误码:$error");
        }
    }

}