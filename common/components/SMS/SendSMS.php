<?php

namespace common\components\SMS;

use yii\base\Model;

/**
 * 发送短信
 *
 * Class SendSMS
 * @package common\components\SMS
 */
class SendSMS extends Model
{
    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
    private $_accountSid = '8a216da85b602cda015b6616d55a03e6';
    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    private $_accountToken = 'c9c0bf64352d4da98e37391b7a2f8cb6';
    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    private $_appId = '8a216da85b602cda015b6616d6ec03ec';
    //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    private $_serverIP = 'sandboxapp.cloopen.com';
    //请求端口，生产环境和沙盒环境一致
    private $_serverPort = '8883';
    //REST版本号，在官网文档REST介绍中获得。
    private $_softVersion = '2013-12-26';
    //时间戳
    private $_batch;
    //包体格式，可填值：json 、xml
    private $_bodyType = "json";
    //日志开关。可填值：true、
    private $_enableLog = true;
    //日志文件
    private $_filename="./log.txt";
    private $_handle;

    function __construct($config = null)
    {
        $this->_batch = date("YmdHis");
        $this->_handle = fopen($this->_filename, 'a');
        parent::__construct($config);
    }

    /**
     * 设置主帐号
     *
     * @param $AccountSid 主帐号
     * @param $AccountToken 主帐号Token
     */
    function setAccount($AccountSid,$AccountToken){
        $this->_accountSid = $AccountSid;
        $this->_accountToken = $AccountToken;
    }


    /**
     * 设置应用ID
     *
     * @param $AppId 应用ID
     */
    function setAppId($AppId){
        $this->_appId = $AppId;
    }

    /**
     * 打印日志
     *
     * @param $log 日志内容
     */
    function showLog($log){
        if($this->_enableLog){
            fwrite($this->_handle,$log."\n");
        }
    }

    /**
     * 发起HTTPS请求
     */
    function curl_post($url,$data,$header,$post=1)
    {
        //初始化curl
        $ch = curl_init();
        //参数设置
        $res= curl_setopt ($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, $post);
        if($post)
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        $result = curl_exec ($ch);
        //连接失败
        if($result == FALSE){
            if($this->_bodyType=='json'){
                $result = "{\"statusCode\":\"172001\",\"statusMsg\":\"网络错误\"}";
            } else {
                $result = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><Response><statusCode>172001</statusCode><statusMsg>网络错误</statusMsg></Response>";
            }
        }

        curl_close($ch);
        return $result;
    }


    /**
     * 发送模板短信
     *
     * @param $to 短信接收彿手机号码集合,用英文逗号分开
     * @param $datas 内容数据
     * @param $tempId 模板Id
     * @return 内容数据|mixed|\SimpleXMLElement
     */
    function sendTemplateSMS($to,$datas,$tempId)
    {
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体
        if($this->_bodyType=="json"){
            $data="";
            for($i=0;$i<count($datas);$i++){
                $data = $data. "'".$datas[$i]."',";
            }
            $body= "{'to':'$to','templateId':'$tempId','appId':'$this->_appId','datas':[".$data."]}";
        }else{
            $data="";
            for($i=0;$i<count($datas);$i++){
                $data = $data. "<data>".$datas[$i]."</data>";
            }
            $body="<TemplateSMS><to>$to</to> <appId>$this->AppId</appId><templateId>$tempId</templateId><datas>".$data."</datas></TemplateSMS>";
        }
        $this->showLog("request body = ".$body);
        // 大写的sig参数.
        $sig =  strtoupper(md5($this->_accountSid . $this->_accountToken . $this->_batch));
        // 生成请求URL
        $url="https://$this->_serverIP:$this->_serverPort/$this->_softVersion/Accounts/$this->_accountSid/SMS/TemplateSMS?sig=$sig";
        $this->showLog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->_accountSid . ":" . $this->_batch);
        // 生成包头
        $header = array("Accept:application/$this->_bodyType","Content-Type:application/$this->_bodyType;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,$body,$header);
        $this->showLog("response body = ".$result);
        if($this->_bodyType=="json"){//JSON格式
            $datas=json_decode($result);
        }else{ //xml格式
            $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
          if($datas == FALSE){
            $datas = new \stdClass();
            $datas->statusCode = '172003';
            $datas->statusMsg = '返回包体错误';
        }
        //重新装填数据
        if($datas->statusCode==0){
            if($this->_bodyType=="json"){
                $datas->TemplateSMS =$datas->templateSMS;
                unset($datas->templateSMS);
            }
        }

        return $datas;
    }

    /**
     * 主帐号鉴权
     */
    function accAuth()
    {
        if($this->_serverIP == ""){
            $data = new \stdClass();
            $data->statusCode = '172004';
            $data->statusMsg = 'IP为空';
            return $data;
        }
        if($this->_serverPort <= 0){
            $data = new \stdClass();
            $data->statusCode = '172005';
            $data->statusMsg = '端口错误（小于等于0）';
            return $data;
        }
        if($this->_softVersion == ""){
            $data = new \stdClass();
            $data->statusCode = '172013';
            $data->statusMsg = '版本号为空';
            return $data;
        }
        if($this->_accountSid == ""){
            $data = new \stdClass();
            $data->statusCode = '172006';
            $data->statusMsg = '主帐号为空';
            return $data;
        }
        if($this->_accountToken == ""){
            $data = new \stdClass();
            $data->statusCode = '172007';
            $data->statusMsg = '主帐号令牌为空';
            return $data;
        }
        if($this->_appId == ""){
            $data = new \stdClass();
            $data->statusCode = '172012';
            $data->statusMsg = '应用ID为空';
            return $data;
        }
    }
}