<?php



//ini



error_reporting(0);
$r = array();
require('inc/connect.php');
if($link){



//param



	$domain = 'https://www.'.$_SERVER['SERVER_NAME'];
	$lang = (isset($_REQUEST['lang']) && $_REQUEST['lang'] == 'en' ? 'en' : 'nl');
	$org = false;
	if(!empty($_REQUEST['org'])){
		$org_val = mysqli_real_escape_string($link, $_REQUEST['org']);
		if(is_numeric($org_val)){
			$org = $org_val;
		}
	}



//fetch



	$f = mysqli_query($link,
	"
	SELECT
		node.nid,
		node.title AS name,
		field_data_field_lang.field_lang_value AS lang,
		field_data_field_geo.field_geo_lat AS lat,
		field_data_field_geo.field_geo_lon AS lon,
		field_data_field_address.field_address_thoroughfare AS address,
		field_data_field_partner.field_partner_target_id AS org_id
	FROM node
		LEFT JOIN field_data_field_lang ON field_data_field_lang.entity_id = node.nid
		LEFT JOIN field_data_field_geo ON field_data_field_geo.entity_id = node.nid
		LEFT JOIN field_data_field_address ON field_data_field_address.entity_id = node.nid
		LEFT JOIN field_data_field_partner ON field_data_field_partner.entity_id = node.nid
	WHERE
		node.type = 'location'
		AND node.status = '1'
		AND field_data_field_lang.field_lang_value = '".$lang."'
		".($org ? "AND field_data_field_partner.field_partner_target_id = '".$org."'" : "")."
	ORDER BY node.title ASC
	LIMIT 0, 500
	"
	);
	if(mysqli_num_rows($f) > 0){



//list



		while($d = mysqli_fetch_array($f)){
			$r[$d['nid']] = array(
				'node' => $d['nid'],
				'name' => $d['name'],
				'path' => $domain.'/node/'.$d['nid'],
				'address' => $d['address'],
				'geo' => array(
					'lat' => $d['lat'],
					'lon' => $d['lon'],
				),
			);
		}
	}



//return



	mysqli_close($link);
	header('Content-Type: application/json');
	echo json_encode($r, JSON_PRETTY_PRINT);



//no connection



} else{
	http_response_code(403);
}
?>