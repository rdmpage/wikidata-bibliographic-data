<?php

// Add funder links to existing record
// These might not have been added by other bots


require_once (dirname(__FILE__) . '/wikidata.php');


$dois=array('10.1007/s13744-020-00798-3');

$dois=array('10.1155/2016/3952323');

$dois=array('10.1038/S41559-020-1269-4');

$dois=array('10.1016/j.pld.2016.11.010');


foreach ($dois as $doi)
{
	$crossref = true;
	
	if (preg_match('/10.1071\/MR/i', $doi))
	{
		$crossref = false;
	}

	if ($crossref)
	{
		$work = get_work($doi);
		
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
