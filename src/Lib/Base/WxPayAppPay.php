<?php
namespace Weixin\Lib\Base;

use Weixin\Lib\Base\WxPayDataBase;
/**
 *
 * 提交JSAPI输入对象
 * @author widyhu
 *
 */
class WxPayAppPay extends WxPayDataBase
{
    /**
     * 设置微信分配的公众账号ID
     * @param string $value
     **/
    public function SetAppid($value)
    {
        $this->values['appid'] = $value;
    }
    /**
     * 获取微信分配的公众账号ID的值
     * @return 值
     **/
    public function GetAppid()
    {
        return $this->values['appid'];
    }
    /**
     * 判断微信分配的公众账号ID是否存在
     * @return true 或 false
     **/
    public function IsAppidSet()
    {
        return array_key_exists('appid', $this->values);
    }

    /**
     * 设置商户号
     * @param string $value
     **/
    public function SetPartnerId($value)
    {
        $this->values['partnerid'] = $value;
    }
    /**
     * 获取商户号
     * @return 值
     **/
    public function GetPartnerId()
    {
        return $this->values['partnerid'];
    }
    /**
     * 判断商户号是否存在
     * @return true 或 false
     **/
    public function IsPartnerIdSet()
    {
        return array_key_exists('partnerid', $this->values);
    }

    /**
     * 设置预支付交易会话ID
     * @param string $value
     **/
    public function SetPrepayid($value)
    {
        $this->values['prepayid'] = $value;
    }
    /**
     * 获取预支付交易会话ID
     * @return 值
     **/
    public function GetPrepayid()
    {
        return $this->values['prepayid'];
    }
    /**
     * 判断预支付交易会话ID是否存在
     * @return true 或 false
     **/
    public function IsPrepayidSet()
    {
        return array_key_exists('prepayid', $this->values);
    }

    /**
     * 设置支付时间戳
     * @param string $value
     **/
    public function SetTimeStamp($value)
    {
        $this->values['timestamp'] = $value;
    }
    /**
     * 获取支付时间戳的值
     * @return 值
     **/
    public function GetTimeStamp()
    {
        return $this->values['timestamp'];
    }
    /**
     * 判断支付时间戳是否存在
     * @return true 或 false
     **/
    public function IsTimeStampSet()
    {
        return array_key_exists('timestamp', $this->values);
    }

    /**
     * 随机字符串
     * @param string $value
     **/
    public function SetNonceStr($value)
    {
        $this->values['noncestr'] = $value;
    }
    /**
     * 获取notify随机字符串值
     * @return 值
     **/
    public function GetReturn_code()
    {
        return $this->values['noncestr'];
    }
    /**
     * 判断随机字符串是否存在
     * @return true 或 false
     **/
    public function IsReturn_codeSet()
    {
        return array_key_exists('noncestr', $this->values);
    }


    /**
     * 设置订单详情扩展字符串
     * @param string $value
     **/
    public function SetPackage($value)
    {
        $this->values['package'] = $value;
    }
    /**
     * 获取订单详情扩展字符串的值
     * @return 值
     **/
    public function GetPackage()
    {
        return $this->values['package'];
    }
    /**
     * 判断订单详情扩展字符串是否存在
     * @return true 或 false
     **/
    public function IsPackageSet()
    {
        return array_key_exists('package', $this->values);
    }
}