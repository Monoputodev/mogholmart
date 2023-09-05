<?php

namespace App\Http\Helpers;

class RestCall
{
	public static function callAPI($consumerKey,$consumerSecret, $authType,$resourceUrl,$method)
    {
        try {
              
            	$oauthClient = new \OAuth($consumerKey, $consumerSecret, OAUTH_SIG_METHOD_HMACSHA1, $authType);

            	$oauthClient->enableDebug();
                $oauthClient->disableSSLChecks();
                
                

            	$oauthClient->setToken(config('global.secretToken'), config('global.secretKey'));
                
                //$oauth->setToken("token","token-secret");

            	$starttime = microtime(true);

            	$oauthClient->fetch($resourceUrl, array(), $method, 
            		array('Content-Type' => 'application/json',
            			'Accept' => '*/*'));

	            /*$endtime = microtime(true);
	            echo $diff = $endtime - $starttime;*/
	            //echo '<pre>';
	            //print_r($oauthClient);

            
            	return $oauthClient;
            
        	} catch (OAuthException $e) {
	        	echo '<pre>';
	        	print_r($e);
	        	echo '</pre>';
        }

    }

}