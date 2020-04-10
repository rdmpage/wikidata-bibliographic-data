<?php

// Add records to Wikidata from DOI

require_once (dirname(__FILE__) . '/wikidata.php');


$issn = '0375-099X';


//$works = works_for_journal($issn);


// Add DOI to articles in local database
$qid = 'Q41394003';

$works =  works_for_journal_from_qid($qid);

print_r($works);

foreach ($works as $work)
{
	if (isset($work->doi))
	{

		$issn = '0375-099X';
		$volume = '';
		$spage = '';
	
		if (isset($work->volume))
		{
			$volume = $work->volume;
		}
	
		if (isset($work->pages))
		{
			$spage = $work->pages;
			$spage = preg_replace('/[-|\–]\d+/u', '', $spage);
		}	
	
		if ($volume != '' && $spage != '')
		{
			echo 'UPDATE publications SET doi="' . $work->doi . '" WHERE issn="' . $issn . '" AND volume="' . $volume . '" AND spage="' . $spage . '";' . "\n";
	
		}
	}
}



?>
