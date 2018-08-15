<?php
namespace Weixin;
/**
 * Created by PhpStorm.
 * User: liusha
 * Date: 2018/8/10
 * Time: 17:25
 */
use Weixin\Lib\Base\WxBaseConfig;
class WxConfig
{
    /**
     * 设置支付配置
     * @param array $config
     */
    public static function Init(array $config=[])
    {
        // 配置类
        $baseConfig = new WxBaseConfig();
        // APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
        isset($config['app_id']) && $baseConfig->SetAppId($config['app_id']);
        // 公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）
        isset($config['app_secret']) && $baseConfig->SetAppSecret($config['app_secret']);
        // 商户号（必须配置，开户邮件中可查看）
        isset($config['mch_id']) && $baseConfig->SetMerchantId($config['mch_id']);
        // 商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
        isset($config['key']) && $baseConfig->SetKey($config['key']);
        // 签名类型
        isset($config['sign_type']) && $baseConfig->SetSignType($config['sign_type']);
        // 通知路径
        isset($config['notify_url']) && $baseConfig->SetNotifyUrl($config['notify_url']);
        // 报告登记
        isset($config['report_level']) && $baseConfig->SetReportLevel($config['report_level']);
        // 证书路径设置
        if(isset($config['sslCert_Path']) && isset($config['sslKey_Path']))
        {
            $baseConfig->SetSSLCertPath($config['sslCert_Path'], $config['sslKey_Path']);
        }
        // curl代理设置
        if(isset($config['proxy_host']) && isset($config['proxy_port']))
        {
            $baseConfig->SetProxy($config['proxy_host'], $config['proxy_port']);
        }
        // 授权模式
        if(isset($config['oauth_type']))
        {
            $baseConfig->SetOAuthType($config['oauth_type']);
        }
        // 三方授权相关参数
        if(isset($config['component_appid']) && isset($config['component_access_token']))
        {
            $baseConfig->SetComponentAppid($config['component_appid']);
            $baseConfig->SetComponentAccessToken($config['component_access_token']);
        }

        return $baseConfig;
    }
}
