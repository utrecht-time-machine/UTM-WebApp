<?php



//connect



require('../../sites/default/settings.php');
if(isset($databases)){
	$db = $databases['default']['default'];
	$link = mysqli_connect($db['host'], $db['username'], $db['password'], $db['database']);
	if($link){
		mysqli_set_charset($link, 'utf8');
	}
}
?>