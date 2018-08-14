<?php
namespace Weixin\Lib;
/**
 * Created by PhpStorm.
 * User: liusha
 * Date: 2018/8/10
 * Time: 10:27
 */
use Weixin\Lib\Base\WxPayApi;
use Weixin\Lib\Base\WxPayAppPay;
use Weixin\Lib\Base\WxException;
use Weixin\Lib\Base\WxPayConfigInterface;

class AppPay
{
    private $config = null;

    public function __construct(WxPayConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     *
     * 获取App支付的参数
     * @param array $UnifiedOrderResult 统一支付接口返回的数据
     * @throws WxException
     *
     * @return json数据，可直接填入js函数作为参数
     */
    public function GetAppParameters($UnifiedOrderResult)
    {
        if(!array_key_exists("appid", $UnifiedOrderResult)
            || !array_key_exists("mch_id", $UnifiedOrderResult)
            || !array_key_exists("prepay_id", $UnifiedOrderResult)
            || $UnifiedOrderResult['prepay_id'] == "")
        {
            throw new WxException("参数错误");
        }

        $appapi = new WxPayAppPay();
        $appapi->SetAppid($UnifiedOrderResult["appid"]);
        $appapi->SetPartnerId($UnifiedOrderResult["mch_id"]);
        $timeStamp = time();
        $appapi->SetTimeStamp("$timeStamp");
        $appapi->SetNonceStr(WxPayApi::getNonceStr());
        $appapi->SetPrepayid($UnifiedOrderResult['prepay_id']);
        $appapi->SetPackage("Sign=WXPay");

        $appapi->SetSign($appapi->MakeSign($this->config));
        $parameters = json_encode($appapi->GetValues());
        return $parameters;
    }

}
