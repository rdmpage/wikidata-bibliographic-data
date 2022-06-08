<?php

// medra to RIS

//----------------------------------------------------------------------------------------
function get($url, $user_agent='', $content_type = '')
{	
	$data = null;

	$opts = array(
	  CURLOPT_URL =>$url,
	  CURLOPT_FOLLOWLOCATION => TRUE,
	  CURLOPT_RETURNTRANSFER => TRUE,
	  
		CURLOPT_SSL_VERIFYHOST=> FALSE,
		CURLOPT_SSL_VERIFYPEER=> FALSE,
	  
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
// Convert a simple CSL object to RIS
function csl_to_ris($csl)
{
	$csl_ris_map  = array(
		'type'				=> 'TY',
	
		'title' 			=> 'TI',
		
		'author' 			=> 'AU',
				
		'container-title' 	=> 'JO',
		'ISSN' 				=> 'SN',
		
		'volume' 			=> 'VL',
		'issue' 			=> 'IS',
		
		'spage' 			=> 'SP',
		'epage' 			=> 'EP',
		
		'year' 				=> 'Y1',
		'date'				=> 'PY',
		
		'abstract'			=> 'N2',
		
		'URL'				=> 'UR',
		'DOI'				=> 'DO',

		'publisher'			=> 'PB',
		'publisher-place'	=> 'PP',
		);

	$ris_keys = array_values($csl_ris_map);
	$ris_keys[] = 'ER';
	
	foreach ($csl as $k => $v)
	{
		switch ($k)
		{
			case 'type':
				switch ($v)
				{	
					case 'article-journal':
						$ris_values[$csl_ris_map[$k]][] = 'JOUR';		
						break;

					case 'book':
						$ris_values[$csl_ris_map[$k]][] = 'BOOK';		
						break;

					case 'chapter':
						$ris_values[$csl_ris_map[$k]][] = 'CHAP';		
						break;					
				
					default:
						$ris_values[$csl_ris_map[$k]][] = 'GEN';		
						break;
				}
				break;
				
			case 'title':
			case 'container-title':
			case 'volume':
			case 'issue':
			case 'DOI':
			case 'publisher':
			case 'publisher-place':
				$ris_values[$csl_ris_map[$k]][] = $v;				
				break;
				
			case 'page':
				if (preg_match('/(.*)-(.*)/', $v, $m))
				{
					$ris_values['SP'][] = $m[1];
					$ris_values['EP'][] = $m[2];						
				}
				else
				{
					$ris_values['SP'][] = $v;
				}
				break;
				
			case 'issued':
				$ris_values['Y1'][] = $v->{'date-parts'}[0][0];
				break;
				
			case 'ISSN':
				if (is_array($v))
				{
					$ris_values[$csl_ris_map[$k]][] = $v[0];	
				}
				else
				{
					$ris_values[$csl_ris_map[$k]][] = $v;
				}
				break;
				
			case 'author':
				foreach ($v as $author)
				{
					if (isset($author->literal))
					{
						$ris_values[$csl_ris_map[$k]][] = $author->literal;
					}
					else
					{
						$name_parts = array();
						if (isset($author->given))
						{
							$name_parts[] = $author->given;
						}
						if (isset($author->family))
						{
							$name_parts[] = $author->family;
						}
						$name = trim(join(' ', $name_parts));
						if ($name != '')
						{
							$ris_values[$csl_ris_map[$k]][] = $name;
						}
					}
				}
				break;
				
			default:
				break;
		}

	
	}
	$ris_values['ER'][] = '';	
		
	//print_r($ris_values);
	
	$ris = '';
	
	foreach ($ris_keys as $k)
	{
		if (isset($ris_values[$k]))
		{
			foreach ($ris_values[$k] as $v)
			{
				$ris .= $k . '  - ' . $v . "\n";
			}
		
		}	
	}
	
	return $ris;
}




$dois=array(
'10.12905/0380.sydowia66(2)2014-0171',
'10.12905/0380.sydowia67-2015-0175',
'10.12905/0380.sydowia69-2017-0009',
'10.12905/0380.sydowia69-2017-0047',
'10.12905/0380.sydowia69-2017-0115',
'10.12905/0380.sydowia69-2017-0161',
'10.12905/0380.sydowia69-2017-0215',
'10.12905/0380.sydowia70-2018-0059',
'10.12905/0380.sydowia70-2018-0037',
'10.12905/0380.sydowia70-2018-0155',
'10.12905/0380.sydowia67-2015-0157',
'10.12905/0380.sydowia70-2018-0193',
'10.12905/0380.sydowia70-2018-0185',
'10.12905/0380.sydowia70-2018-0179',
'10.12905/0380.sydowia70-2018-0169',
'10.12905/0380.sydowia70-2018-0161',
'10.12905/0380.sydowia70-2018-0141',
'10.12905/0380.sydowia70-2018-0099',
'10.12905/0380.sydowia70-2018-0089',
'10.12905/0380.sydowia70-2018-0051',
'10.12905/0380.sydowia70-2018-0027',
'10.12905/0380.sydowia69-2017-0171',
'10.12905/0380.sydowia69-2017-0153',
'10.12905/0380.sydowia69-2017-0147',
'10.12905/0380.sydowia69-2017-0135',
'10.12905/0380.sydowia69-2017-0131',
'10.12905/0380.sydowia69-2017-0123',
'10.12905/0380.sydowia69-2017-0105',
'10.12905/0380.sydowia69-2017-0097',
'10.12905/0380.sydowia69-2017-0073',
'10.12905/0380.sydowia69-2017-0023',
'10.12905/0380.sydowia69-2017-0019',
'10.12905/0380.sydowia69-2017-0001',
'10.12905/0380.sydowia68-2016-0193',
'10.12905/0380.sydowia68-2016-0187',
'10.12905/0380.sydowia68-2016-0163',
'10.12905/0380.sydowia68-2016-0151',
'10.12905/0380.sydowia68-2016-0131',
'10.12905/0380.sydowia68-2016-0119',
'10.12905/0380.sydowia68-2016-0113',
'10.12905/0380.sydowia68-2016-0107',
'10.12905/0380.sydowia68-2016-0099',
'10.12905/0380.sydowia68-2016-0063',
'10.12905/0380.sydowia68-2016-0057',
'10.12905/0380.sydowia68-2016-0049',
'10.12905/0380.sydowia68-2016-0041',
'10.12905/0380.sydowia68-2016-0035',
'10.12905/0380.sydowia68-2016-0027',
'10.12905/0380.sydowia68-2016-0017',
'10.12905/0380.sydowia68-2016-0007',
'10.12905/0380.sydowia68-2016-0001',
'10.12905/0380.sydowia67-2015-0217',
'10.12905/0380.sydowia67-2015-0197',
'10.12905/0380.sydowia67-2015-0189',
'10.12905/0380.sydowia67-2015-0167',
'10.12905/0380.sydowia67-2015-0133',
'10.12905/0380.sydowia67-2015-0127',
'10.12905/0380.sydowia67-2015-0075',
'10.12905/0380.sydowia67-2015-0065',
'10.12905/0380.sydowia67-2015-0051',
'10.12905/0380.sydowia67-2015-0045',
'10.12905/0380.sydowia67-2015-0033',
'10.12905/0380.sydowia67-2015-0025',
'10.12905/0380.sydowia67-2015-0021',
'10.12905/0380.sydowia67-2015-0011',
'10.12905/0380.sydowia67-2015-0001',
'10.12905/0380.sydowia66(2)2014-0335',
'10.12905/0380.sydowia66(2)2014-0309',
'10.12905/0380.sydowia66(2)2014-0289',
'10.12905/0380.sydowia66(2)2014-0257',
'10.12905/0380.sydowia66(2)2014-0249',
'10.12905/0380.sydowia66(2)2014-0241',
'10.12905/0380.sydowia66(2)2014-0229',
'10.12905/0380.sydowia70-2018-0211',
'10.12905/0380.sydowia70-2018-0199',
'10.12905/0380.sydowia70-2018-0129',
'10.12905/0380.sydowia70-2018-0107',
'10.12905/0380.sydowia70-2018-0081',
'10.12905/0380.sydowia70-2018-0067',
'10.12905/0380.sydowia70-2018-0011',
'10.12905/0380.sydowia70-2018-0001',
'10.12905/0380.sydowia69-2017-0229',
'10.12905/0380.sydowia69-2017-0205',
'10.12905/0380.sydowia69-2017-0199',
'10.12905/0380.sydowia69-2017-0183',
'10.12905/0380.sydowia69-2017-0081',
'10.12905/0380.sydowia69-2017-0037',
'10.12905/0380.sydowia69-2017-0029',
'10.12905/0380.sydowia68-2016-0173',
'10.12905/0380.sydowia68-2016-0139',
'10.12905/0380.sydowia68-2016-0087',
'10.12905/0380.sydowia68-2016-0069',
'10.12905/0380.sydowia67-2015-0119',
'10.12905/0380.sydowia67-2015-0081',
'10.12905/0380.sydowia66(2)2014-0325',
'10.12905/0380.sydowia66(2)2014-0313',
'10.12905/0380.sydowia66(2)2014-0299',
'10.12905/0380.sydowia73-2020-0001',
'10.12905/0380.sydowia73-2020-0013',
'10.12905/0380.sydowia73-2020-0021',
'10.12905/0380.sydowia73-2020-0031',
'10.12905/0380.sydowia73-2020-0045',
'10.12905/0380.sydowia72-2020-0231',
'10.12905/0380.sydowia73-2020-0061',
'10.12905/0380.sydowia73-2020-0069',
'10.12905/0380.sydowia73-2020-0075',
'10.12905/0380.sydowia73-2020-0083',
'10.12905/0380.sydowia73-2020-0089',
'10.12905/0380.sydowia73-2020-0113',
'10.12905/0380.sydowia73-2020-0163',
'10.12905/0380.sydowia73-2020-0133',
'10.12905/0380.sydowia73-2020-0171',
'10.12905/0380.sydowia73-2020-0185',
'10.12905/0380.sydowia73-2021-0197',
'10.12905/0380.sydowia73-2021-0217',
'10.12905/0380.sydowia73-2021-0209',
'10.12905/0380.sydowia73-2021-0233',
'10.12905/0380.sydowia73-2021-0245',
'10.12905/0380.sydowia73-2021-0257',
'10.12905/0380.sydowia74-2021-0001',
'10.12905/0380.sydowia74-2021-0015',
'10.12905/0380.sydowia73-2021-0271',
'10.12905/0380.sydowia74-2021-0033',
'10.12905/0380.sydowia74-2021-0065',
'10.12905/0380.sydowia74-2021-0093',
'10.12905/0380.sydowia74-2021-0107',
'10.12905/0380.sydowia74-2021-0121',
'10.12905/0380.sydowia74-2021-0133',
'10.12905/0380.sydowia74-2021-0153',
'10.12905/0380.sydowia74-2021-0071',
'10.12905/0380.sydowia74-2021-0143',
'10.12905/0380.sydowia74-2021-0163',
'10.12905/0380.sydowia74-2021-0079',
'10.12905/0380.sydowia74-2021-0175',
'10.12905/0380.sydowia74-2021-0193',
'10.12905/0380.sydowia74-2021-0181',
'10.12905/0380.sydowia74-2021-0287',
'10.12905/0380.sydowia74-2021-0335',
'10.12905/0380.sydowia74-2021-0263',
'10.12905/0380.sydowia74-2021-0277',
'10.12905/0380.sydowia74-2021-0303',
'10.12905/0380.sydowia74-2021-0315',
'10.12905/0380.sydowia74-2021-0327',
'10.12905/0380.sydowia74-2021-0251',
'10.12905/0380.sydowia74-2021-0343',
);

$dois=array('10.12905/0380.sydowia74-2021-0327');

$dois=array(
"10.12905/0380.sydowia71-2019-0025",
"10.12905/0380.sydowia71-2019-0001",
"10.12905/0380.sydowia71-2019-0011",
"10.12905/0380.sydowia71-2019-0035",
"10.12905/0380.sydowia71-2019-0065",
"10.12905/0380.sydowia71-2019-0085",
"10.12905/0380.sydowia71-2019-0091",
"10.12905/0380.sydowia71-2019-0103",
"10.12905/0380.sydowia71-2019-0115",
"10.12905/0380.sydowia71-2019-0047",
"10.12905/0380.sydowia71-2019-0017",
"10.12905/0380.sydowia71-2019-0247",
"10.12905/0380.sydowia71-2019-0255",
"10.12905/0380.sydowia71-2019-0267",
"10.12905/0380.sydowia71-2019-0279",
"10.12905/0380.sydowia71-2019-0285",
"10.12905/0380.sydowia71-2019-0129",
"10.12905/0380.sydowia71-2019-0139",


);

$dois=array(
'10.12905/0380.sydowia66(1)2014-0025',
'10.12905/0380.sydowia66(2)2014-0217',
'10.12905/0380.sydowia66(1)2014-0055',
'10.12905/0380.sydowia66(1)2014-0019',
'10.12905/0380.sydowia66(1)2014-0029',
'10.12905/0380.sydowia66(1)2014-0143',
'10.12905/0380.sydowia66(2)2014-0203',


);

$dois=array(
'10.23788/IEF-1094',
'10.23788/IEF-1087',
'10.23788/IEF-1067',
'10.23788/IEF-1090',
'10.23788/IEF-1099',
'10.23788/IEF-1105',
'10.23788/IEF-1103',
'10.23788/IEF-1089',
'10.23788/IEF-1102',
'10.23788/IEF-1091',
'10.23788/IEF-1081',
'10.23788/IEF-1096',
'10.23788/IEF-1095',
'10.23788/IEF-1093',
'10.23788/IEF-1071',
'10.23788/IEF-1066',
'10.23788/IEF-1086',
'10.23788/IEF-1083',
'10.23788/IEF-1082',
'10.23788/IEF-1080',
'10.23788/IEF-1078',
'10.23788/IEF-1076',
'10.23788/IEF-1084',
'10.23788/IEF-1079',
'10.23788/IEF-1075',
'10.23788/IEF-1073',
'10.23788/IEF-1057',
'10.23788/IEF-952',

);

/*
$dois = array();
for ($i = 1; $i < 99; $i++)
{
	$dois[] = '10.23788/IEF-11' . str_pad($i, 2, '0', STR_PAD_LEFT);
}
*/

foreach ($dois as $doi)
{
	//echo $doi . "\n";
	
	$url = 'https://doi.org/' . $doi;
	$json = get($url, '', 'application/vnd.citationstyles.csl+json');
	
	if ($json == '')
	{
		echo "xxx\n";
	}
		
	if (1)			
	{
		$obj = json_decode($json);
	
		//print_r($obj);

		if ($obj)
		{
			// fixes
			if (preg_match('/IEF/', $doi))
			{
				$obj->ISSN = array('0936-9902');
			}
			$obj->type = 'article-journal';
		
			$ris = csl_to_ris($obj);
	
			echo $ris . "\n";
		}
	}
}

?>
