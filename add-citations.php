<?php

require_once (dirname(__FILE__) . '/wikidata.php');


// add citation links manually


// DOI of work
$source = '10.18352/ijc.859';

$source_url = '';
$source_url = 'https://www.thecommonsjournal.org/article/10.18352/ijc.859/';


// list of DOIs cited by that work
$targets = array(
'10.1001/jama.287.21.2847',
'10.1007/s11192-011-0370-5',
'10.1016/j.atg.2016.03.003',
'10.1016/j.cub.2012.01.036',
'10.1016/j.envsci.2015.08.006',
'10.1016/j.foodres.2008.07.005',
'10.1016/j.fsigen.2013.12.007',
'10.1016/j.nbt.2015.10.002',
'10.1016/j.resmic.2010.04.012',
'10.1016/S0140-6736(05)60031-1',
'10.1016/S0169-5347(02)00040-X',
'10.1016/S0169-5347(02)00041-1',
'10.1038/434697b',
'10.1038/461168a',
'10.1038/461171a',
'10.1038/467779a',
'10.1038/4341067b',
'10.1038/scientificamerican1008-82',
'10.1073/pnas.0712181105',
'10.1073/pnas.0905845106',
'10.1073/pnas.1117018109',
'10.1086/507185',
'10.1089/omi.2013.0158',
'10.1093/nar/gks1084',
'10.1093/nar/gks1195',
'10.1098/rspb.2002.2218',
'10.1098/rstb.2003.1444',
'10.1098/rstb.2005.1722',
'10.1111/1755-0998.12046',
'10.1111/j.1096-0031.2003.00008.x',
'10.1111/j.1365-294X.2012.05642.x',
'10.1111/j.1467-7660.2004.00360.x',
'10.1111/j.1471-8286.2007.01678.x',
'10.1126/science.300.5626.1692',
'10.1126/science.1084564',
'10.1126/science.1180598',
'10.1139/gen-2015-0087',
'10.1139/gen-2015-0094',
'10.1139/gen-2015-0210',
'10.1177/0968533212458431',
'10.1177/160940690200100202',
'10.1186/1471-2164-9-214',
'10.1371/journal.pbio.0020354',
'10.1371/journal.pbio.1000417',
'10.1371/journal.pbio.1002060',
'10.1641/0006-3568(2003)053%5B0796:TDATBC%5D2.0.CO;2',
'10.2307/1073395',
'10.3897/natureconservation.12.5412',
'10.3897/zookeys.365.6027',
'10.15779/Z38GW9F',
'10.18352/ijc.215',
'10.18352/ijc.325'
);

/*
$targets = array(
'10.1001/jama.287.21.2847',
'10.1007/s11192-011-0370-5',
);
*/


$source_item = wikidata_item_from_doi($source);

$w = array();
$quickstatements = '';

if ($source_item != '')
{
	foreach ($targets as $target)
	{
		$target_item = wikidata_item_from_doi($target);
		
		if ($target_item != '')
		{
			$w[] = array('P2860' => $target_item);
		
		}

	}


}

foreach ($w as $statement)
{
	foreach ($statement as $property => $value)
	{
		$row = array();
		$row[] = $source_item;
		$row[] = $property;
		$row[] = $value;
	
		$quickstatements .= join("\t", $row);
		
		if ($source_url != '')
		{
			$quickstatements .= "\tS854\t" . '"' . $source_url . '"';
		}
		
		
		$quickstatements .= "\n";
	
	}
}

echo $quickstatements . "\n";

?>
