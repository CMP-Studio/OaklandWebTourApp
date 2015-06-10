<?php

require_once "sqlConfig.php";

import();

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

function import()
{

	$sql = getSQL();
	$json = getJSON();
	$data = json_decode($json);
	
	print "<pre>";
	
	foreach($data as $table=>$entry)
	{
		if($table == "status") continue;
		if($table == "likes") continue;
		$setup = true;

		$query = "TRUNCATE TABLE $table";
		if(!mysqli_query($sql,  $query))
		{
			 printf("T Error: %s\n", $sql->error);
		
		}
		
		$query = "Insert INTO $table ";
		$colList = "(";
		$valList = "";
		foreach($entry as $e)
		{
			$valList .= "(";
			foreach($e as $col=>$row)
			{
				if($setup)
				{
					$colList .= $col . ",";
				}
				if($row == null)
				{
					$valList .= "null,";
				}
				else
				{
					$row = $sql->real_escape_string($row);
					$valList .= "'$row',";
				}
			
			}
			
			$valList = trim($valList,",") . ") ,";
			
			if($setup)
			{
				$colList = trim($colList,",") . ")";
				$setup = false;
			}
			
		}
		
		$valList = trim($valList,",");
		
		$query .= $colList . " VALUES " . $valList; 
		
		$query = $query;
		
		print $query . "\n";
		
		
		if(!mysqli_query($sql,  $query))
		{
			 printf("I Error: %s\n", $sql->error);
		
		}
	}
	

	
		$query = "TRUNCATE TABLE Status";
		if(!mysqli_query($sql,  $query))
		{
			 printf("T Error: %s\n", $sql->error);
		
		}
		$query = "INSERT INTO Status (updated_at) VALUES (NOW())";
		if(!mysqli_query($sql,  $query))
		{
			 printf("I Error: %s\n", $sql->error);
		
		}
		print "</pre>";

}


?>