# ShopifyGuzzleApi
A Wrapper using Guzzle for a Shopify API and compatible with Google AppEngine

This library is mean to be a Oriented Object Way to access a Shopify Api using the Guzzle instead of CURL, because of that, this library is compatible with Google App Engine.

##Usage

What you need to do for get this library, is putting the following code into your composer.json file:

```
"require": {
     "seregatte/shopify-guzzle-api: "*",
}
```

And to use our library into you PHP code, like this:

```php
<?php
require_once __DIR__.'/vendor/autoload.php';
use seregatte\ShopifyGuzzleApi;

$shopId = 'shopname.myshopify.com';
$shopToken = 'XXXXXXXXXXXXX';
$app_api_key = 'XXXXXXXXXXXXX'; //App Api Key
$app_credential_secret = 'XXXXXXXXXXXXXX'; //App Credential Sets

$client = new ShopifyGuzzleApi\Api(
				$shopId, 
				$app_api_key, 
				$shopToken, 
				$app_credential_secret
		);

$p = ['published_status'=>'published'];

$response = $client->setParams($p)->get('/admin/products.json');

$json = $response->json();

var_dump($json['products'])
```

### TODO

- Make a better documentation, with more examples.
- Cover the code with unit tests.
- Make a Skeleton App using this library.
