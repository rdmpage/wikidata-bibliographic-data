<?php

// Add to wayback using GET

//----------------------------------------------------------------------------------------
function get($url, $user_agent='', $content_type = '')
{	
	$data = null;

	$opts = array(
	  CURLOPT_URL =>$url,
	  CURLOPT_FOLLOWLOCATION => TRUE,
	  CURLOPT_RETURNTRANSFER => TRUE
	);

	if ($content_type != '')
	{
		
		$opts[CURLOPT_HTTPHEADER] = array(
			"Accept: " . $content_type, 
			"User-agent: Mozilla/5.0 (iPad; U; CPU OS 3_2_1 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Mobile/7B405" 
		);
		
	}
	
	$ch = curl_init();
	curl_setopt_array($ch, $opts);
	$data = curl_exec($ch);
	$info = curl_getinfo($ch); 
	curl_close($ch);
	
	return $data;
}

//----------------------------------------------------------------------------------------
function get_redirect($url)
{
	global $config;
	
	$redirect = '';
	
	$ch = curl_init(); 
	curl_setopt ($ch, CURLOPT_URL, $url); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION,  0); 
	curl_setopt ($ch, CURLOPT_HEADER,		  1);  
	
	// timeout (seconds)
	curl_setopt ($ch, CURLOPT_TIMEOUT, 240);
	
	
	$headers = array(
		'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
		/*'Accept-encoding: gzip, deflate',*/
		'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
		'Accept-Language: en-gb',
	);
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);	
			
	$curl_result = curl_exec ($ch); 
	
	//echo $curl_result;
	//exit();
	
	if (curl_errno ($ch) != 0 )
	{
		echo "CURL error: ", curl_errno ($ch), " ", curl_error($ch);
	}
	else
	{
		$info = curl_getinfo($ch);
		
		//print_r($info);
		 
		$header = substr($curl_result, 0, $info['header_size']);
		echo $header;
		
		
		$http_code = $info['http_code'];
		
		if ($http_code == 303)
		{
			$redirect = $info['redirect_url'];
		}
		
		if ($http_code == 302)
		{
			$redirect = $info['redirect_url'];
		}
		
	}
	return $redirect;
}

//----------------------------------------------------------------------------------------
$filename = 'urls-wayback.txt';

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$source_url = trim(fgets($file_handle));
	echo "-- $source_url\n";
	
	
	$wayback_url = '';
	
	$url = 'http://archive.org/wayback/available?url=' . urlencode($source_url);
	$json = get($url);
	if ($json != '')
	{
		//echo $json;
	
		$obj = json_decode($json);
		
		if (isset($obj->archived_snapshots->closest))
		{
			if ($obj->archived_snapshots->closest->available)
			{
				$wayback_url = $obj->archived_snapshots->closest->url;
				
				echo "-- [in wayback machine already]\n";
			}			
		}
	}
	
	if ($wayback_url == '')
	{
		echo "-- [adding to wayback machine...]\n";
		
		$url = 'https://web.archive.org/save/' . $source_url;
	
		$wayback_url = get_redirect($url);
	}
	
	echo "-- [wayback url] $wayback_url\n";
	
	if ($wayback_url != '')
	{
		// SQL 
		echo 'UPDATE publications SET waybackmachine="' . $wayback_url . '" WHERE pdf="' . $source_url . '";' . "\n\n";	
	}
		
    $rand = rand(1000000, 3000000);
    echo "\n-- ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
    usleep($rand);	

}

fclose($file_handle);




?>
