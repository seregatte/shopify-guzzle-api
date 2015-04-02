<?php

namespace seregatte\ShopifyGuzzleApi;

class Exception extends \Exception
{
	protected $info;

	function __construct($info)
	{
		$this->info = $info;
		parent::__construct($info['response_headers']['http_status_message'], $info['response_headers']['http_status_code']);
	}

	function getInfo() { 
		return $this->info; 
	}
}