<?php

// Add records to Wikidata from microcitation database

require_once (dirname(__FILE__) . '/wikidata.php');


$isbns=array(
//'9781486300143', // Taxonomy of Australian Mammals (I've added three reviews)


// Austtalian Bats
'187633407X', // 1st edition, Google has this _uVFAAAAYAAJ, but not with an ISBN
'978-1-74175-461-2', // 2nd edition 
);


foreach ($isbns as $isbn)
{
	$quickstatements = googlebooks_to_wikidata($isbn);

	echo $quickstatements . "\n";
}




?>
