<?php


function getJSON()
{
	$url = "http://ios.cmoa.org/api/v2/sync.json";
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_ENCODING , "gzip");
	
	$json = curl_exec($curl);
	curl_close($curl);
	return $json;
}

function getExhibitions()
{
	$json = getJSON();
	$data = json_decode($json);
	$exhib = data["exhibitions"];
	
	$ret = array();
	foreach($exhib as $e)
	{
		if($e["is_live"])
		{
			array_push($ret, $e);
		}
	}
	return $ret;
}

?>