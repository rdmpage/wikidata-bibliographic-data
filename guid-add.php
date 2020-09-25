<?php

// Add records to Wikidata from microcitation database

require_once (dirname(__FILE__) . '/wikidata.php');


$guids=array(
//'http://peckhamia.com/peckhamia/PECKHAMIA_141.1.pdf',
/*
'http://peckhamia.com/peckhamia/PECKHAMIA_103.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_104.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_114.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_117.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_121.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_136.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_141.1.pdf',
*/

// 'http://rcin.org.pl/dlibra/doccontent?id=57916',
'http://peckhamia.com/peckhamia/PECKHAMIA_150.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_149.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_148.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_147.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_146.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_145.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_144.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_143.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_142.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_141.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_140.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_139.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_138.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_137.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_136.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_135.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_134.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_133.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_132.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_131.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_130.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_129.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_128.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_127.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_126.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_125.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_124.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_123.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_122.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_121.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_120.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_119.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_118.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_117.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_116.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_115.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_114.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_111.2.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_113.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_112.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_111.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_110.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_109.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_108.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_106.2.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_107.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_106.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_105.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_103.2.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_104.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_103.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_102.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_101.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_100.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_99.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_95.3.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_95.2.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_98.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_97.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_96.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_95.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_94.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_93.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_92.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_91.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_90.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_86.2.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_89.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_88.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_87.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_86.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA_85.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2084.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2083.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2082.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2081.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2080.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2079.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2078.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2077.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2076.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2075.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2074.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2073.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2071.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2030.2.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2024.2.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2070.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2069.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2068.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2066.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2065.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2064.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2063.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2062.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2061.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2060.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2059.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2058.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2057.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2055.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2053.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2052.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2050.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2049.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2048.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2047.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2046.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2044.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2043.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2042.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2041.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2040.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2038.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2034.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2033.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2032.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2030.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2029.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2028.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2027.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2026.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2025.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2024.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2021.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2020.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2019.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2016.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2015.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2014.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2013.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2012.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2011.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%2010.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%209.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%208.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%206.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%205.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%203.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%202.1.pdf',
'http://peckhamia.com/peckhamia/PECKHAMIA%201.1.pdf',
);


$guids = array(
//'10.3969/j.issn.1005-9628.2016.02.001',
//'http://www.repository.naturalis.nl/record/317698',
//'http://www.repository.naturalis.nl/record/319218',
//'10.11646/zootaxa.3779.2.7'
//'http://www.repository.naturalis.nl/record/317698',

//'https://www.zin.ru/journals/parazitologiya/content/1989/prz_1989_2_12_Alekseev.pdf',
//'http://www.cnki.com.cn/Article/CJFDTOTAL-KCFL199302003.htm',

//'10.26028/cybium/2012-362-008',

//'http://www.biodiversitylibrary.org/part/127143'
//'http://www.biodiversitylibrary.org/part/125502',

//'https://revistas.udea.edu.co/index.php/actbio/article/view/329608'

//'http://www.jstor.org/stable/20792616'

'http://www.jstor.org/stable/43152814',
);

$guids = array(
'http://bibdigital.epn.edu.ec/handle/15000/3840',
'http://bibdigital.epn.edu.ec/handle/15000/4775',
'http://bibdigital.epn.edu.ec/handle/15000/4796',
'http://bibdigital.epn.edu.ec/handle/15000/4791',
'http://bibdigital.epn.edu.ec/handle/15000/4790',
);


$guids = array(
//'https://www.schweizerbart.de/publications/detail/isbn/9783510613779/Abhandlungen_d_Senckenb_Naturf_Gesell',
//'https://www.schweizerbart.de/publications/detail/artno/190949000/Die-Amphibien-und-Reptilien-Sdwestafrikas'


'10.1080/00222933809512277',
'10.1080/00222933809512292',
'10.1080/00222933809512314',
'10.1080/00222933809512318',
'10.1080/00222933809512343',
'10.1080/00222934009512448',
'10.1080/00222935408651694',
'10.1080/00222935608697531',
'10.1080/00222935808696971',
'10.1080/00222935808696991',
'10.1080/00222935908697097',
'10.1080/00222936008697304',
'10.1080/00222936008697339',
'10.1080/00222936108697387',
'10.1080/00222936108697436',
'10.1080/00222936208681193',
'10.1080/00222936308681416',
'10.1080/00222936408681639',
'10.1080/00222936408681667',
'10.1080/00222936608679494',
'10.1080/00222936608679523',
'10.1080/00222936708562710',
'10.1080/00222936708679704',
'10.1080/00222936708679754',
'10.1080/00222936708694112',
'10.1080/00222936808695745',
'10.1080/00222936908695891',
'10.1080/00222936908695919',
'10.1080/03745483909443242',
'10.1080/03745483909443258',
'10.1080/03745485909494610',

);

$guids=array('http://www.jjbotany.com/getpdf.php?aid=11001');

$guids = array('10.7525/j.issn.1673-5102.2017.03.001');

$languages = array('en', 'zh');
$source = array();

foreach ($guids as $guid)
{
	$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($guid));
				
	$obj = json_decode($json);
	$work = new stdclass;
	$work->message = $obj;		

	print_r($work);
	
	$source = array();
	$source[] = 'S854';
	//$source[] = '"' . $guid . '"';
	$source[] = '"' . $obj->URL . '"';


	$item = wikidata_find_from_anything ($work);
	
	if ($item != '')
	{
		echo "Have already $item\n";
		
		// for debugging, or updating
		if (0)
		{
			$q = csljson_to_wikidata($work, true, true, $languages, $source);
	
			echo $q;
			echo "\n";		
		}
	}
	else
	{
		$q = csljson_to_wikidata($work, true, true, $languages, $source);
	
		echo $q;
		echo "\n";
	}	


}


?>
