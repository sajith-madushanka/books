<?php

if (! $app->runningInConsole()) {
		$site_url ='http://';
		$site_url .= request()->getHttpHost().'/';
	
   }
   else{
	   $site_url = "http://localhost";
   }


return [
	'SITE_URL' => $site_url,
];