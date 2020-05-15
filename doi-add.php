<?php

// Add records to Wikidata from DOI

require_once (dirname(__FILE__) . '/wikidata.php');


$dois=array();


$dois=array(
//'10.3989/collectbot.2010.v29.001',
'10.3989/collectbot.2010.v29.002',
'10.3989/collectbot.2010.v29.003',
'10.3989/collectbot.2010.v29.004',
'10.3989/collectbot.2010.v29.006',
'10.3989/collectbot.2010.v29.007',
'10.3989/collectbot.2010.v29.008',
'10.3989/collectbot.2010.v29.009',
'10.3989/collectbot.2010.v29.010',
'10.3989/collectbot.2010.v29.011',
'10.3989/collectbot.2010.v29.012',
'10.3989/collectbot.1988.v17.150',
'10.3989/collectbot.1988.v17.151',
'10.3989/collectbot.1988.v17.152',
'10.3989/collectbot.1988.v17.153',
'10.3989/collectbot.1988.v17.154',
'10.3989/collectbot.1988.v17.155',
'10.3989/collectbot.1988.v17.156',
'10.3989/collectbot.1988.v17.157',
'10.3989/collectbot.1988.v17.158',
'10.3989/collectbot.1988.v17.159',
'10.3989/collectbot.1988.v17.160',
'10.3989/collectbot.1988.v17.161',
'10.3989/collectbot.1988.v17.162',
'10.3989/collectbot.1988.v17.163',
'10.3989/collectbot.1988.v17.164',
'10.3989/collectbot.1989.v17.138',
'10.3989/collectbot.1989.v17.139',
'10.3989/collectbot.1989.v17.140',
'10.3989/collectbot.1989.v17.141',
'10.3989/collectbot.1989.v17.142',
'10.3989/collectbot.1989.v17.143',
'10.3989/collectbot.1989.v17.144',
'10.3989/collectbot.1989.v17.145',
'10.3989/collectbot.1990.v18.126',
'10.3989/collectbot.1990.v18.127',
'10.3989/collectbot.1990.v18.128',
'10.3989/collectbot.1990.v18.129',
'10.3989/collectbot.1990.v18.130',
'10.3989/collectbot.1990.v18.131',
'10.3989/collectbot.1990.v18.132',
'10.3989/collectbot.1990.v19.116',
'10.3989/collectbot.1990.v19.117',
'10.3989/collectbot.1990.v19.120',
'10.3989/collectbot.1990.v19.121',
'10.3989/collectbot.1990.v19.123',
'10.3989/collectbot.1991.v20.72',
'10.3989/collectbot.1991.v20.105',
'10.3989/collectbot.1991.v20.106',
'10.3989/collectbot.1991.v20.108',
'10.3989/collectbot.1991.v20.110',
'10.3989/collectbot.2011.v30.001',
'10.3989/collectbot.2011.v30.002',
'10.3989/collectbot.2011.v30.003',
'10.3989/collectbot.2011.004',
'10.3989/collectbot.2011.v30.005',
'10.3989/collectbot.2011.v30.006',
'10.3989/collectbot.2011.v30.007',
'10.3989/collectbot.2011.v30.008',
'10.3989/collectbot.2011.v30.009',
'10.3989/collectbot.2011.v30.010',
'10.3989/collectbot.2011.v30.011',
'10.3989/collectbot.2013.v32.002',
'10.3989/collectbot.2013.v32.003',
'10.3989/collectbot.2013.v32.004',
'10.3989/collectbot.2013.v32.005',
'10.3989/collectbot.2013.v32.006',
'10.3989/collectbot.2013.v32.007',
'10.3989/collectbot.2013.v32.008',
'10.3989/collectbot.2013.v32.009',
'10.3989/collectbot.2013.v32.214',
'10.3989/collectbot.2008.v28.013',
'10.3989/collectbot.2008.v28.015',
'10.3989/collectbot.2008.v28.012',
'10.3989/collectbot.2008.v28.001',
'10.3989/collectbot.2008.v28.003',
'10.3989/collectbot.2008.v28.002',
'10.3989/collectbot.2008.v28.010',
'10.3989/collectbot.2008.v28.004',
'10.3989/collectbot.2008.v28.011',
'10.3989/collectbot.2009.v28.34',
'10.3989/collectbot.2008.v28.007',
'10.3989/collectbot.2008.v28.008',
'10.3989/collectbot.2008.v28.009',
'10.3989/collectbot.2008.v27.1',
'10.3989/collectbot.2008.v27.2',
'10.3989/collectbot.2008.v27.3',
'10.3989/collectbot.2008.v27.4',
'10.3989/collectbot.2008.v27.5',
'10.3989/collectbot.2008.v27.6',
'10.3989/collectbot.2008.v27.7',
'10.3989/collectbot.2008.v27.8',
'10.3989/collectbot.2008.v27.9',
'10.3989/collectbot.2008.v27.10',
'10.3989/collectbot.2008.v27.11',
'10.3989/collectbot.2003.v26.14',
'10.3989/collectbot.2003.v26.15',
'10.3989/collectbot.2003.v26.16',
'10.3989/collectbot.2003.v26.18',
'10.3989/collectbot.2003.v26.19',
'10.3989/collectbot.2003.v26.21',
'10.3989/collectbot.2003.v26.22',
'10.3989/collectbot.2003.v26.23',
'10.3989/collectbot.2003.v26.24',
'10.3989/collectbot.1990.v19.114',
'10.3989/collectbot.1991.v20.107',
'10.3989/collectbot.1989.v17.137',
'10.3989/collectbot.1990.v18.124',
'10.3989/collectbot.1990.v19.118',
'10.3989/collectbot.1990.v19.119',
'10.3989/collectbot.1990.v19.122',
'10.3989/collectbot.2008.v28.005',
'10.3989/collectbot.1990.v19.115',
'10.3989/collectbot.2013.v33.001',
'10.3989/collectbot.v33.002',
'10.3989/collectbot.v33.003',
'10.3989/collectbot.2013.v33.004',
'10.3989/collectbot.2013.v33.005',
'10.3989/collectbot.2013.v33.006',
'10.3989/collectbot.2013.v32.010',
'10.3989/collectbot.2012.v31.001',
'10.3989/collectbot.2012.v31.002',
'10.3989/collectbot.2012.v31.003',
'10.3989/collectbot.2012.v31.004',
'10.3989/collectbot.2012.v31.005',
'10.3989/collectbot.2012.v31.006',
'10.3989/collectbot.2012.v31.007',
'10.3989/collectbot.2012.v31.008',
'10.3989/collectbot.2012.v31.009',
'10.3989/collectbot.2010.v29.005',
'10.3989/collectbot.1990.v18.125',
'10.3989/collectbot.2000.v25.42',
'10.3989/collectbot.2000.v25.43',
'10.3989/collectbot.2000.v25.44',
'10.3989/collectbot.2000.v25.45',
'10.3989/collectbot.2000.v25.46',
'10.3989/collectbot.2000.v25.47',
'10.3989/collectbot.2000.v25.48',
'10.3989/collectbot.1998.v24.56',
'10.3989/collectbot.1998.v24.57',
'10.3989/collectbot.1998.v24.58',
'10.3989/collectbot.1998.v24.59',
'10.3989/collectbot.1997.v23.62',
'10.3989/collectbot.1997.v23.63',
'10.3989/collectbot.1997.v23.65',
'10.3989/collectbot.1997.v23.66',
'10.3989/collectbot.1997.v23.67',
'10.3989/collectbot.1997.v23.69',
'10.3989/collectbot.1997.v23.71',
'10.3989/collectbot.1993.v22.79',
'10.3989/collectbot.1993.v22.80',
'10.3989/collectbot.1993.v22.81',
'10.3989/collectbot.1993.v22.82',
'10.3989/collectbot.1993.v22.83',
'10.3989/collectbot.1993.v22.84',
'10.3989/collectbot.1993.v22.85',
'10.3989/collectbot.2016.v35.004',
'10.3989/collectbot.2016.v35.009',
'10.3989/collectbot.2016.v35.008',
'10.3989/collectbot.2016.v35.006',);


