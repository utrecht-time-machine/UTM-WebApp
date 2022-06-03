<?php



//set params



$utm = false;
$utm_owner = false;
$var1 = preg_replace('/[^\da-z]/i', '', $_REQUEST['var1']);
$var2 = preg_replace('/[^\da-z]/i', '', $_REQUEST['var2']);
$vars = (!empty($var1) ? 'lang='.$var1 : '').(!empty($var2) ? (!empty($var1) ? '&' : '').'org='.$var2 : '');
$vars = (!empty($vars) ? '?'.$vars : '');
$zoom = (is_numeric($_REQUEST['zoom']) ? round($_REQUEST['zoom'], 0) : map_zoom);
$coor_lat = (!empty($_REQUEST['lat']) && is_numeric($_REQUEST['lat']) ? $_REQUEST['lat'] : map_coor_lat);
$coor_lon = (!empty($_REQUEST['lon']) && is_numeric($_REQUEST['lon']) ? $_REQUEST['lon'] : map_coor_lon);
$scroll = (isset($_REQUEST['scroll']) && $_REQUEST['scroll'] == 'off' ? false : true);
$banner = (isset($_REQUEST['banner']) && $_REQUEST['banner'] == 'off' ? false : true);



//api call



$c = curl_init();
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_URL, api_utm.'location.php'.$vars);
curl_setopt($c, CURLOPT_TIMEOUT, 5);
curl_setopt($c, CURLOPT_AUTOREFERER, true);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
$d = curl_exec($c);
$h = curl_getinfo($c, CURLINFO_HTTP_CODE);
curl_close($c);



//prepare map data



if($h == '200'){
	$map_init = array(
		'uri' => api_mapbox,
		'lat' => $coor_lat,
		'lon' => $coor_lon,
		'zoom' => $zoom,
		'scroll' => $scroll,
	);
	$map_data = array();
	$data = json_decode($d, true);
	foreach($data as $e){
		if(!empty($e['geo']['lat']) && !empty($e['geo']['lon'])){
			$map_data[] = array(
				'lat' => $e['geo']['lat'],
				'lon' => $e['geo']['lon'],
				'box' => '<a href="'.uri_utm.'node/'.$e['node'].'" target="_blank"><span class="name">'.$e['name'].'</span><span class="name-sub">'.$e['address'].'</span></a>',
			);
		}
	}



//fetch owner name



	if(!empty($var2)){
		include('load-owner.php');
		if(array_key_exists($var2, $owners)){
			$utm_owner = $owners[$var2];
		}
	}



//add js objects



	$utm .= "var utmmap_init = ".json_encode($map_init, JSON_PRETTY_PRINT).";\n";
	$utm .= "var utmmap_data = ".json_encode($map_data, JSON_PRETTY_PRINT).";\n";
}
?>