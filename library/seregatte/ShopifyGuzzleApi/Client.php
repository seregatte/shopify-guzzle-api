<?php

namespace seregatte\ShopifyGuzzleApi;

use GuzzleHttp\Client;

class Client extends Client
{
	
	private $_shopify_token = NULL;

	function __construct($shopUrl, $shops_token, $api_key, $shared_secret, $private_app=false, array $config = [])
	{
		$this->_shopify_token = $shops_token;
		$this->_shopUrl = "https://" . $shopUrl . "/";

		$config['defaults']['headers']['X-Shopify-Access-Token'] = $this->_shopify_token;

		parent::__construct($config);
	}

	private function setVerify(array $options){
		if(!isset($options['verify'])){
			$options['verify'] = False;
		}		
	}

	function get($url = null, $ApiParams = [], $options = [])
	{
		$options = $this->setVerify($options);
		return parent::get($url = null, $options = []);
	}

	public function head($url = null, array $options = [])
    {
    	$options = $this->setVerify($options);
        return parent::head($url = null, $options = []);
    }

    public function delete($url = null, array $options = [])
    {
    	$options = $this->setVerify($options);
        return parent::delete($url = null, $options = []);
    }

    public function put($url = null, array $options = [])
    {
    	$options = $this->setVerify($options);
    	$options['headers']['Content-Type'] = "application/json; charset=utf-8;";
        return parent::put($url = null, $options = []);
    }

    public function patch($url = null, array $options = [])
    {
    	$options = $this->setVerify($options);
        return parent::patch($url = null, $options = []);
    }

    public function post($url = null, array $options = [])
    {
    	$options = $this->setVerify($options);
    	$options['headers']['Content-Type'] = "application/json; charset=utf-8;";
        return parent::post($url = null, $options = []);
    }

    public function options($url = null, array $options = [])
    {
    	$options = $this->setVerify($options);
        return parent::options($url = null, $options = []);
    }
}
