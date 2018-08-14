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
}