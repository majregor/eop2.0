<?php

$server = "192.168.16.219";

$connectionInfo = array("Database"=>"REMS_EOPAssist", "UID"=>"AU_REMS_EOPAssist", "PWD"=>"Hdff6&36R$5faSa!");

$conn  = sqlsrv_connect($server, $connectionInfo);
/*if(sqlsrv_configure("WarningsReturnAsErrors", 0)){
	echo("turned off<br>");
}*/

if(!$conn){

	$errors = sqlsrv_errors();
	if(is_array($errors) && !empty($errors) && count($errors)>0){
		foreach (sqlsrv_errors() as $key => $value) {
			if(is_array($value)){
				foreach ($value as $child_key => $child_value) {
					echo("&nbsp;&nbsp;Error: ".$child_key." => ". $child_value."<br>");
				}
			}else{
				echo("Error: ".$key." => ". print_r($value)."<br>");
			}			
		}
		die("<br/>something went wrong while connecting to the SQL Server<br>");
	}

}
else{
	echo ("Connection was successful");
}
?>