<?php
namespace Weixin\Lib;
/**
 * Created by PhpStorm.
 * User: liusha
 * Date: 2018/8/10
 * Time: 10:55
 */

use Weixin\Lib\Base\WxPayApi;
use Weixin\Lib\Base\WxPayBizPayUrl;
use Weixin\Lib\Base\WxException;
use Weixin\Lib\Base\WxPayConfigInterface;
use Weixin\Lib\Base\WxPayUnifiedOrder;

class NativePay
{
    /**
     * 配置类
     * @var WxPayConfigInterface|null
     */
    private $config = null;

    public function __construct(WxPayConfigInterface $config)
    {
        $this->config = $config;
    }
    /**
     *
     * 生成扫描支付URL,模式一
     * @param BizPayUrlInput $bizUrlInfo
     */
    public function GetPrePayUrl($productId)
    {
        $biz = new WxPayBizPayUrl();
        $biz->SetProduct_id($productId);
        try{
            $config = $this->config;
            $values = WxpayApi::bizpayurl($config, $biz);
        } catch(WxException $e) {
            throw new WxException($e->getMessage());
        }
        $url = "weixin://wxpay/bizpayurl?" . $this->ToUrlParams($values);
        return $url;
    }

    /**
     *
     * 参数数组转换为url参数
     * @param array $urlObj
     */
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            $buff .= $k . "=" . $v . "&";
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     *
     * 生成直接支付url，支付url有效期为2小时,模式二
     * @param UnifiedOrderInput $input
     */
    public function GetPayUrl(WxPayUnifiedOrder $input)
    {
        if($input->GetTrade_type() == "NATIVE")
        {
            try{
                $config = $this->config;
                $result = WxPayApi::unifiedOrder($config, $input);
                return $result;
            } catch(WxException $e) {
                throw new WxException($e->getMessage());
            }
        }
        return false;
    }
}