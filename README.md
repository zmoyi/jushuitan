# jushuitan
聚水潭 php sdk
### config全局配置
```php
$config = [
    'authUrl' => 'https://openweb.jushuitan.com/auth',
    'baseUrl' =>'https://dev-api.jushuitan.com/',
    'app_Key' => 'b0b7d1db226d4216a3d58df9ffa2dde5',
    'app_Secret'=> '99c4cef262f34ca882975a7064de0b87',
    'access_token' => 'b7e3b1e24e174593af8ca5c397e53dad'
];
```
### api调用
```php 
$response = new ApiRes($config);

$response->getxxx();
```
