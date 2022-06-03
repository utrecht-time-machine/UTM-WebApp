<?php



//owners



$owners = array();
$c = curl_init();
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_URL, api_utm.'owner.php');
curl_setopt($c, CURLOPT_TIMEOUT, 5);
curl_setopt($c, CURLOPT_AUTOREFERER, true);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
$d = curl_exec($c);
$h = curl_getinfo($c, CURLINFO_HTTP_CODE);
curl_close($c);
if($h == '200'){
	$data = json_decode($d, true);
	foreach($data as $e){
		$owners[$e['node']] = $e['name'];
	}
}
?>