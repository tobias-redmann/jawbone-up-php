<?php

use Httpful\Request;

class UpAuth{

    const SCOPE_MOVE_READ = 'move_read';

    private $client_id;
    private $client_secret;

    CONST OAUTH_URL = 'https://jawbone.com/auth/oauth2/auth';
    CONST TOKEN_URL = 'https://jawbone.com/auth/oauth2/token';


    function __construct($client_id, $client_secret) {

        $this->client_id = $client_id;
        $this->client_secret = $client_secret;

    }



    function getAuthUrl($scope, $redirect_uri)
    {

        $params = array(

            'client_id'     => $this->client_id,
            'scope'         => implode(' ', $scope),
            'response_type' => 'code',
            'redirect_uri'  => $redirect_uri

        );


        return self::OAUTH_URL.'?'. http_build_query($params);


    }


    function getAccessToken($code)
    {

        $params = array(

            'code'          => $code,
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type'    => 'authorization_code'

        );

        $response = Request::post(self::TOKEN_URL)->body($params)->sendsForm()->send();

        $data = json_decode($response->raw_body);

        return $data->access_token;

    }

}

class Up {

    const UP_MOVES_ENDPOINT = 'https://jawbone.com/nudge/api/v.1.1/users/@me/moves';


    private $token = '';

    function __construct($token) {

        $this->token = $token;

    }

    function getMoves($date = '')
    {

        $params = array('date' => date("Ymd"));

        return $this->apiGet(self::UP_MOVES_ENDPOINT, $params);

    }



    private function apiGet($url, $params) {

        $_url = $url. '?' . http_build_query($params);

        $req = Request::get($_url);

        $req->addHeader("Authorization", "Bearer ". $this->token);

        $response = $req->send();

        return json_decode($response->raw_body);






    }


}