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
	
	$json = post('https://pragma.archivelab.org/', 'application/json', $obj);
	
	if ($json != '')
	{
		$response = json_decode($json);
		
		// print_r($obj);
		
		if (isset($response->path))
		{
			// echo $response->wayback_id . "\n";
			
			// echo 'UPDATE publications SET waybackmachine="' . $response->wayback_id . '" WHERE guid="' . $url . '";' . "\n";
			echo 'UPDATE publications SET waybackmachine="' . $response->wayback_id . '" WHERE pdf="' . $url . '";' . "\n";
		}
	
	}
}

//----------------------------------------------------------------------------------------

$urls = array(
// 'http://peckhamia.com/peckhamia/PECKHAMIA_121.1.pdf',
/*
'http://peckhamia.com/peckhamia/PECKHAMIA_103.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_104.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_114.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_117.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_121.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_136.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_141.1.pdf',
*/

'http://rcin.org.pl/Content/57916/WA058_72953_P255-T40_%20Annal-Zool-Nr-11.pdf',
);

foreach ($urls as $url)
{
	archive_url($url);
	
    $rand = rand(1000000, 3000000);
    echo "\n-- ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
    usleep($rand);
}



?>




