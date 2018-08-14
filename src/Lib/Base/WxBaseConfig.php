<?php
namespace Weixin\Lib\Base;

use Weixin\Lib\Base\WxPayConfigInterface;
/**
 * Created by PhpStorm.
 * User: liusha
 * Date: 2018/8/8
 * Time: 19:28
 */
class WxBaseConfig extends WxPayConfigInterface
{
    //=======【基本信息设置】=====================================
    /**
     * TODO: 修改这里配置为您自己申请的商户信息
     * 微信公众号信息配置
     *
     * APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
     *
     * MCHID：商户号（必须配置，开户邮件中可查看）
     *
     */
    private $appId = '';
    private $merchantId = '';
    public function SetAppId($appId)
    {
        $this->appId = $appId;
    }
    public  function GetAppId()
    {
        return $this->appId;
    }
    public function SetMerchantId($merchantId)
    {
        $this->appId = $merchantId;
    }
    public  function GetMerchantId()
    {
        return $this->merchantId;
    }


    //=======【支付相关配置：支付成功回调地址/签名方式】===================================
    /**
     * TODO:支付回调url
     * 签名和验证签名方式， 支持md5和sha256方式
     **/
    private $notifyUrl = '';
    private $signType = 'MD5';//'HMAC-SHA256';
    public function SetNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }
    public  function GetNotifyUrl()
    {
        return $this->notifyUrl;
    }
    public function SetSignType($signType)
    {
        $this->signType = $signType;
    }
    public  function GetSignType()
    {
        return $this->signType;
    }

    //=======【curl代理设置】===================================
    /**
     * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
     * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
     * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
     * @var unknown_type
     */
    private $proxyHost = '0.0.0.0';
    private $proxyPort = 0;
    public function SetProxy($proxyHost, $proxyPort)
    {
        $this->proxyHost = $proxyHost;
        $this->proxyPort = $proxyPort;
    }
    public function GetProxy(&$proxyHost, &$proxyPort)
    {
        $proxyHost = $this->proxyHost;
        $proxyPort = $this->proxyPort;
    }


    //=======【上报信息配置】===================================
    /**
     * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
     * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
     * 开启错误上报。
     * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
     * @var int
     */
    private $reportLevel = 1;
    public  function SetReportLevel($reportLevel)
    {
        $this->reportLevel = $reportLevel;
    }
    public  function GetReportLevel()
    {
        return $this->reportLevel;
    }


    //=======【商户密钥信息-需要业务方继承】===================================
    /*
     * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）, 请妥善保管， 避免密钥泄露
     * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
     *
     * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）， 请妥善保管， 避免密钥泄露
     * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
     * @var string
     */
    private $key = '';
    private $appSecret = '';
    public  function SetKey($key)
    {
        return $this->key = $key;
    }
    public  function GetKey()
    {
        return $this->key;
    }
    public  function SetAppSecret($appSecret)
    {
        $this->appSecret = $appSecret;
    }
    public  function GetAppSecret()
    {
        return $this->appSecret;
    }


    //=======【证书路径设置-需要业务方继承】=====================================
    /**
     * TODO：设置商户证书路径
     * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
     * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
     * 注意:
     * 1.证书文件不能放在web服务器虚拟目录，应放在有访问权限控制的目录中，防止被他人下载；
     * 2.建议将证书文件名改为复杂且不容易猜测的文件名；
     * 3.商户服务器要做好病毒和木马防护工作，不被非法侵入者窃取证书文件。
     * @var path
     */
    private $sslCertPath = '';
    private $sslKeyPath = '';
    public  function SetSSLCertPath($sslCertPath, $sslKeyPath)
    {
        $this->sslCertPath = $sslCertPath;
        $this->sslKeyPath = $sslKeyPath;
    }
    public  function GetSSLCertPath(&$sslCertPath, &$sslKeyPath)
    {
        $sslCertPath = $this->sslCertPath;
        $sslKeyPath = $this->sslKeyPath;
    }

    /**
     * 应用授权模式
     * @var int 0 默认 1 三方授权
     */
    private $oauth_type = 0;
    public  function SetOAuthType($oauth_type)
    {
        $this->oauth_type = $oauth_type;
    }
    public  function GetOAuthType()
    {
        return $this->oauth_type;
    }

    /**
     *  三方授权相关参数
     *  $component_appid component_access_token
     */
    private $component_appid = '';
    private $component_access_token = '';
    public  function SetComponentAppid($component_appid)
    {
        $this->component_appid = $component_appid;
    }
    public  function GetComponentAppid()
    {
        return $this->component_appid;
    }
    public  function SetComponentAccessToken($component_access_token)
    {
        $this->component_access_token = $component_access_token;
    }
    public  function GetComponentAccessToken()
    {
        return $this->component_access_token;
    }
}