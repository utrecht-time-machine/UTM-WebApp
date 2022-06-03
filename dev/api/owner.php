<?php



//ini



error_reporting(0);
$r = array();
require('inc/connect.php');
if($link){



//fetch



	$f = mysqli_query($link,
	"
	SELECT
		node.nid,
		node.title AS name
	FROM node
	WHERE
		node.type = 'logo'
		AND node.status = '1'
	ORDER BY node.title ASC
	LIMIT 0, 500
	"
	);
	if(mysqli_num_rows($f) > 0){



//list



		while($d = mysqli_fetch_array($f)){
			$r[] = array(
				'node' => $d['nid'],
				'name' => $d['name'],
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