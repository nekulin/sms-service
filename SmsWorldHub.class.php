<?php

class SmsWorldHub
{
    CONST CODE_OK = 200;
    CONST URL = 'https://api.smsworldhub.com/v1/';

    private $_token;

    public function __construct($token)
    {
        $this->_token = $token;
    }

    /**
     * @param string $phone
     * @param string $mes
     * @param null|float $costUsd
     * @param null|float $costRur
     * @param int $lifeTime
     * @return array
     */
    public function send($phone, $mes, $costUsd=null, $costRur=null, $lifeTime=24)
    {
        return $this->query('send', [
            'phone' => $phone,
            'mes' => $mes,
            'costUsd' => $costUsd,
            'costRur' => $costRur,
            'lifeTime' => $lifeTime,
        ]);
    }

    /**
     * @param string $method
     * @param array $params
     * @return array
     */
    private function query($method, array $params=[])
    {
        $params['token'] = $this->_token;
        $url = self::URL .  $method .  '?' . http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
