<?php

class pddRequest
{
    public $host = 'http://gw-api.pinduoduo.com/api/router';
    public $client_id = '3848a2b714c944b1866fe575199781e2';
    public $client_secret = '9f2c45c3b01e9634d17d71018b48b36df469146b';
    public $access_token = '';
    public $timestamp = '';
    public $data_type = 'JSON';
    public $version = 'V1';
    public $type = '';

    function getPublicParams($t)
    {
        $type = $this->type;

        return array(
            'type' =>  $type,
            'client_id' => $this->client_id,
            'timestamp' => $t,
            'access_token' => $this->access_token,
            'data_type' => $this->data_type,
            'version' => $this->version,
        );
    }

    function getSign($params = array())
    {
        ksort($params);

        $str = $this->client_secret;
        foreach ($params as $k => $v) {
            $str .= $k . $v;
        }
        $str .= $this->client_secret;

        return strtoupper(md5($str));
    }

    function request($params = array())
    {
        $t = time();

        try {
            $pubic_params = $this->getPublicParams($t);
            $params = array_merge($pubic_params, $params);
            $sign = $this->getSign($params);
            $params['sign'] = $sign;
            $url = $this->host . '?' . http_build_query($params);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_URL, $this->host);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $header = [
                'Content-Type: application/json'
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            // curl_setopt($ch, CURLOPT_POST, true);            
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

            $output = curl_exec($ch);
            $a = curl_error($ch);
            if (!empty($a)) {
                return json_encode(array('code' => -10003, 'msg' => $a));
            }
            curl_close($ch);
            return $output;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return json_encode(array('code' => -10002, 'msg' => "请求超时或异常，请重试"));
        }
    }
}
