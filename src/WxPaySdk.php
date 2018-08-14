<?php
namespace Weixin;
/**
 * 微信支付sdk整理
 * Class WxPaySdk
 * @package Lib\Sdk
 */
use Weixin\Lib\AppPay;
use Weixin\Lib\JsApiPay;
use Weixin\Lib\MicroPay;
use Weixin\Lib\NativePay;
use Weixin\Lib\Base\WxPayApi;
use Weixin\Lib\Base\WxPayRefund;
use Weixin\Lib\Base\WxPayMicroPay;
use Weixin\Lib\Base\WxPayOrderQuery;
use Weixin\Lib\Base\WxPayRefundQuery;
use Weixin\Lib\Base\WxPayUnifiedOrder;
use Weixin\Lib\Base\WxPayNotifyReply;
use Weixin\Lib\Base\WxPayNotifyResults;
use Weixin\Lib\Base\WxException;
use Weixin\Lib\Base\WxPayConfigInterface;

class WxPaySdk
{
    /**
     * 获取统一下单配置类
     * @return $this
     */
    public static function getUnifiedOrderObj()
    {
        return new WxPayUnifiedOrder();
    }

    /**
     * 获取jsapi支付参数
     * @param WxPayUnifiedOrder $inputObj
     * @return Wx\Lib\json数据
     * @throws Wx\Lib\Base\WxException
     */
    public static function jsApiPay(WxPayUnifiedOrder $inputObj, WxPayConfigInterface $config)
    {
        $inputObj->SetTrade_type("JSAPI");
        $order = WxPayApi::unifiedOrder($config, $inputObj);
        return (new JsApiPay($config))->GetJsApiParameters($order);
    }

    /**
     * 获取扫码支付参数
     * @param WxPayUnifiedOrder $inputObj
     * @return bool|Wx\Lib\Base\成功时返回
     * @throws Wx\Lib\Base\WxException
     */
    public static function NativePay(WxPayUnifiedOrder $inputObj, WxPayConfigInterface $config)
    {
        $inputObj->SetTrade_type("NATIVE");
        return (new NativePay($config))->GetPayUrl($inputObj);
    }

    /**
     * 获取app支付参数
     * @param WxPayUnifiedOrder $inputObj
     * @return Wx\Lib\json数据
     * @throws Wx\Lib\Base\WxException
     */
    public static function appPay(WxPayUnifiedOrder $inputObj, WxPayConfigInterface $config)
    {
        $inputObj->SetTrade_type("APP");
        $order = WxPayApi::unifiedOrder($config, $inputObj);
        return (new AppPay($config))->GetAppParameters($order);
    }


    /**
     * 获取刷卡支付配置类
     * @return $this
     */
    public static function getMicroPayObj()
    {
        return new WxPayMicroPay();
    }
    /**
     * 刷卡支付
     * @param WxPayMicroPay $inputObj
     * @return Wx\Lib\返回查询接口的结果
     * @throws Wx\Lib\Base\WxException
     */
    public function microPay(WxPayMicroPay $inputObj, WxPayConfigInterface $config)
    {
        return (new MicroPay($config))->pay($inputObj, 30);
    }


    /**
     * 获取退款配置类
     * @return $this
     */
    public static function getRefundObj()
    {
        return new WxPayRefund();
    }

    /**
     * 微信退款
     * @param WxPayRefund $inputObj
     * @param WxPayConfig $config
     * @return Wx\Lib\Base\成功时返回
     * @throws Wx\Lib\Base\WxException
     */
    public static function refund(WxPayRefund $inputObj, WxPayConfigInterface $config)
    {
        return WxPayApi::refund($config, $inputObj);
    }

    /**
     * 获取订单查询配置类
     * @return WxPayOrderQuery
     */
    public static function getOrderQueryObj()
    {
        return new WxPayOrderQuery();
    }
    /**
     * 订单查询
     * @param array $input out_trade_no transaction_id 二选一即可
     * @param WxPayConfig $config
     * @return Wx\Lib\Base\成功时返回
     * @throws Wx\Lib\Base\WxException
     */
    public static function orderQuery(array $input, WxPayConfigInterface $config)
    {
        $orderQueryObj = self::getOrderQueryObj();
        // 设置第三方商户单号
        if(isset($input['out_trade_no']) && !empty($input['out_trade_no']))
            $orderQueryObj->SetOut_trade_no($input['out_trade_no']);
        // 设置交易单号
        if(isset($input['transaction_id']) && !empty($input['transaction_id']))
            $orderQueryObj->SetTransaction_id($input['transaction_id']);

        return WxPayApi::orderQuery($config, $orderQueryObj);
    }

    /**
     * 获取退款订单查询配置类
     * @return WxPayOrderQuery
     */
    public static function getRefundOrderQueryObj()
    {
        return new WxPayRefundQuery();
    }
    /**
     * 退款订单查询
     * @param array $input out_trade_no transaction_id 二选一即可
     * @param WxPayConfig $config
     * @return Wx\Lib\Base\成功时返回
     * @throws Wx\Lib\Base\WxException
     */
    public static function refundQuery(array $input, WxPayConfigInterface $config)
    {
        $refundQueryObj = self::getRefundOrderQueryObj();
        // 设置第三方商户单号
        if(isset($input['out_trade_no']) && !empty($input['out_trade_no']))
            $refundQueryObj->SetOut_trade_no($input['out_trade_no']);
        // 设置交易单号
        if(isset($input['transaction_id']) && !empty($input['transaction_id']))
            $refundQueryObj->SetTransaction_id($input['transaction_id']);

        return WxPayApi::refundQuery($config, $refundQueryObj);
    }



    /**
     * TODO 可以直接使用 WxNotify 一步完成
     * 通知回调验证
     * @param WxPayConfig $config
     * @return bool|WxPayNotifyResults
     */
    public static function notifyCheck(WxPayConfigInterface $config)
    {
        if (!isset($GLOBALS['HTTP_RAW_POST_DATA']))
        {
            # 如果没有数据，直接返回失败
            throw new WxException("数据获取异常！");
        }
        //获取通知的数据
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        //验证签名获取书籍
        $result = WxPayNotifyResults::Init($config, $xml);
        return $result;
    }

    /**
     * 回复通知
     * @param bool $reply
     * @param string $msg
     * @param bool $needSign
     * @throws \WxException
     */
    public static function notifyReply(bool $reply,string $msg='', $needSign=false, WxPayConfigInterface $config=null)
    {
        $replyObj = new WxPayNotifyReply();
        if($reply == false){
            $replyObj->SetReturn_code("FAIL");
            $replyObj->SetReturn_msg($msg);
            $needSign = false;
        } else {
            $replyObj->SetReturn_code("SUCCESS");
            $replyObj->SetReturn_msg("OK");
        }
        //如果需要签名
//        if($needSign == true && $replyObj->GetReturn_code() == "SUCCESS")
//        {
//            $replyObj->SetSign($config);
//        }
        $xml = $replyObj->ToXml();
        WxpayApi::replyNotify($xml);
    }
}