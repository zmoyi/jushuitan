<?php
namespace JsTan;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use JsTan\http\Http;


class Client extends JsTanInit
{
    private static Client $instance;

    /**
     * @param string $url
     * @param array $data
     * @return Exception|GuzzleException|string
     */
    private function post(string $url,array $data): Exception|string|GuzzleException
    {
        $config = $this->getConfig();
        $http = Http::getInstance($config)->getClient();
        try {
            $response = $http->post(
                $url,
                [
                    'form_params' => $data
                ]
            );
            return $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            return $e;
        }
    }

    /**
     * @param string $url
     * @param array $data
     * @return Exception|string|GuzzleException
     * 请求接口
     */
    public function request(string $url,array $data): Exception|string|GuzzleException
    {
        $config = $this->getConfig();
        $publicRequestParams = $this->getPublicRequestParams();
        $params = Util::getInstance($publicRequestParams)->getParams($config['appSecret'], $data);
        return $this->post($url, $params);
    }

    /**
     * @return string
     * 获取授权链接
     */
    public function createAuthUrl(): string
    {
        $config = $this->getConfig();
        $data = [
            'app_key' =>$config['app_Key'],
            'timestamp' => time(),
            'charset' => $config['charset']
        ];
        $sign = Util::getSign($config['app_Secret'],$data);
        return $config['authUrl'] .
            '?app_key=' . $data['app_key'] .
            '&timestamp=' . $data['timestamp'] .
            '&charset=' . $data['charset'] .
            '&sign=' . $sign;
    }

    /**
     * @param $code
     * @return Exception|string|GuzzleException
     * 获取access_token
     */
    public function getAccessToken($code): Exception|string|GuzzleException
    {
        $data = [
            'app_key' => $this->getConfig()['app_Key'],
            'timestamp' => time(),
            'grant_type' => 'authorization_code',
            'charset' => $this->getConfig()['charset'],
            'code' => $code,
        ];
        $data['sign'] = Util::getSign($this->getConfig()['app_Secret'],$data);
        return $this->request($this->getConfig()['apiUrl']. '/getInitToken', $data);
    }

    /**
     * @param $refreshToken
     * @return Exception|string|GuzzleException
     * 刷新access_token
     */
    public function refreshToken($refreshToken): Exception|string|GuzzleException
    {
        $data = [
            'app_key' => $this->getConfig()['app_Key'],
            'timestamp' => time(),
            'grant_type' => 'refresh_token',
            'charset' => $this->getConfig()['charset'],
            'refresh_token' => $refreshToken,
            'scope' => 'all',
        ];

        $data['sign'] = Util::getSign($this->getConfig()['app_Secret'],$data);
        return $this->request($this->getConfig()['apiUrl']. '/refreshToken', $data);
    }



    /**
     * @param array $config
     * @return Client
     * 获取实例
     */
    public static function getInstance(array $config = []): Client
    {
        if(self::$instance == null){
            self::$instance = new self($config);
        }
        return self::$instance;
    }
    
}