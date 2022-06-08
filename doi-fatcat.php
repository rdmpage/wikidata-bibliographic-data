<?php

// DOI to fatcat.wiki


//----------------------------------------------------------------------------------------
function get($url)
{	
	$data = null;

	$opts = array(
	  CURLOPT_URL =>$url,
	  CURLOPT_FOLLOWLOCATION => TRUE,
	  CURLOPT_RETURNTRANSFER => TRUE,
	  CURLOPT_SSL_VERIFYHOST=> FALSE,
	  CURLOPT_SSL_VERIFYPEER=> FALSE
	);
	
	$ch = curl_init();
	curl_setopt_array($ch, $opts);
	$data = curl_exec($ch);
	$info = curl_getinfo($ch); 
	curl_close($ch);
	
	return $data;
}



$dois=array("10.18590/euscorpius.2001.vol2001.iss1.1",
"10.18590/euscorpius.2002.vol2002.iss2.2",
"10.18590/euscorpius.2002.vol2002.iss3.1",
"10.18590/euscorpius.2003.vol2003.iss4.1",
"10.18590/euscorpius.2003.vol2003.iss5.1",
"10.18590/euscorpius.2003.vol2003.iss6.1",
"10.18590/euscorpius.2003.vol2003.iss7.1",
"10.18590/euscorpius.2003.vol2003.iss8.1",
"10.18590/euscorpius.2003.vol2003.iss9.1",
"10.18590/euscorpius.2003.vol2003.iss10.1",
"10.18590/euscorpius.2003.vol2003.iss11.1",
"10.18590/euscorpius.2004.vol2004.iss12.1",
"10.18590/euscorpius.2004.vol2004.iss13.1",
"10.18590/euscorpius.2004.vol2004.iss14.1",
"10.18590/euscorpius.2004.vol2004.iss15.1",
"10.18590/euscorpius.2004.vol2004.iss16.1",
"10.18590/euscorpius.2004.vol2004.iss17.1",
"10.18590/euscorpius.2005.vol2005.iss18.1",
"10.18590/euscorpius.2005.vol2005.iss19.1",
"10.18590/euscorpius.2005.vol2005.iss20.1",
"10.18590/euscorpius.2005.vol2005.iss21.1",
"10.18590/euscorpius.2005.vol2005.iss22.1",
"10.18590/euscorpius.2005.vol2005.iss23.1",
"10.18590/euscorpius.2005.vol2005.iss24.1",
"10.18590/euscorpius.2005.vol2005.iss25.1",
"10.18590/euscorpius.2005.vol2005.iss26.1",
"10.18590/euscorpius.2005.vol2005.iss27.1",
"10.18590/euscorpius.2005.vol2005.iss28.1",
"10.18590/euscorpius.2005.vol2005.iss29.1",
"10.18590/euscorpius.2005.vol2005.iss30.1",
"10.18590/euscorpius.2005.vol2005.iss31.1",
"10.18590/euscorpius.2005.vol2005.iss32.1",
"10.18590/euscorpius.2006.vol2006.iss33.1",
"10.18590/euscorpius.2006.vol2006.iss34.1",
"10.18590/euscorpius.2006.vol2006.iss35.1",
"10.18590/euscorpius.2006.vol2006.iss36.1",
"10.18590/euscorpius.2006.vol2006.iss37.1",
"10.18590/euscorpius.2006.vol2006.iss38.1",
"10.18590/euscorpius.2006.vol2006.iss39.1",
"10.18590/euscorpius.2006.vol2006.iss40.1",
"10.18590/euscorpius.2006.vol2006.iss41.1",
"10.18590/euscorpius.2006.vol2006.iss42.1",
"10.18590/euscorpius.2006.vol2006.iss43.1",
"10.18590/euscorpius.2006.vol2006.iss44.1",
"10.18590/euscorpius.2006.vol2006.iss45.1",
"10.18590/euscorpius.2006.vol2006.iss46.1",
"10.18590/euscorpius.2006.vol2006.iss47.1",
"10.18590/euscorpius.2006.vol2006.iss48.1",
"10.18590/euscorpius.2006.vol2006.iss49.1",
"10.18590/euscorpius.2007.vol2007.iss50.1",
"10.18590/euscorpius.2007.vol2007.iss50.2",
"10.18590/euscorpius.2007.vol2007.iss51.1",
"10.18590/euscorpius.2007.vol2007.iss52.1",
"10.18590/euscorpius.2007.vol2007.iss53.1",
"10.18590/euscorpius.2007.vol2007.iss54.1",
"10.18590/euscorpius.2007.vol2007.iss55.1",
"10.18590/euscorpius.2007.vol2007.iss56.1",
"10.18590/euscorpius.2007.vol2007.iss57.2",
"10.18590/euscorpius.2007.vol2007.iss58.1",
"10.18590/euscorpius.2007.vol2007.iss59.1",
"10.18590/euscorpius.2007.vol2007.iss60.1",
"10.18590/euscorpius.2007.vol2007.iss61.1",
"10.18590/euscorpius.2008.vol2008.iss63.1",
"10.18590/euscorpius.2008.vol2008.iss64.1",
"10.18590/euscorpius.2008.vol2008.iss65.1",
"10.18590/euscorpius.2008.vol2008.iss66.1",
"10.18590/euscorpius.2008.vol2008.iss67.1",
"10.18590/euscorpius.2008.vol2008.iss68.1",
"10.18590/euscorpius.2008.vol2008.iss69.1",
"10.18590/euscorpius.2008.vol2008.iss70.1",
"10.18590/euscorpius.2008.vol2008.iss71.1",
"10.18590/euscorpius.2008.vol2008.iss72.1",
"10.18590/euscorpius.2008.vol2008.iss73.1",
"10.18590/euscorpius.2008.vol2008.iss74.1",
"10.18590/euscorpius.2008.vol2008.iss75.1",
"10.18590/euscorpius.2008.vol2008.iss76.1",
"10.18590/euscorpius.2009.vol2009.iss77.1",
"10.18590/euscorpius.2009.vol2009.iss78.1",
"10.18590/euscorpius.2009.vol2009.iss79.1",
"10.18590/euscorpius.2009.vol2009.iss80.1",
"10.18590/euscorpius.2009.vol2009.iss81.1",
"10.18590/euscorpius.2009.vol2009.iss82.1",
"10.18590/euscorpius.2009.vol2009.iss83.1",
"10.18590/euscorpius.2009.vol2009.iss84.1",
"10.18590/euscorpius.2009.vol2009.iss85.1",
"10.18590/euscorpius.2009.vol2009.iss86.1",
"10.18590/euscorpius.2009.vol2009.iss87.1",
"10.18590/euscorpius.2009.vol2009.iss88.1",
"10.18590/euscorpius.2009.vol2009.iss89.1",
"10.18590/euscorpius.2009.vol2009.iss90.1",
"10.18590/euscorpius.2010.vol2010.iss91.1",
"10.18590/euscorpius.2010.vol2010.iss92.1",
"10.18590/euscorpius.2010.vol2010.iss93.1",
"10.18590/euscorpius.2010.vol2010.iss94.1",
"10.18590/euscorpius.2010.vol2010.iss95.1",
"10.18590/euscorpius.2010.vol2010.iss96.1",
"10.18590/euscorpius.2010.vol2010.iss97.1",
"10.18590/euscorpius.2010.vol2010.iss98.1",
"10.18590/euscorpius.2010.vol2010.iss99.1",
"10.18590/euscorpius.2010.vol2010.iss100.1",
"10.18590/euscorpius.2010.vol2010.iss100.2",
"10.18590/euscorpius.2010.vol2010.iss101.1",
"10.18590/euscorpius.2010.vol2010.iss102.1",
"10.18590/euscorpius.2010.vol2010.iss103.1",
"10.18590/euscorpius.2010.vol2010.iss104.1",
"10.18590/euscorpius.2010.vol2010.iss104.2",
"10.18590/euscorpius.2010.vol2010.iss105.1",
"10.18590/euscorpius.2010.vol2010.iss106.1",
"10.18590/euscorpius.2010vol2010.iss106.1",
"10.18590/euscorpius.2011.vol2011.iss107.1",
"10.18590/euscorpius.2011.vol2011.iss108.1",
"10.18590/euscorpius.2011.vol2011.iss109.1",
"10.18590/euscorpius.2011.vol2011.iss110.1",
"10.18590/euscorpius.2011.vol2011.iss111.1",
"10.18590/euscorpius.2011.vol2011.iss112.1",
"10.18590/euscorpius.2011.vol2011.iss113.1",
"10.18590/euscorpius.2011.vol2011.iss115.1",
"10.18590/euscorpius.2011.vol2011.iss116.1",
"10.18590/euscorpius.2011.vol2011.iss117.1",
"10.18590/euscorpius.2011.vol2011.iss118.1",
"10.18590/euscorpius.2011.vol2011.iss119.1",
"10.18590/euscorpius.2011.vol2011.iss120.1",
"10.18590/euscorpius.2011.vol2011.iss121.1",
"10.18590/euscorpius.2011.vol2011.iss122.1",
"10.18590/euscorpius.2011.vol2011.iss123.1",
"10.18590/euscorpius.2011.vol2011.iss124.1",
"10.18590/euscorpius.2011.vol2011.iss125.1",
"10.18590/euscorpius.2011.vol2011.iss126.1",
"10.18590/euscorpius.2011.vol2011.iss127.1",
"10.18590/euscorpius.2011.vol2011.iss128.1",
"10.18590/euscorpius.2011.vol2011.iss129.1",
"10.18590/euscorpius.2011.vol2011.iss130.1",
"10.18590/euscorpius.2011.vol2011.iss132.1",
"10.18590/euscorpius.2011.vol2011.iss133.1",
"10.18590/euscorpius.2011.vol2011.iss134.1",
"10.18590/euscorpius.2011.vol2011.iss135.1",
"10.18590/euscorpius.2011.vol2011.iss136.1",
"10.18590/euscorpius.2012.vol2012.iss137.1",
"10.18590/euscorpius.2012.vol2012.iss138.1",
"10.18590/euscorpius.2012.vol2012.iss139.1",
"10.18590/euscorpius.2012.vol2012.iss140.1",
"10.18590/euscorpius.2012.vol2012.iss141.1",
"10.18590/euscorpius.2012.vol2012.iss142.1",
"10.18590/euscorpius.2012.vol2012.iss143.1",
"10.18590/euscorpius.2012.vol2012.iss144.1",
"10.18590/euscorpius.2012.vol2012.iss145.1",
"10.18590/euscorpius.2012.vol2012.iss146.1",
"10.18590/euscorpius.2012.vol2012.iss147.1",
"10.18590/euscorpius.2012.vol2012.iss148.1",
"10.18590/euscorpius.2012.vol2012.iss149.2",
"10.18590/euscorpius.2012.vol2012.iss150.1",
"10.18590/euscorpius.2012.vol2012.iss151.1",
"10.18590/euscorpius.2013.vol2013.iss153.1",
"10.18590/euscorpius.2013.vol2013.iss154.1",
"10.18590/euscorpius.2013.vol2013.iss155.1",
"10.18590/euscorpius.2013.vol2013.iss156.1",
"10.18590/euscorpius.2013.vol2013.iss157.1",
"10.18590/euscorpius.2013.vol2013.iss158.1",
"10.18590/euscorpius.2013.vol2013.iss159.1",
"10.18590/euscorpius.2013.vol2013.iss160.2",
"10.18590/euscorpius.2013.vol2013.iss161.1",
"10.18590/euscorpius.2013.vol2013.iss162.1",
"10.18590/euscorpius.2013.vol2013.iss163.1",
"10.18590/euscorpius.2013.vol2013.iss164.1",
"10.18590/euscorpius.2013.vol2013.iss165.1",
"10.18590/euscorpius.2013.vol2013.iss166.1",
"10.18590/euscorpius.2013.vol2013.iss167.1",
"10.18590/euscorpius.2013.vol2013.iss168.1",
"10.18590/euscorpius.2013.vol2013.iss169.1",
"10.18590/euscorpius.2013.vol2013.iss170.1",
"10.18590/euscorpius.2013.vol2013.iss171.1",
"10.18590/euscorpius.2013.vol2013.iss172.1",
"10.18590/euscorpius.2013.vol2013.iss173.1",
"10.18590/euscorpius.2013.vol2013.iss175.1",
"10.18590/euscorpius.2013.vol2013.iss176.1",
"10.18590/euscorpius.2013.vol2013.iss177.1",
"10.18590/euscorpius.2013.vol2013.iss178.1",
"10.18590/euscorpius.2013.vol2013.iss179.1",
"10.18590/euscorpius.2014.vol2014.iss180.1",
"10.18590/euscorpius.2014.vol2014.iss181.1",
"10.18590/euscorpius.2014.vol2014.iss182.1",
"10.18590/euscorpius.2014.vol2014.iss183.1",
"10.18590/euscorpius.2014.vol2014.iss184.1",
"10.18590/euscorpius.2014.vol2014.iss185.1",
"10.18590/euscorpius.2014.vol2014.iss186.1",
"10.18590/euscorpius.2014.vol2014.iss188.1",
"10.18590/euscorpius.2014.vol2014.iss189.1",
"10.18590/euscorpius.2014.vol2014.iss190.1",
"10.18590/euscorpius.2014.vol2014.iss191.1",
"10.18590/euscorpius.2014.vol2014.iss192.1",
"10.18590/euscorpius.2014.vol2014.iss193.1",
"10.18590/euscorpius.2015.vol2015.iss194.1",
"10.18590/euscorpius.2015.vol2015.iss195.1",
"10.18590/euscorpius.2015.vol2015.iss196.1",
"10.18590/euscorpius.2015.vol2015.iss197.1",
"10.18590/euscorpius.2015.vol2015.iss198.1",
"10.18590/euscorpius.2015.vol2015.iss199.1",
"10.18590/euscorpius.2015.vol2015.iss200.1",
"10.18590/euscorpius.2015.vol2015.iss200.2",
"10.18590/euscorpius.2015.vol2015.iss201.1",
"10.18590/euscorpius.2015.vol2015.iss202.1",
"10.18590/euscorpius.2015.vol2015.iss203.1",
"10.18590/euscorpius.2015.vol2015.iss204.1",
"10.18590/euscorpius.2015.vol2015.iss205.1",
"10.18590/euscorpius.2015.vol2015.iss206.1",
"10.18590/euscorpius.2015.vol2015.iss207.1",
"10.18590/euscorpius.2015.vol2015.iss208.1",
"10.18590/euscorpius.2015.vol2015.iss209.1",
"10.18590/euscorpius.2015.vol2015.iss210.1",
"10.18590/euscorpius.2015.vol2015.iss211.1",
"10.18590/euscorpius.2015.vol2015.iss212.1",
"10.18590/euscorpius.2015.vol2015.iss213.1",
"10.18590/euscorpius.2016.vol2016.iss214.1",
"10.18590/euscorpius.2016.vol2016.iss215.1",
"10.18590/euscorpius.2016.vol2016.iss216.1",
"10.18590/euscorpius.2016.vol2016.iss217.1",
"10.18590/euscorpius.2016.vol2016.iss218.1",
"10.18590/euscorpius.2016.vol2016.iss219.1",
"10.18590/euscorpius.2016.vol2016.iss220.1",
"10.18590/euscorpius.2016.vol2016.iss221.1",
"10.18590/euscorpius.2016.vol2016.iss222.1",
"10.18590/euscorpius.2016.vol2016.iss223.1",
"10.18590/euscorpius.2016.vol2016.iss224.1",
"10.18590/euscorpius.2016.vol2016.iss225.1",
"10.18590/euscorpius.2016.vol2016.iss226.1",
"10.18590/euscorpius.2016.vol2016.iss227.1",
"10.18590/euscorpius.2016.vol2016.iss228.1",
"10.18590/euscorpius.2016.vol2016.iss229.1",
"10.18590/euscorpius.2016.vol2016.iss230.1",
"10.18590/euscorpius.2016.vol2016.iss231.1",
"10.18590/euscorpius.2016.vol2016.iss232.1",
"10.18590/euscorpius.2016.vol2016.iss233.1",
"10.18590/euscorpius.2016.vol2016.iss235.1",
"10.18590/euscorpius.2017.vol2017.iss237.1",
"10.18590/euscorpius.2017.vol2017.iss238.1",
"10.18590/euscorpius.2017.vol2017.iss239.1",
"10.18590/euscorpius.2017.vol2017.iss240.1",
"10.18590/euscorpius.2017.vol2017.iss241.1",
"10.18590/euscorpius.2017.vol2017.iss242.1",
"10.18590/euscorpius.2017.vol2017.iss244.1",
"10.18590/euscorpius.2017.vol2017.iss245.1",
"10.18590/euscorpius.2017.vol2017.iss246.1",
"10.18590/euscorpius.2017.vol2017.iss247.1",
"10.18590/euscorpius.2017.vol2017.iss248.1",
"10.18590/euscorpius.2017.vol2017.iss249.1",
"10.18590/euscorpius.2017.vol2017.iss250.1",
"10.18590/euscorpius.2017.vol2017.iss251.1",
"10.18590/euscorpius.2017.vol2017.iss252.1",
"10.18590/euscorpius.2017.vol2017.iss253.1",
"10.18590/euscorpius.2017.vol2017.iss254.1",
"10.18590/euscorpius.2018.vol2018.iss255.1",
"10.18590/euscorpius.2018.vol2018.iss256.1",
"10.18590/euscorpius.2018.vol2018.iss257.1",
"10.18590/euscorpius.2018.vol2018.iss258.1",
"10.18590/euscorpius.2018.vol2018.iss259.1",
"10.18590/euscorpius.2018.vol2018.iss260.1",
"10.18590/euscorpius.2018.vol2018.iss261.1",
"10.18590/euscorpius.2018.vol2018.iss262.1",
"10.18590/euscorpius.2018.vol2018.iss263.1",
"10.18590/euscorpius.2018.vol2018.iss264.1",
"10.18590/euscorpius.2018.vol2018.iss265.1",
"10.18590/euscorpius.2018.vol2018.iss266.1",
"10.18590/euscorpius.2018.vol2018.iss267.1",
"10.18590/euscorpius.2018.vol2018.iss268.1",
"10.18590/euscorpius.2018.vol2018.iss269.1",
"10.18590/euscorpius.2018.vol2018.iss271.1",
"10.18590/euscorpius.2019.vol2019.iss239.1",
"10.18590/euscorpius.2019.vol2019.iss279.1",
"10.18590/euscorpius.2019.vol2019.iss286.2",
"10.18590/euscorpius.2019.vol2019.iss289.1",
"10.18590/euscorpius.2019.vol2019.iss291.1",
"10.18590/issn.1536-9307/2011v.2011.issue131.1",);

$count = 1;


foreach ($dois as $doi)
{
	$doi = strtolower($doi);

	//echo $doi . "\n";
	
	$url = 'https://api.fatcat.wiki/v0/release/lookup?doi=' . urlencode($doi);
	
	//echo $url . "\n";
	
	$json = get($url);
	
	//echo $json . "\n";
	
	$obj = json_decode($json);
	
	//print_r($obj);
	
	if (isset($obj->ident))
	{
		//echo 'UPDATE publications_tmp SET xml="release_' . $obj->ident . '" WHERE doi="' . $doi . '";' . "\n";
		echo 'UPDATE publications SET xml="release_' . $obj->ident . '" WHERE doi="' . $doi . '";' . "\n";
	}


	
	// Give server a break every 10 items
	if (($count++ % 10) == 0)
	{
		$rand = rand(1000000, 3000000);
		echo "\n-- ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
		usleep($rand);
	}

}


?>
