# StackOverflow Provider for HybridAuth

##Tutorial
Create your stack App at http://stackapps.com/apps/oauth/register

###config.php
```php
return array(
  ...
  "providers" => array(
	...
    "StackOverflow" => array(
      "enabled" => true,
      "keys" => array("id" => YOUR_CLIENT_ID, "secret" => YOUR_SECRET, "key"	=> YOUR_KEY)
    ),
  ...
  ),
	...
);
```

###Usage
```php
require_once( 'hybridauth/Hybrid/Auth.php' );

// initialize Hybrid_Auth class with the config file
$hybridauth = new Hybrid_Auth( $config );

// try to authenticate with the selected provider
$adapter = $hybridauth->authenticate("stackoverflow");

// then grab the user profile
$user_profile = $adapter->getUserProfile();
```
