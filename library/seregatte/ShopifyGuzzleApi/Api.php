<?php
namespace seregatte\ShopifyGuzzleApi;

class Api extends \GuzzleHttp\Client
{
	
	private $_shopify_token = NULL;
    private $ApiParams = array();

	function __construct($shopUrl, $api_key, $shops_token, $shared_secret, $private_app=False, array $config = [])
	{
		$config = array();
        if(empty($shopUrl) || empty($shops_token)){
            throw new \Exception("Invalid parameters.");
        }
        $this->_shopify_token = $shops_token;
		$this->_shopUrl = "https://" . $shopUrl . "/";
        $config['base_url'] = $this->_shopUrl;
		$config['defaults']['headers']['X-Shopify-Access-Token'] = $shops_token;
        $config['defaults']['headers']['Content-Type'] = "application/json; charset=utf-8;";
		parent::__construct($config);
	}

    public function setParams($params){
        $this->ApiParams = $params;
        return $this;
    }

    public function resetParams(){
        $this->ApiParams = array();
    }

	private function setVerify(array $options){
		if(!isset($options['verify'])){
			$options['verify'] = False;
		}
        return $options;		
	}

	public function get($url = null, $options = [])
	{
		$options = $this->setVerify($options);
        $options['query'] = $this->ApiParams;
        $options->resetParams();
		return parent::get($url, $options);
	}

    public function delete($url = null, array $options = [])
    {
    	$options = $this->setVerify($options);
        $options['query'] = $this->ApiParams;
        $options->resetParams();
        return parent::delete($url, $options);
    }

    public function put($url = null, array $options = [])
    {
    	$options = $this->setVerify($options);
        $options['body'] = $this->ApiParams;
        $options->resetParams();
        return parent::put($url, $options);
    }

    public function post($url = null, array $options = [])
    {
    	$options = $this->setVerify($options);
        $options['body'] = $this->ApiParams;
        $options->resetParams();
        return parent::post($url, $options);
    }
}
