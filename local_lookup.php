<?php

// Lookup local records that don't have a URL 


require_once (dirname(__FILE__) . '/wikidata.php');


$guids=array(
"7d9ae677d6eb6a4591040c2beaf800b1",
"db1a2fdf5ceee65adf86d98486e910a4",
"946e5639156968a9e63d780b4443e1a1",
"f33921ef246409b6f0a52647e0a48572",
"4bb69d492c748f78322b75b77f09cc39",
"9ff8287827dcc90d4ebad4abe43ff0f6",
"c367b53cdc0518d022b914171bf701a6",
"7951962d52911ed9d8b908a989090bc6",
"0a755e1fb20a73d334d43c988492cf02",
"364c9ad1e67d458ee58f0c74d4b391d3",
"46df32144620c0fea422a566a27d93f2",
"5da9e3a0253bbe210f6c92b3089f9223",
"32682a12ad1722314f920496351815df",
"de3a935854d5f1c313631090a166a98c",
"d6b7cbe9839f5c7ec2fd117a45c0efd8",
"d74967bc26eedf0f70265a4307117327",
"ee4d4fa625950751738cfdc67c6c20af",
"fa42bf8efd77b54d761696a10723de7b",
"e3075715901f94a178c156b699f1eeec",
"19a17f8a8d598f901403524063336711",
"2a0ff976f85d254270f1a765fadb1998",
"e9ae2df4d377429dc0d735298c59bce6",
"2f39f7068828e567c63c939628b3d3b9",
"712c6a027d07f764b80285f1499fe34e",
"422f896e63d1b5cf0fe8ee63d73cdeab",
"e56fff8971c67a1fbd04ae3374068a3f",
"991c478e52580bc2f5ab7df9bdaf4760",
"88934080a5a8a771db01d0379b6ead6e",
"f02fda0c6de062fc60d83be254af736e",
"df9fdf8942d59717c7b0f60d64475e59",
"38357117c88f7708b15fcb9622f55541",
"e977427f8acc99e9e1fe5d05d8db4b1f",
"961c19f07a6d5c7705da3b25de51d525",
"7b4ad60d0276f77c238ffd5d8dad63a1",
"66be440ffce49c60f311f23443885c3b",
"03a522a3574015d465097a3499df60ec",
"ae98d7bcf6d0782ef0681bc17088a2eb",
"3dfe34edb313c1f4dd59e867ed17a37d",
"a56fbb363c4720e355bcd80145f411fa",
"b5dea215b248ab7de67af6092ee1bd3d",
"4440e111937c7697a0667dc3acdd82f3",
"b6b15fbd09ecd9e3a1a3d7b6b3251c51",
"774eff2c48682823e5b1ad51c7215de8",
"73b0ab5863795f658e3a135b08b51f13",
"89534de267bb618114b93aee3d5fb908",
"4cdd9fde238aa0b72768bb32cfa341b6",
"71f1e2c312a5b5b074fdb9027e1012ff",
"2606fd83100e76f6e153d30f89f61bce",
"21336439964474c1adfee14be26a3832",
"674e9a70459c3a38d18673ac6ec4caee",
"077d3cbe91409c947c042045f894e28a",
"0381cde59c2eab78ffe4607cd7d88cc2",
"5ffeccf46cfe8366657ee9feca249ff5",
"d8f48700efd9a1be3509829d22f24ede",
"498dd6b9e1b55af1d0de3bcd31dd8d68",
"ddcaf8965d9d9804d5512b5bef72a7c9",
"c1366641e4a495955185a3c94c611734",
"de7d3e00e670ef844efe6a562ecfeda3",
);

$count = 0;

/*
$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
*/


foreach ($guids as $guid)	
{
	echo "-- $guid\n";
	
	$url = 'http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($guid);

	$json = get($url);
	

	$obj = json_decode($json);

	// print_r($obj);
	
	
	$item = '';
		
	$parts = array();
	
	if (isset($obj->ISSN))
	{
		$parts[] = $obj->ISSN[0];

		if (isset($obj->volume))
		{
			$parts[] = $obj->volume;
		}
		if (isset($obj->page))
		{
			if (preg_match('/^(?<spage>\d+)(-\d+)?/', $obj->page, $m))
			{
				$parts[] = $m['spage'];
			}
		}
		if (isset($obj->issued))
		{
			$parts[] = $obj->issued->{'date-parts'}[0][0];
		}	
	
		// print_r($parts);
	
		if (count($parts == 4))
		{
			$item = wikidata_item_from_openurl_issn($parts[0], $parts[1], $parts[2], $parts[3]);

		}
	}
	else
	{
		$parts[] = $obj->{'container-title'};

		if (isset($obj->volume))
		{
			$parts[] = $obj->volume;
		}
		if (isset($obj->page))
		{
			if (preg_match('/^(?<spage>\d+)(-\d+)?/', $obj->page, $m))
			{
				$parts[] = $m['spage'];
			}
		}
		if (isset($obj->issued))
		{
			$parts[] = $obj->issued->{'date-parts'}[0][0];
		}	
	
		// print_r($parts);
	
		if (count($parts == 4))
		{
			$item = wikidata_item_from_openurl_journal($parts[0], $parts[1], $parts[2], $parts[3]);

		}	
	
	
	}
	
	
	if ($item != '')
	{
		echo "-- Found: $item\n";
		echo "UPDATE publications SET wikidata='$item' WHERE guid='$guid';\n";
		//$ok = false;
	}
	else
	{
		echo "-- Not found\n";
	}	

	

	
	// Give server a break every 10 items
	if (($count++ % 10) == 0)
	{
		$rand = rand(1000000, 3000000);
		//echo "\n-- ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
		usleep($rand);
	}


}

f// close($file_handle);

?>
