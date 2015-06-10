<?php

require_once "sqlConfig.php";

function getExhibitions()
{
	
	$query = "SELECT uuid, title, subtitle FROM exhibitions WHERE (is_live = TRUE OR TRUE) ORDER BY position"; //Remove 'OR TRUE' after testing
	$result = runQuery($query);
	
	$return = array();
	 while ($row = $result->fetch_assoc()) 
	 {
		array_push($return, $row);
	 }
	 return $return;
}

function getExhibit($uuid)
{
	$uuid = sqlSafe($uuid);
	$query = "SELECT title, bg_ipad_retina as imgurl FROM exhibitions WHERE uuid = '$uuid' ";
	
	$result = runQuery($query);
	$row = $result->fetch_assoc();
	
	return $row;
}

function getTours($uuid)
{
	$uuid = sqlSafe($uuid);
	$query = "SELECT title, subtitle, uuid FROM Tours WHERE exhibition_uuid = '$uuid'";
	$result = runQuery($query);
	
	$return = array();
	while ($row = $result->fetch_assoc()) 
	{
		array_push($return, $row);
	}
	return $return;
}

function getTourInfo($uuid)
{
	$uuid = sqlSafe($uuid);
	$query = "SELECT title, body, exhibition_uuid as eUUID FROM tours where uuid = '$uuid'";
	$result = runQuery($query);
	$row = $result->fetch_assoc();
	return $row;
}

function getTourWorks($uuid)
{
	$uuid = sqlSafe($uuid);
	$query = "SELECT CONCAT(ifnull(at.first_name,'') , ' ' , ifnull(at.last_name,'')) as Artist, aw.title as Title, ta.Position as Position, at.uuid as UUID FROM tourArtworks ta INNER JOIN  artwork aw on (aw.uuid = ta.artwork_uuid) LEFT JOIN artistartworks aa on (aw.uuid = aa.artwork_uuid) LEFT JOIN artists at on (aa.artist_uuid = at.uuid) WHERE ta.tour_uuid = '$uuid' ORDER BY ta.Position";

	$result = runQuery($query);
	
	$return = array();
	while ($row = $result->fetch_assoc()) 
	{
		array_push($return, $row);
	}
	return $return;
}

function getExhibitArtworks($uuid)
{
	$uuid = sqlSafe($uuid);
	$query = "select a.uuid, m.urlFull as url, m.title as title 	from artwork a 	left join media m on (m.artwork_uuid = a.uuid) 	where a.exhibition_uuid = '$uuid' 	and m.kind='image'	group by a.uuid ORDER BY a.title";
	
	$result = runQuery($query);
	
	$return = array();
	while ($row = $result->fetch_assoc()) 
	{
		array_push($return, $row);
	}
	return $return;

}


//General purpose query execution, writes errors to error log
function runQuery($query)
{
	$sql = getSQL();
	
	$result = mysqli_query($sql,  $query);

	if ($sql->error) 
	{
		error_log ( "SQL Error: " . $sql->error . " | Query: $query");
	}
	
	return $result;
}
//Do sql injection prevention here
function sqlSafe($data)
{
	$sql = getSQL();
	return $sql->real_escape_string($data);
}


?>