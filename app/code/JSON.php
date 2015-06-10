<?php


function getJSON()
{
	$url = "http://ios.cmoa.org/api/v2/sync.json";
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_ENCODING , "gzip");
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	
	$json = curl_exec($curl);
	curl_close($curl);
	return $json;
}

function getExhibitions()
{
	$json = getJSON();
	$data = json_decode($json);
	$exhib = $data->exhibitions;

	if($exhib != null)
	{
		$ret = array();
		foreach($exhib as $ex)
		{
			//if($ex->is_live)
			//{
				$ret[$ex->position] = $ex;
			//}
		}
		ksort ($ret);
			//var_dump($ret);
		return $ret;
	}
}

function getTours($e)
{
	$exhibs = getExhibitions();
	$exhib = $exhibs[$e];
	
	$json = getJSON();
	$data = json_decode($json);
	$tours = $data->tours;
	
	//var_dump($exhib);
	
	$eUUID = $exhib->uuid;
	
	$ret = array();
	foreach($tours as $t)
	{
		if($t->exhibition_uuid == $eUUID)
		{
			array_push($ret, $t);
		}
	}
	
	return $ret;
	

}

function getArtwork($uuid)
{
	$json = getJSON();
	$data = json_decode($json);
	$artworks = $data->artwork;
	
	$art = null;
	foreach($artworks as $a)
	{
		if($a->uuid == $uuid)
		{
			$art = $a;
			break;
		}
	}
	
	if(is_null($art)) return null;
	/*
	$artistWork = $data->artistArtworks;
	
	$artUUID = null;
	foreach($artistWork as $aw)
	{
		if($aw->artwork_uuid == $uuid)
		{
			$artUUID = $aw->artist_uuid;
			break;
		}
	}
	
	$artist = $data->artists;

	foreach($artist as $at)
	{
		if($at->uuid == $artUUID)
		{
			$art->artist = $at;
		}
	}
	*/
	return $art;
	
}

function getTourWorks($e, $t)
{
	$tours = getTours($e);
	$tour = $tours[$t];
	$tUUID = $tour->uuid;
	
	
	
	$json = getJSON();
	$data = json_decode($json);
	
	$artUUID = array();
	$artTour = $data->tourArtworks;
	
	foreach($artTour as $at)
	{
		if($at->tour_uuid == $tUUID)
		{
			$artUUID[$at->position] = $at->artwork_uuid;
		}
	}
	
	$ret = array();
	$artworks = $data->artwork;
	
	//var_dump($artUUID);
	
	foreach($artUUID as $k=>$a)
	{
		$ret[$k] = getArtwork($a);
	}
		
	return $ret;
	

}

?>