<?php

class HdkRequest
{
    // http://v2.api.haodanku.com/sales_list/apikey/C6C1755E8903/sale_type/1
    public $host = 'http://v2.api.haodanku.com/';
    public $method = '';
    public $apikey = 'C6C1755E8903';

    /**拼接Url
     * @param $data
     * @return string
     */
    function createUrl($data = [])
    {
        $str = '';
        $data['apikey'] = $this->apikey;
        foreach ($data as $k => $v) {
            $str .= '/' . $k . '/' . $v;
        }
        return $str;
    }

    function request($params, $type = "GET")
    {
        $type = strtoupper($type);
        if (!in_array($type, array("GET", "POST"))) {
            return json_encode(array('code' => -10001, 'msg' => "只支持GET/POST请求"));
        }

        try {
            $url = $this->host . $this->method;
            $data = $type == 'POST' ? '' : $params;
            $url = $this->host . $this->method . self::createUrl($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, []);
            if ($type == 'POST') {
                //https调用
                //curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                //curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            }
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
