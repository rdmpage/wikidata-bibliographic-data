<?php

// Add records to Wikidata from microcitation database

require_once (dirname(__FILE__) . '/wikidata.php');


$isbns=array(
//'9781486300143', // Taxonomy of Australian Mammals (I've added three reviews)


// Austtalian Bats
'187633407X', // 1st edition, Google has this _uVFAAAAYAAJ, but not with an ISBN
'978-1-74175-461-2', // 2nd edition 
);

$isbns=array(
//'9783930612802',
//'0620324155',
//'9780620324151'
//'9783899372502',
);

// The Bees of the World
$isbns=array(
'9780801861338', // first edition
'9780801885730', // second edition
);

// Reissuing of Buffon's "Histoire naturelle", in French
// 
// reviews 
// https://www.persee.fr/doc/phlou_0035-3841_2008_num_106_3_7794_t1_0609_0000_2
// https://doi.org/10.1086/681854
// https://doi.org/10.1086/660227
// doi:10.1353/mln.2014.0074
// see also https://data.bnf.fr/en/atelier/14476321/stephane_schmitt/
// http://sciences.amisbnf.org/fr/livre/histoire-naturelle-generale-et-particuliere-avec-la-description-du-cabinet-du-roi
// https://www.wikidata.org/wiki/Q3138032
// https://www.wikidata.org/wiki/Q51488912
// 
$isbns=array(
'9782745316011', 
);

$isbns=array(
'9034108538', // Volume 2, Parts 1-2
'9789057200984', // Volume 3, Part 1
'90-341-0852-X', // 1 (issue 1) 
'90-5720-098-8', // 3 (issue 1), ISBN 90-5720-099-6 (issue 2b). Reference page. 
'90-5720-099-6', // (issue 2b). Reference page. 
'90-5720-006-6', // 
);

$isbns=array(
//'9034108538',
//'9789034108524',
//'9789057200069',
'9789057200991',
'9789057200984',
);


$isbns=array(
'0124083552',
'9057820862',
'9780964018839',
);

$isbns=array(

//'9781482208474',
//'9781472935625'
//9781421401355
//9789980916969
'978-87-88-75727-9',
'978-87-88-75731-6',
'978-87-88-75741-5',
'978-87-88-75749-1',
'978-87-88-75762-0',
'978-87-88-75764-4',
'978-87-88-75768-2',
'978-87-88-75776-7',
'978-90-04-25918-8',
'978-90-04-26103-7',
'978-90-04-26104-4',
'978-90-04-26426-7',
'978-90-04-27184-5',
'978-90-04-28661-0',
'978-90-04-29177-5',
'978-90-04-37595-6',
);

$isbns=array(
//9780813010496,
9780226735375,
);

foreach ($isbns as $isbn)
{
	$quickstatements = googlebooks_to_wikidata($isbn, 'isbn');

	echo $quickstatements . "\n";
}




?>
