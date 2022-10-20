<?php

// Import DOIs as SQL


require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/wikidata.php');

//----------------------------------------------------------------------------------------
// Convert a simple CSL object to SQL
function csl_to_sql($csl)
{
	$keys = array();
	$values = array();
	
	$guid = '';
	
	if ($guid == '')
	{
		if (isset($csl->DOI))
		{
			$guid = $csl->DOI;
		}
	}
	
	if ($guid == '')
	{
		$guid = uniqid();
	}

	$keys[] = 'guid';
	$values[] = '"' . $guid . '"';
	
	$multilingual_keys = array();
	$multilingual_values = array();
	
	$pdf = ''; // just want one PDF
	
	foreach ($csl as $k => $v)
	{
		switch ($k)
		{
			case 'DOI':
				$keys[] ='doi';
				$values[] = '"' . $v . '"';	
				break;			
			
			case 'volume':
			case 'issue':
				$keys[] = $k;
				$values[] = '"' . $v . '"';	
				break;	
	
			case 'container-title':
				if (is_array($v) && count($v) > 0)
				{
					$keys[] = 'journal';
					$values[] = '"' . addcslashes($v[0], '"') . '"';					
				}
				else 
				{
					$keys[] = 'journal';
					$values[] = '"' . addcslashes($v, '"') . '"';					
				}
				break;

			case 'title':
				if (is_array($v) && count($v) > 0)
				{
					$keys[] = 'title';
					$values[] = '"' . addcslashes($v[0], '"') . '"';					
				}
				else 
				{
					$keys[] = 'title';
					$values[] = '"' . addcslashes($v, '"') . '"';	
					
					/*
					$language = 'en';

					if (preg_match('/\p{Han}+/u', $v))
					{
						$language = 'zh';
					}
		
					// multilingual
					$kk = array();
					$vv = array();
					$kk[] = "`key`";
					$vv[] = '"title"';

					$kk[] = 'language';
					$vv[] = '"' . $language . '"';
			
					$kk[] = 'value';
					$vv[] = '"' . addcslashes($v, '"') . '"';

					$multilingual_keys[] = $kk;
					$multilingual_values[] = $vv;
					*/														
				}
				break;

			case 'ISSN':
				if (is_array($v))
				{
					$keys[] = 'issn';
					$values[] = '"' . addcslashes($v[0], '"') . '"';					
				}
				else 
				{
					$keys[] = 'issn';
					$values[] = '"' . addcslashes($v, '"') . '"';					
				}
				break;
	
			case 'issued':
				$keys[] = 'year';
				$values[] = '"' . $v->{'date-parts'}[0][0] . '"';		
				
				$date = array();
				
				if (count($v->{'date-parts'}[0]) > 0) $date[] = $v->{'date-parts'}[0][0];
				if (count($v->{'date-parts'}[0]) > 1) $date[] = str_pad($v->{'date-parts'}[0][1], 2, '0', STR_PAD_LEFT);
				if (count($v->{'date-parts'}[0]) > 2) $date[] = str_pad($v->{'date-parts'}[0][2], 2, '0', STR_PAD_LEFT);

				if (count($date) == 1)
				{
					$date[] = '00';
					$date[] = '00';
				}

				if (count($date) == 2)
				{
					$date[] = '00';
				}
								
				if (count($date) == 3)
				{
					$keys[] = 'date';
					$values[] = '"' . join('-', $date) . '"';						
				}
							
				break;
	
			case 'page':
				if (preg_match('/(?<spage>\d+)-(?<epage>\d+)/', $v, $m))
				{
					$keys[] = 'spage';
					$values[] = '"' . $m['spage'] . '"';					

					$keys[] = 'epage';
					$values[] = '"' . $m['epage'] . '"';					

				}
				else
				{
					$keys[] = 'spage';
					$values[] = '"' . $v . '"';					
		
				}
				break;
			
			case 'article-number':
				$keys[] = 'article_number';
				$values[] = '"' . $v . '"';							
				break;
				
			case 'author':
				$authors = array();
				
				foreach ($v as $author)
				{
					if (isset($author->family))
					{
						$authors[] = $author->given . ' ' . $author->family;
					}
					else
					{
						if (isset($author->literal))
						{
							$authors[] = $author->literal;
						}
					}
				}
				
				if (count($authors) > 0)
				{
	
					$keys[] = 'authors';
					$values[] = '"' . join(';', $authors) . '"';						
				}
				break;
		
			case 'link':
				foreach ($v as $link)
				{
					if (($link->{'content-type'} == 'application/pdf') && ($pdf == ''))
					{
						$keys[] = 'pdf';
						$values[] = '"' . $link->URL . '"';		
					
						$pdf = $link->URL;	
					}
					
					// JALC typically has content-type = "unspecified"
					if (preg_match('/_pdf$/', $link->URL) && ($pdf == ''))
					{
						$keys[] = 'pdf';
						$values[] = '"' . $link->URL . '"';		
					
						$pdf = $link->URL;	
					}
					
				}					
				break;

			default:
				break;
		}
	}
	
	$sql = 'REPLACE INTO publications(' . join(',', $keys) . ') VALUES (' . join(',', $values) . ');' . "\n";

	/*	
	$n = count($multilingual_keys);
	for($i =0; $i < $n; $i++)
	{
		$multilingual_keys[$i][] = 'guid';
		$multilingual_values[$i][] = '"' . $guid . '"';

		$sql .= 'REPLACE INTO multilingual(' . join(',', $multilingual_keys[$i]) . ') values('
			. join(',', $multilingual_values[$i]) . ');' . "\n";
	}
	*/
	
	return $sql;

}



