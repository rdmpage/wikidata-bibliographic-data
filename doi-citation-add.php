<?php

// Add citation links to existing record
// For example, item may have been added before many of the articles that it cites
// so those links will be missing, this will add them.


require_once (dirname(__FILE__) . '/wikidata.php');
require_once (dirname(__FILE__) . '/couchsimple.php');


$dois=array('10.1645/ge-3525.1');

$dois=array('10.1007/s11230-010-9279-2');


$dois=array(
'10.1016/S0140-6736(00)71405-X',
'10.1016/S0140-6736(01)51908-X',
'10.1017/S0007485300027930',
'10.1017/S0031182000026500',
'10.1080/00034983.1907.11719252',
'10.1080/00034983.1907.11719258',
'10.1080/00034983.1907.11719259',
'10.1111/j.1096-3642.1949.tb00888.x',
'10.1080/00034983.1907.11719252',
'10.1080/00034983.1930.11684624',
'10.1080/00034983.1990.11812482',
"10.1007/BF02122545",
);

$dois=array('10.1017/S0031182000026500');

$dois=array('10.1644/09-MAMM-A-325.1');

$dois=array('10.1134/S0013873818070114');

$dois=array('10.1007/s13744-020-00798-3');

$dois=array('10.1038/S41598-019-42310-X');

$dois=array('10.1644/11-mamm-a-296.1');

$dois=array('10.1017/s1477200006002271');

// Many citations, none with DOIs included, need to start manual lookup 
$dois=array('10.1038/S41559-020-1269-4');

$dois=array('10.1093/jme/tjy108');

$dois=array('10.1016/j.pld.2016.08.003');

$dois=array('10.3109/19401736.2013.803543');

$dois=array('10.7717/peerj.6157');
$dois=array('10.3897/PHYTOKEYS.95.21586');

$dois=array("10.1007/s12225-016-9650-9");

$dois=array("10.1002/TAX.12273");

$dois=array('10.1016/j.ympev.2018.04.016');

$dois=array('10.3897/ZOOKEYS.1012.57172');

$dois=array('10.3372/wi.46.46202');

$dois=array('10.3897/PHYTOKEYS.157.32683');

$dois=array('10.1038/S41598-020-80955-1');

$dois=array('10.3897/NATURECONSERVATION.15.10005');

$dois=array('10.1126/science.aaw2090');
$dois=array('10.1080/00275514.2019.1668906');
$dois=array('10.1371/JOURNAL.PBIO.3000736');
$dois=array('10.1016/S1631-0691(03)00158-6');
$dois=array('10.1186/S12983-020-00375-9');
$dois=array('10.1002/AQC.3038');
$dois=array('10.1111/joa.12999');
$dois=array('10.3390/JOF6040251');

$dois=array('10.1080/00269786.1983.11758568');

$dois=array('10.1080/13887890.2017.1331867');

$dois=array('10.1177/0306312720920362');

$dois=array('10.3109/13813454809144859');

$dois=array('10.1080/23802359.2020.1714495');


foreach ($dois as $doi)
{
	$crossref = true;
	
	if (preg_match('/10.1071\/MR/i', $doi))
	{
		$crossref = false;
	}

	if ($crossref)
	{
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
		
		print_r($work);
		
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
		$q = update_citation_data($work, $source);
		echo $q;
		echo "\n";
	}
	else
	{
	}



}


?>
