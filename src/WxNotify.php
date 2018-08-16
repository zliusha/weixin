<?php
namespace Weixin;
/**
 * Created by PhpStorm.
 * User: liusha
 * Date: 2018/8/10
 * Time: 16:20
 */

use Weixin\Lib\Base\WxPayNotify;

class WxNotify extends WxPayNotify
{
    /**
     * 使用事例
     * TODO $config = new WxConfig();
     * TODO $notify = new WxNotify();
     * TODO $notify->Handle($config, true);
     * 回调方法入口，子类可重写该方法
    //TODO 1、进行参数校验
    //TODO 2、进行签名验证
    //TODO 3、处理业务逻辑
     * 注意：
     * 1、微信回调超时时间为2s，建议用户使用异步处理流程，确认成功之后立刻回复微信服务器
     * 2、微信服务器在调用失败或者接到回包为非确认包的时候，会发起重试，需确保你的回调是可以重入
     * @param WxPayNotifyResults $objData 回调解释出的参数
     * @param WxPayConfigInterface $config
     * @param string $msg 如果回调处理失败，可以将错误信息输出到该方法
     * @return true回调出来完成不需要继续回调，false回调处理未完成需要继续回调
     */
    public function NotifyProcess($objData, $config, &$msg)
    {
        //todo 处理业务(重写该方法)

        return false;
    }

    /**
     * 扫码支付模式一回调需要统一下单处理，具体根据业务处理
     */
    // public function unifiedorder($openId, $product_id)
    // {
    //     //统一下单
    //     $config = new WxConfig();
    //     $input = WxPaySdk::GetUnifiedOrderObj;
    //     $input->SetBody("test");
    //     $input->SetAttach("test");
    //     $input->SetOut_trade_no($config->GetMerchantId().date("YmdHis"));
    //     $input->SetTotal_fee("1");
    //     $input->SetTime_start(date("YmdHis"));
    //     $input->SetTime_expire(date("YmdHis", time() + 600));
    //     $input->SetGoods_tag("test");
    //     $input->SetNotify_url("http://paysdk.weixin.qq.com/notify.php");
    //     $input->SetTrade_type("NATIVE");
    //     $input->SetOpenid($openId);
    //     $input->SetProduct_id($product_id);
    //     try {
    //         $result = WxPayApi::unifiedOrder($config, $input);
    //         Log::DEBUG("unifiedorder:" . json_encode($result));
    //     } catch(Exception $e) {
    //         Log::ERROR(json_encode($e));
    //     }
    //     return $result;
    // }
  
    // public function NotifyProcess($objData, $config, &$msg)
    // {
    //     $data = $objData->GetValues();
    //     //TODO 1、进行参数校验
    //     if(!array_key_exists("openid", $data) ||
    //         !array_key_exists("product_id", $data))
    //     {
    //         $msg = "回调数据异常";
    //         return false;
    //     }

    //     //TODO 2、进行签名验证
         
    //     $openid = $data["openid"];
    //     $product_id = $data["product_id"];
        
    //     //TODO 3、处理业务逻辑
    //     //统一下单
    //     $result = $this->unifiedorder($openid, $product_id);
    //     if(!array_key_exists("appid", $result) ||
    //          !array_key_exists("mch_id", $result) ||
    //          !array_key_exists("prepay_id", $result))
    //     {
    //         $msg = "统一下单失败";
    //         return false;
    //      }
        
    //     $this->SetData("appid", $result["appid"]);
    //     $this->SetData("mch_id", $result["mch_id"]);
    //     $this->SetData("nonce_str", WxPayApi::getNonceStr());
    //     $this->SetData("prepay_id", $result["prepay_id"]);
    //     $this->SetData("result_code", "SUCCESS");
    //     $this->SetData("err_code_des", "OK");
    //     return true;
    // }
}