<?php

namespace seregatte\ShopifyGuzzleApi;

class Application {

	private $_shopUrl = NULL;
	private $_apiKey = NULL;

	public function __construct($shopUrl, $apiKey){
		$this->_shopUrl = $shopUrl;
		$this->_apiKey = $apiKey;
	}

	function install_url()
	{
		return "https://" . $this->_shopUrl . "/admin/api/auth?api_key=" . $this->_apiKey;
	}


	function is_valid_request($query_params, $shared_secret)
	{
		$seconds_in_a_day = 24 * 60 * 60;
		$older_than_a_day = $query_params['timestamp'] < (time() - $seconds_in_a_day);
		if ($older_than_a_day) return false;

		$signature = $query_params['signature'];
		unset($query_params['signature']);

		foreach ($query_params as $key=>$val) $params[] = "$key=$val";
		sort($params);

		return (md5($shared_secret.implode('', $params)) === $signature);
	}


	function authorization_url($scopes=array(), $redirect_uri='')
	{
		$scopes = empty($scopes) ? '' : '&scope='.implode(',', $scopes);
		$redirect_uri = empty($redirect_uri) ? '' : '&redirect_uri='.urlencode($redirect_uri);
		return "https://" . $this->_shopUrl . "/admin/oauth/authorize?client_id=" . $this->_apiKey . "$scope$redirect_uri";
	}


	function oauth_access_token(Client $client, $shared_secret , $code)
	{
		$url = "https://" . $this->_shopUrl . "/admin/oauth/access_token";
		$client->post($url, array('client_id'=> $this->_apiKey , 'client_secret'=>$shared_secret, 'code'=>$code) );
	}

	function legacy_token_to_oauth_token($shops_token, $shared_secret, $private_app=false)
	{
		return $private_app ? $secret : md5($shared_secret.$shops_token);
	}


	function legacy_baseurl($password)
	{
		return "https://" . $this->_apiKey . ":$password@" . $this->_shopUrl . "/";

	}
}