$dois=array(
'10.3989/collectbot.2010.v29.006',
'10.3989/collectbot.2010.v29.012',
'10.3989/collectbot.1988.v17.151',
'10.3989/collectbot.1988.v17.158',
'10.3989/collectbot.1988.v17.164v',
'10.3989/collectbot.1989.v17.145',
'10.3989/collectbot.1990.v18.128',
'10.3989/collectbot.1991.v20.110',
'10.3989/collectbot.2013.v32.002',
'10.3989/collectbot.2013.v32.009',
'10.3989/collectbot.2008.v28.012',
'10.3989/collectbot.2008.v28.001',
'10.3989/collectbot.2008.v28.002',
'10.3989/collectbot.2009.v28.34',
'10.3989/collectbot.2008.v28.007',
'10.3989/collectbot.2012.v31.004',
'10.3989/collectbot.2012.v31.007',
'10.3989/collectbot.2010.v29.005',
'10.3989/collectbot.2000.v25.47',
'10.3989/collectbot.1997.v23.66',
'10.3989/collectbot.1997.v23.69',
'10.3989/collectbot.1993.v22.80',
'10.3989/collectbot.1993.v22.83',
'10.3989/collectbot.1993.v22.84',
);

$dois=array('10.1144/GSL.JGS.1922.078.01-04.11');

$dois=array(
'10.1093/sysbio/syv085',
'10.1111/avj.12434',
'10.1086/686840'

);



// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI

$detect_languages = array('en', 'fr', 'de');
$detect_languages = array('en','pt', 'es', 'ca', 'fr');
//$detect_languages = array('en');

foreach ($dois as $doi)
{
	$go = true;
	
	$item = wikidata_item_from_doi($doi);
	
	if ($item != '')
	{
		if (!$update)
		{
			//echo "Have $item already $item\n";
			
			$go = false;
		}
	}
	if ($go)
	{
		$crossref = true;
		
		if (preg_match('/10.1071\/MR/i', $doi))
		{
			$crossref = false;
		}
	
		if ($crossref)
		{
			$work = get_work($doi);
		}
		else
		{
			$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($doi));
						
			$obj = json_decode($json);
			$work = new stdclass;
			$work->message = $obj;		
		}
	
		//print_r($work);
	
		if ($work)
		{
			$source = array();
			
			if ($crossref)
			{
				$source[] = 'S248';
				$source[] = 'Q5188229';
								
				if (preg_match('/[\[|<|;]/', $doi))
				{
					// Some DOIs (such as BioOne SICIs) break Quickstatements
					// so we don't add these as the source
				}
				else
				{				
					// DOI seems fine, so be explict about source of data
					$source[] = 'S854';
					$source[] = '"https://api.crossref.org/v1/works/' . $doi . '"';
				}
			}
			
			
		
			$q = csljson_to_wikidata(
				$work, 
				$check, 	// check if already exists
				$update, // true to update an existing record, false to skip an existing record
				$detect_languages,
				$source
				);
		
			echo $q;
			echo "\n";
		}
	}	


}


?>
