<?php

// Add citation links to existing record
// For example, item may have been added before many of the articles that it cites
// so those links will be missing, this will add them.


require_once (dirname(__FILE__) . '/wikidata.php');


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
		$q = update_citation_data($work, $source);
		echo $q;
		echo "\n";
	}
	else
	{
	}



}


?>
