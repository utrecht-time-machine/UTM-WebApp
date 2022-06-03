<?php
require_once('ini.php');
require_once('load-map.php');
?>
<!DOCTYPE html>

<html lang="nl" dir="ltr">

<head>

<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
<base href="/dev/embed/map/"/>

<title>Utrecht Time Machine</title>

<link href="css/icon/favicon.ico" rel="icon" type="image/vnd.microsoft.icon"/>
<link href="css/icon/touch-icon.png" rel="apple-touch-icon"/>
<link href="css/leaflet.cluster.min.css" rel="stylesheet" type="text/css"/>
<link href="css/leaflet.min.css" rel="stylesheet" type="text/css"/>
<link href="css/map.css" rel="stylesheet" type="text/css"/>

<script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="js/leaflet.min.js" type="text/javascript"></script>
<script src="js/leaflet.cluster.min.js" type="text/javascript"></script>

<?php if($utm): ?>
<script type="text/javascript">
<?= $utm; ?>
</script>
<script src="js/mapbox.js" type="text/javascript"></script>
<?php endif; ?>

</head>

<body>

<?php if($utm): ?>
<div class="map-container">
<?php if($banner): ?>
	<div class="map-brand">
		<div>
			<div>
				<div class="brand"></div>
			</div>
<?php if($utm_owner): ?>
			<div><?= $utm_owner; ?></div>
<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
	<div class="geo">
		<a class="geo-user">Mijn locatie</a>
	</div>
	<div class="geo-fail">
		<div data-id="1">Geolocatie niet beschikbaar</div>
		<div data-id="2">Geen toestemming gegeven voor geolocatie</div>
	</div>
	<div class="map" id="map_embed"></div>
</div>
<?php else: ?>
<div class="fatal-error">
	<div>
		De kaart van <a href="https://utrechttimemachine.nl/" target="_blank">Utrecht Time Machine</a> kan niet worden geladen.
	</div>
</div>
<?php endif; ?>

</body>

</html>