<?php

//----------------------------------------------------------------------------------------
// post
function post($url, $format = 'application/json', $data =  null)
{
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
	curl_setopt($ch, CURLOPT_HTTPHEADER, 
		array(
			"Accept: " . $format, 
			"User-agent: Mozilla/5.0 (iPad; U; CPU OS 3_2_1 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Mobile/7B405"
			)
		);
		

	$response = curl_exec($ch);
	if($response == FALSE) 
	{
		$errorText = curl_error($ch);
		curl_close($ch);
		die($errorText);
	}
	
	$info = curl_getinfo($ch);
	$http_code = $info['http_code'];
		
	curl_close($ch);
	
	return $response;
}


//----------------------------------------------------------------------------------------
function archive_url($url)
{
	$obj = new stdclass;
	$obj->url = $url;
	
	$obj->url = str_replace(';', '%3B', $obj->url);
	$obj->url = str_replace('?', '%3F', $obj->url);
	
	$json = post('https://pragma.archivelab.org/', 'application/json', $obj);
	
	if ($json != '')
	{
		$response = json_decode($json);
		
		print_r($response);
		
		if (isset($response->path))
		{
			// echo $response->wayback_id . "\n";
			
			// echo 'UPDATE publications SET waybackmachine="' . $response->wayback_id . '" WHERE guid="' . $url . '";' . "\n";
			echo 'UPDATE publications SET waybackmachine="' . $response->wayback_id . '" WHERE pdf="' . $url . '";' . "\n";
		}
	
	}
}

//----------------------------------------------------------------------------------------
$filename = 'urls-wayback.txt';

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$url = trim(fgets($file_handle));
	
	archive_url($url);
	
	
    $rand = rand(1000000, 3000000);
    echo "\n-- ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
    usleep($rand);	

}

fclose($file_handle);




?>