$dois=array();


$dois=array(
"10.12782/sd.17.1.007",
"10.12782/sd.17.1.015",
"10.12782/sd.17.1.021",
"10.12782/sd.17.1.029",
"10.12782/sd.17.1.039",
"10.12782/sd.17.1.049",
"10.12782/sd.17.1.087",
"10.12782/sd.17.1.097",
"10.12782/sd.17.1.109",
"10.12782/sd.17.2.123",
"10.12782/sd.17.2.127",
"10.12782/sd.17.2.135",
"10.12782/sd.17.2.145",
"10.12782/sd.17.2.151",
"10.12782/sd.17.2.161",
"10.12782/sd.17.2.169",
"10.12782/sd.17.2.173",
"10.12782/sd.17.2.177",
"10.12782/sd.17.2.187",
"10.12782/sd.17.2.201",
"10.12782/sd.17.2.221",
"10.12782/sd.17.2.227",
"10.12782/sd.17.2.235",
"10.12782/sd.18.1.001",
"10.12782/sd.18.1.009",
"10.12782/sd.18.1.015",
"10.12782/sd.18.1.023",
"10.12782/sd.18.1.033",
"10.12782/sd.18.1.039",
"10.12782/sd.18.1.045",
"10.12782/sd.18.1.057",
"10.12782/sd.18.1.075",
"10.12782/sd.18.1.087",
"10.12782/sd.18.1.099",
"10.12782/sd.18.1.105",
"10.12782/sd.18.1.111",
"10.12782/sd.18.2.141",
"10.12782/sd.18.2.163",
"10.12782/sd.18.2.175",
"10.12782/sd.18.2.183",
"10.12782/sd.18.2.193",
"10.12782/sd.18.2.215",
"10.12782/sd.18.2.223",
"10.12782/sd.18.2.237",
"10.12782/sd.18.2.245",
"10.12782/sd.18.2.255",
"10.12782/sd.18.2.269",
"10.12782/sd.18.2.281",
"10.12782/sd.19.1.001",
"10.12782/sd.19.1.009",
"10.12782/sd.19.1.015",
"10.12782/sd.19.1.021",
"10.12782/sd.19.1.035",
"10.12782/sd.19.1.043",
"10.12782/sd.19.1.059",
"10.12782/sd.19.1.071",
"10.12782/sd.19.2.085",
"10.12782/sd.19.2.091",
"10.12782/sd.19.2.097",
"10.12782/sd.19.2.111",
"10.12782/sd.19.2.117",
"10.12782/sd.19.2.133",
"10.12782/sd.19.2.141",
"10.12782/sd.19.2.151",
"10.12782/sd.19.2.157",
"10.12782/sd.19.2.167",
"10.12782/sd.19.2.173",
"10.12782/sd.20.1.001",
"10.12782/sd.20.1.013",
"10.12782/sd.20.1.019",
"10.12782/sd.20.1.023",
"10.12782/sd.20.1.029",
"10.12782/sd.20.1.037",
"10.12782/sd.20.1.045",
"10.12782/sd.20.1.059",
"10.12782/sd.20.1.067",
"10.12782/sd.20.1.073",
"10.12782/sd.20.1.083",
"10.12782/sd.20.1.089",
"10.12782/sd.20.1.095",
"10.12782/sd.20.2.107",
"10.12782/sd.20.2.115",
"10.12782/sd.20.2.121",
"10.12782/sd.20.2.129",
"10.12782/sd.20.2.135",
"10.12782/sd.20.2.141",
"10.12782/sd.20.2.153",
"10.12782/sd.20.2.159",
"10.12782/sd.20.2.167",
"10.12782/sd.20.2.183",
"10.12782/sd.20.2.191",
"10.12782/sd.20.2.199",
"10.12782/sd.21.1.001",
"10.12782/sd.21.1.009",
"10.12782/sd.21.1.031",
"10.12782/sd.21.1.043",
"10.12782/sd.21.1.049",
"10.12782/sd.21.1.055",
"10.12782/sd.21.1.065",
"10.12782/sd.21.1.071",
"10.12782/sd.21.1.079",
"10.12782/sd.21.1.085",
"10.12782/sd.21.2.095",
"10.12782/sd.21.2.105",
"10.12782/sd.21.2.111",
"10.12782/sd.21.2.117",
"10.12782/sd.21.2.127",
"10.12782/sd.21.2.135",
"10.12782/sd.21.2.143",
"10.12782/sd.21.2.151",
"10.12782/sd.21.2.161",
"10.12782/sd.21.2.171",
"10.12782/sd.21.2.177",
"10.12782/sd.21.2.187",
"10.12782/sd.22_73",
"10.12782/sd.22_7",
"10.12782/sd.22_87",
"10.12782/sd.22_99",
"10.12782/sd.22_53",
"10.12782/sd.22_29",
"10.12782/sd.22_69",
"10.12782/sd.22_45",
"10.12782/sd.22_81",
"10.12782/sd.22_1",
"10.12782/sd.22_37",
"10.12782/specdiv.22.109",
"10.12782/specdiv.22.133",
"10.12782/specdiv.22.207",
"10.12782/specdiv.22.161",
"10.12782/specdiv.22.175",
"10.12782/specdiv.22.117",
"10.12782/specdiv.22.201",
"10.12782/specdiv.22.213",
"10.12782/specdiv.22.127",
"10.12782/specdiv.22.225",
"10.12782/specdiv.22.167",
"10.12782/specdiv.22.151",
"10.12782/specdiv.22.219",
"10.12782/specdiv.22.143",
"10.12782/specdiv.22.187",
"10.12782/specdiv.14.131",
"10.12782/specdiv.13.231",
"10.12782/specdiv.14.137",
"10.12782/specdiv.11.45",
"10.12782/specdiv.14.157",
"10.12782/specdiv.14.165",
"10.12782/specdiv.10.185",
"10.12782/specdiv.10.231",
"10.12782/specdiv.13.73",
"10.12782/specdiv.1.111",
"10.12782/specdiv.10.63",
"10.12782/specdiv.14.207",
"10.12782/specdiv.14.249",
"10.12782/specdiv.14.297",
"10.12782/specdiv.14.217",
"10.12782/specdiv.14.285",
"10.12782/specdiv.11.199",
"10.12782/specdiv.15.11",
"10.12782/specdiv.15.139",
"10.12782/specdiv.15.1",
"10.12782/specdiv.11.77",
"10.12782/specdiv.11.277",
"10.12782/specdiv.15.25",
"10.12782/specdiv.15.57",
"10.12782/specdiv.15.71",
"10.12782/specdiv.1.7",
"10.12782/specdiv.1.1",
"10.12782/specdiv.1.123",
"10.12782/specdiv.15.125",
"10.12782/specdiv.1.31",
"10.12782/specdiv.12.141",
"10.12782/specdiv.15.109",
"10.12782/specdiv.1.39",
"10.12782/specdiv.10.85",
"10.12782/specdiv.1.93",
"10.12782/specdiv.15.131",
"10.12782/specdiv.1.49",
"10.12782/specdiv.1.55",
"10.12782/specdiv.1.75",
"10.12782/specdiv.15.169",
"10.12782/specdiv.1.99",
"10.12782/specdiv.1.107",
"10.12782/specdiv.15.155",
"10.12782/specdiv.11.209",
"10.12782/specdiv.15.185",
"10.12782/specdiv.10.7",
"10.12782/specdiv.1.117",
"10.12782/specdiv.10.1",
"10.12782/specdiv.10.135",
"10.12782/specdiv.12.47",
"10.12782/specdiv.14.173",
"10.12782/specdiv.16.1",
"10.12782/specdiv.14.49",
"10.12782/specdiv.10.19",
"10.12782/specdiv.13.1",
"10.12782/specdiv.10.37",
"10.12782/specdiv.10.45",
"10.12782/specdiv.10.27",
"10.12782/specdiv.16.39",
"10.12782/specdiv.16.49",
"10.12782/specdiv.10.105",
"10.12782/specdiv.10.125",
"10.12782/specdiv.10.171",
"10.12782/specdiv.10.191",
"10.12782/specdiv.10.151",
"10.12782/specdiv.12.175",
"10.12782/specdiv.10.289",
"10.12782/specdiv.11.1",
"10.12782/specdiv.10.209",
"10.12782/specdiv.10.249",
"10.12782/specdiv.10.259",
"10.12782/specdiv.10.269",
"10.12782/specdiv.13.275",
"10.12782/specdiv.11.7",
"10.12782/specdiv.12.167",
"10.12782/specdiv.11.33",
"10.12782/specdiv.11.57",
"10.12782/specdiv.11.93",
"10.12782/specdiv.11.99",
"10.12782/specdiv.11.149",
"10.12782/specdiv.12.211",
"10.12782/specdiv.12.271",
"10.12782/specdiv.12.113",
"10.12782/specdiv.11.183",
"10.12782/specdiv.11.137",
"10.12782/specdiv.11.157",
"10.12782/specdiv.12.89",
"10.12782/specdiv.11.257",
"10.12782/specdiv.11.191",
"10.12782/specdiv.11.225",
"10.12782/specdiv.12.121",
"10.12782/specdiv.11.307",
"10.12782/specdiv.11.327",
"10.12782/specdiv.11.339",
"10.12782/specdiv.11.245",
"10.12782/specdiv.11.295",
"10.12782/specdiv.13.201",
"10.12782/specdiv.15.41",
"10.12782/specdiv.11.347",
"10.12782/specdiv.11.359",
"10.12782/specdiv.12.1",
"10.12782/specdiv.13.53",
"10.12782/specdiv.12.17",
"10.12782/specdiv.12.29",
"10.12782/specdiv.12.57",
"10.12782/specdiv.12.73",
"10.12782/specdiv.12.9",
"10.12782/specdiv.1.71",
"10.12782/specdiv.14.279",
"10.12782/specdiv.12.83",
"10.12782/specdiv.15.83",
"10.12782/specdiv.13.117",
"10.12782/specdiv.12.187",
"10.12782/specdiv.12.193",
"10.12782/specdiv.12.199",
"10.12782/specdiv.12.223",
"10.12782/specdiv.14.197",
"10.12782/specdiv.12.127",
"10.12782/specdiv.13.35",
"10.12782/specdiv.12.237",
"10.12782/specdiv.12.255",
"10.12782/specdiv.14.97",
"10.12782/specdiv.13.123",
"10.12782/specdiv.14.27",
"10.12782/specdiv.13.175",
"10.12782/specdiv.13.245",
"10.12782/specdiv.14.307",
"10.12782/specdiv.14.1",
"10.12782/specdiv.13.133",
"10.12782/specdiv.13.149",
"10.12782/specdiv.13.157",
"10.12782/specdiv.13.187",
"10.12782/specdiv.13.189",
"10.12782/specdiv.13.221",
"10.12782/specdiv.14.267",
"10.12782/specdiv.14.9",
"10.12782/specdiv.15.93",
"10.12782/specdiv.14.75",
"10.12782/specdiv.1.17",
"10.12782/specdiv.14.41",
"10.12782/specdiv.14.115",
"10.12782/specdiv.14.15",
"10.12782/specdiv.14.61",
"10.12782/specdiv.14.89",
"10.12782/specdiv.10.75",
"10.12782/specdiv.16.65",
"10.12782/specdiv.16.81",
"10.12782/specdiv.16.85",
"10.12782/specdiv.16.93",
"10.12782/specdiv.16.103",
"10.12782/specdiv.3.105",
"10.12782/specdiv.16.113",
"10.12782/specdiv.16.137",
"10.12782/specdiv.16.149",
"10.12782/specdiv.2.105",
"10.12782/specdiv.2.155",
"10.12782/specdiv.3.271",
"10.12782/specdiv.3.201",
"10.12782/specdiv.18.135",
"10.12782/specdiv.5.7",
"10.12782/specdiv.2.51",
"10.12782/specdiv.2.145",
"10.12782/specdiv.3.81",
"10.12782/specdiv.2.121",
"10.12782/specdiv.2.1",
"10.12782/specdiv.2.97",
"10.12782/specdiv.3.317",
"10.12782/specdiv.2.25",
"10.12782/specdiv.3.277",
"10.12782/specdiv.2.7",
"10.12782/specdiv.2.31",
"10.12782/specdiv.5.59",
"10.12782/specdiv.2.43",
"10.12782/specdiv.2.59",
"10.12782/specdiv.2.231",
"10.12782/specdiv.3.211",
"10.12782/specdiv.2.179",
"10.12782/specdiv.4.361",
"10.12782/specdiv.2.83",
"10.12782/specdiv.2.167",
"10.12782/specdiv.3.25",
"10.12782/specdiv.3.1",
"10.12782/specdiv.3.17",
"10.12782/specdiv.3.75",
"10.12782/specdiv.3.117",
"10.12782/specdiv.3.155",
"10.12782/specdiv.3.89",
"10.12782/specdiv.3.133",
"10.12782/specdiv.3.163",
"10.12782/specdiv.3.169",
"10.12782/specdiv.3.187",
"10.12782/specdiv.3.219",
"10.12782/specdiv.3.289",
"10.12782/specdiv.3.301",
"10.12782/specdiv.4.43",
"10.12782/specdiv.4.35",
"10.12782/specdiv.3.Cover6",
"10.12782/specdiv.4.1",
"10.12782/specdiv.4.9",
"10.12782/specdiv.4.63",
"10.12782/specdiv.5.375",
"10.12782/specdiv.5.391",
"10.12782/specdiv.4.143",
"10.12782/specdiv.4.243",
"10.12782/specdiv.5.53",
"10.12782/specdiv.4.321",
"10.12782/specdiv.4.353",
"10.12782/specdiv.4.381",
"10.12782/specdiv.4.389",
"10.12782/specdiv.4.257",
"10.12782/specdiv.5.39",
"10.12782/specdiv.4.339",
"10.12782/specdiv.4.367",
"10.12782/specdiv.4.371",
"10.12782/specdiv.5.13",
"10.12782/specdiv.5.1",
"10.12782/specdiv.5.93",
"10.12782/specdiv.5.23",
"10.12782/specdiv.5.111",
"10.12782/specdiv.5.149",
"10.12782/specdiv.5.103",
"10.12782/specdiv.5.229",
"10.12782/specdiv.5.215",
"10.12782/specdiv.5.129",
"10.12782/specdiv.5.135",
"10.12782/specdiv.5.155",
"10.12782/specdiv.5.163",
"10.12782/specdiv.5.351",
"10.12782/specdiv.5.183",
"10.12782/specdiv.5.177",
"10.12782/specdiv.5.361",
"10.12782/specdiv.5.267",
"10.12782/specdiv.5.317",
"10.12782/specdiv.5.201",
"10.12782/specdiv.5.285",
"10.12782/specdiv.5.309",
"10.12782/specdiv.5.329",
"10.12782/specdiv.5.381",
"10.12782/specdiv.6.23",
"10.12782/specdiv.9.135",
"10.12782/specdiv.6.1",
"10.12782/specdiv.6.11",
"10.12782/specdiv.6.65",
"10.12782/specdiv.6.73",
"10.12782/specdiv.6.185",
"10.12782/specdiv.9.165",
"10.12782/specdiv.6.87",
"10.12782/specdiv.6.111",
"10.12782/specdiv.7.67",
"10.12782/specdiv.6.117",
"10.12782/specdiv.6.127",
"10.12782/specdiv.6.169",
"10.12782/specdiv.6.179",
"10.12782/specdiv.6.363",
"10.12782/specdiv.6.243",
"10.12782/specdiv.6.133",
"10.12782/specdiv.6.295",
"10.12782/specdiv.8.347",
"10.12782/specdiv.9.331",
"10.12782/specdiv.7.121",
"10.12782/specdiv.8.141",
"10.12782/specdiv.6.309",
"10.12782/specdiv.6.323",
"10.12782/specdiv.6.347",
"10.12782/specdiv.7.1",
"10.12782/specdiv.7.47",
"10.12782/specdiv.6.355",
"10.12782/specdiv.8.119",
"10.12782/specdiv.7.29",
"10.12782/specdiv.7.145",
"10.12782/specdiv.7.165",
"10.12782/specdiv.7.317",
"10.12782/specdiv.7.155",
"10.12782/specdiv.7.333",
"10.12782/specdiv.7.371",
"10.12782/specdiv.7.381",
"10.12782/specdiv.7.173",
"10.12782/specdiv.7.209",
"10.12782/specdiv.7.187",
"10.12782/specdiv.7.217",
"10.12782/specdiv.7.363",
"10.12782/specdiv.7.251",
"10.12782/specdiv.7.345",
"10.12782/specdiv.7.393",
"10.12782/specdiv.8.35",
"10.12782/specdiv.8.47",
"10.12782/specdiv.8.67",
"10.12782/specdiv.7.387",
"10.12782/specdiv.8.107",
"10.12782/specdiv.9.359",
"10.12782/specdiv.8.133",
"10.12782/specdiv.8.27",
"10.12782/specdiv.8.203",
"10.12782/specdiv.8.1",
"10.12782/specdiv.8.79",
"10.12782/specdiv.8.93",
"10.12782/specdiv.8.175",
"10.12782/specdiv.8.391",
"10.12782/specdiv.8.227",
"10.12782/specdiv.8.237",
"10.12782/specdiv.8.293",
"10.12782/specdiv.8.301",
"10.12782/specdiv.8.219",
"10.12782/specdiv.8.267",
"10.12782/specdiv.8.275",
"10.12782/specdiv.9.37",
"10.12782/specdiv.8.311",
"10.12782/specdiv.8.353",
"10.12782/specdiv.8.385",
"10.12782/specdiv.9.1",
"10.12782/specdiv.9.47",
"10.12782/specdiv.9.77",
"10.12782/specdiv.9.109",
"10.12782/specdiv.8.399",
"10.12782/specdiv.9.67",
"10.12782/specdiv.9.97",
"10.12782/specdiv.9.151",
"10.12782/specdiv.9.193",
"10.12782/specdiv.9.125",
"10.12782/specdiv.9.201",
"10.12782/specdiv.9.207",
"10.12782/specdiv.9.215",
"10.12782/specdiv.9.221",
"10.12782/specdiv.9.269",
"10.12782/specdiv.9.251",
"10.12782/specdiv.9.259",
"10.12782/specdiv.9.375",
"10.12782/specdiv.9.285",
"10.12782/specdiv.9.343",
"10.12782/specdiv.9.367",
"10.12782/specdiv.9.383",
"10.12782/specdiv.23.87",
"10.12782/specdiv.23.13",
"10.12782/specdiv.23.95",
"10.12782/specdiv.23.61",
"10.12782/specdiv.23.51",
"10.12782/specdiv.23.39",
"10.12782/specdiv.23.69",
"10.12782/specdiv.23.43",
"10.12782/specdiv.23.121",
"10.12782/specdiv.23.83",
"10.12782/specdiv.23.129",
"10.12782/specdiv.23.75",
"10.12782/specdiv.23.1",
"10.12782/specdiv.23.115",
"10.12782/specdiv.23.209",
"10.12782/specdiv.23.249",
"10.12782/specdiv.23.253",
"10.12782/specdiv.23.183",
"10.12782/specdiv.23.181",
"10.12782/specdiv.23.215",
"10.12782/specdiv.23.135",
"10.12782/specdiv.23.229",
"10.12782/specdiv.23.243",
"10.12782/specdiv.23.143",
"10.12782/specdiv.23.233",
"10.12782/specdiv.23.193",
"10.12782/specdiv.23.225",
"10.12782/specdiv.23.219",
"10.12782/specdiv.23.239",
"10.12782/specdiv.24.1",
"10.12782/specdiv.24.7",
"10.12782/specdiv.24.11",
"10.12782/specdiv.24.17",
"10.12782/specdiv.24.23",
"10.12782/specdiv.24.29",
"10.12782/specdiv.24.49",
"10.12782/specdiv.24.109",
"10.12782/specdiv.24.61",
"10.12782/specdiv.24.69",
"10.12782/specdiv.24.97",
"10.12782/specdiv.24.103",
"10.12782/specdiv.24.115",
"10.12782/specdiv.24.119",
"10.12782/specdiv.24.145",
"10.12782/specdiv.24.151",
"10.12782/specdiv.24.159",
"10.12782/specdiv.24.169",
"10.12782/specdiv.24.179",
"10.12782/specdiv.24.137",
"10.12782/specdiv.24.181",
"10.12782/specdiv.24.189",
"10.12782/specdiv.24.195",
"10.12782/specdiv.24.203",
"10.12782/specdiv.24.209",
"10.12782/specdiv.24.217",
"10.12782/specdiv.24.229",
"10.12782/specdiv.24.247",
"10.12782/specdiv.24.253",
"10.12782/specdiv.24.259",
"10.12782/specdiv.24.267",
"10.12782/specdiv.24.287",
"10.12782/specdiv.24.281",
"10.12782/specdiv.24.275",
"10.12782/specdiv.25.1",
"10.12782/specdiv.25.11",
"10.12782/specdiv.25.25",
"10.12782/specdiv.25.39",
"10.12782/specdiv.25.49",
"10.12782/specdiv.25.55",
"10.12782/specdiv.25.61",
"10.12782/specdiv.25.75",
"10.12782/specdiv.25.89",
"10.12782/specdiv.25.117",
"10.12782/specdiv.25.107",
"10.12782/specdiv.25.123",
"10.12782/specdiv.25.129",
"10.12782/specdiv.25.135",
"10.12782/specdiv.25.153",
"10.12782/specdiv.25.171",
"10.12782/specdiv.25.163",
"10.12782/specdiv.25.145",
"10.12782/specdiv.25.177",
"10.12782/specdiv.25.183",
"10.12782/specdiv.25.213",
"10.12782/specdiv.25.189",
"10.12782/specdiv.25.197",
"10.12782/specdiv.25.205",
"10.12782/specdiv.25.219",
"10.12782/specdiv.25.237",
"10.12782/specdiv.25.227",
"10.12782/specdiv.25.251",
"10.12782/specdiv.25.275",
"10.12782/specdiv.25.295",
"10.12782/specdiv.25.283",
"10.12782/specdiv.25.329",
"10.12782/specdiv.25.349",
"10.12782/specdiv.25.355",
"10.12782/specdiv.25.343",
"10.12782/specdiv.25.309",
"10.12782/specdiv.25.361",
"10.12782/specdiv.25.369",
"10.12782/specdiv.25.377",
"10.12782/specdiv.26.1",
"10.12782/specdiv.26.7",
"10.12782/specdiv.26.23",
"10.12782/specdiv.26.37",
"10.12782/specdiv.26.43",
"10.12782/specdiv.26.31",
"10.12782/specdiv.26.65",
"10.12782/specdiv.26.49",
"10.12782/specdiv.26.79",
"10.12782/specdiv.26.101",
"10.12782/specdiv.26.93",
"10.12782/specdiv.26.111",
"10.12782/specdiv.26.127",
"10.12782/specdiv.26.153",
"10.12782/specdiv.26.131",
"10.12782/specdiv.26.137",
"10.12782/specdiv.26.145",
"10.12782/specdiv.26.165",
"10.12782/specdiv.26.171",
"10.12782/specdiv.26.191",
"10.12782/specdiv.26.187",
"10.12782/specdiv.26.249",
"10.12782/specdiv.26.255",
"10.12782/specdiv.26.207",
"10.12782/specdiv.26.241",
"10.12782/specdiv.26.225",
"10.12782/specdiv.26.197",
"10.12782/specdiv.26.217",
"10.12782/specdiv.26.205",
"10.12782/specdiv.26.235",
"10.12782/specdiv.26.273",
"10.12782/specdiv.26.281",
"10.12782/specdiv.26.297",
"10.12782/specdiv.26.289",
"10.12782/specdiv.26.343",
"10.12782/specdiv.27.1",
"10.12782/specdiv.27.25",
"10.12782/specdiv.27.15",
"10.12782/specdiv.27.61",
"10.12782/specdiv.27.37",
"10.12782/specdiv.27.45",
"10.12782/specdiv.27.53",
"10.12782/specdiv.27.83",
"10.12782/specdiv.27.71",
"10.12782/specdiv.27.91",
"10.12782/specdiv.27.113",
"10.12782/specdiv.27.129",
"10.12782/specdiv.27.95",
"10.12782/specdiv.27.101",
"10.12782/specdiv.27.139",
"10.12782/specdiv.27.167",
"10.12782/specdiv.27.159",
"10.12782/specdiv.27.181",
"10.12782/specdiv.27.227",
);


foreach ($dois as $doi)
{
	$doi = strtolower($doi);
	
	// check cache
	
	$id = 'https://doi.org/' . $doi;

	$exists = $couch->exists($id);
	
	if ($exists)
	{
		$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($id));			
		//echo $resp;
		$work = json_decode($resp);
	}
	else
	{
		$work = get_work($doi);
		
		if ($work)
		{
			$work->_id = $id;
		
			// store
			$couch->add_update_or_delete_document($work, $work->_id, 'add');	
		}

	}
	
	if ($work)
	{
	
		// print_r($work->message);
		
		$sql = csl_to_sql($work->message);
		
		echo $sql . "\n";
	}



}


?>
