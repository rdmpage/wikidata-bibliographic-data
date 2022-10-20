<?php

// Add funder links to existing record
// These might not have been added by other bots


require_once (dirname(__FILE__) . '/wikidata.php');

require_once (dirname(__FILE__) . '/couchsimple.php');



$dois=array('10.1007/s13744-020-00798-3');

$dois=array('10.1155/2016/3952323');

$dois=array('10.1038/S41559-020-1269-4');

$dois=array('10.1016/j.pld.2016.11.010');

$dois=array('10.7717/peerj.6157');

$dois=array('10.3897/PHYTOKEYS.95.21586');

$dois=array('10.1177/0306312720920362');



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
		$q = update_funder_data($work, $source);
		echo $q;
		echo "\n";
	}
	else
	{
	}



}


?>
