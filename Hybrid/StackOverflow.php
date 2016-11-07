<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
*  (c) 2009-2011 HybridAuth authors | hybridauth.sourceforge.net/licenses.html
*/

/**
 * Hybrid_Providers_StackOverflow
 */
class Hybrid_Providers_StackOverflow extends Hybrid_Provider_Model_OAuth2
{
	// default permissions
	// (no scope) => public read-only access (includes public user profile info, public repo info, and gists).
	public $scope = "";

	/**
	* IDp wrappers initializer
	*/
	function initialize()
	{
		parent::initialize();

		// Provider api end-points
		$this->api->api_base_url  = "https://api.stackexchange.com/";
		$this->api->authorize_url = "https://stackexchange.com/oauth";
		$this->api->token_url     = "https://stackexchange.com/oauth/access_token";
	}

	/**
	* load the user profile from the IDp api client
	*/
	function getUserProfile()
	{
		$data = $this->api->api( "me", "GET", array(
			'site'	=> 'stackoverflow',
			'key'	=> $this->config['keys']['key']
		));

		if ( ! isset( $data->items[0]->user_id ) ){
			throw new Exception( "User profile request failed! {$this->providerId} returned an invalid response.", 6 );
		}
		
		$this->user->profile->identifier  = @ $data->items[0]->user_id;
		$this->user->profile->displayName = @ $data->items[0]->display_name;
		$this->user->profile->photoURL    = @ $data->items[0]->profile_image;
		$this->user->profile->profileURL  = @ $data->items[0]->link;
		$this->user->profile->webSiteURL  = @ $data->items[0]->website_url;
		
		

		return $this->user->profile;
	}
}
