<?php
require_once('map/ini.php');
require_once('map/load-owner.php');
?>
<!DOCTYPE html>

<html lang="nl" dir="ltr">

<head>

<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>

<title>Embed &ndash; Utrecht Time Machine</title>

<link href="map/css/icon/favicon.ico" rel="icon" type="image/vnd.microsoft.icon"/>
<link href="map/css/icon/touch-icon.png" rel="apple-touch-icon"/>
<link href="map/css/map.css" rel="stylesheet" type="text/css"/>

<script src="map/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script>var base_path = '<?= uri_utm; ?>';</script>
<script src="form.js" type="text/javascript"></script>

</head>

<body class="form-view">

<div class="form-omni">
	<div class="form">
		<div class="brand"></div>
		<h1>Kaart embedden</h1>
		<h2>Instellingen</h2>
		<div class="field-name">Taal</div>
		<div class="field">
			<select name="var1">
				<option value="nl" selected>Nederlandstalige locaties</option>
				<option value="en">Engelstalige locaties</option>
			</select>
		</div>
		<div class="field-name">Locaties tonen van</div>
		<div class="field">
			<select name="var2">
				<option value="none">Iedereen (standaard)</option>
<?php foreach($owners as $i => $e): ?>
				<option value="<?= $i; ?>"><?= $e; ?></option>
<?php endforeach; ?>
			</select>
		</div>
		<div class="field-name">Zoomniveau</div>
		<div class="field">
			<select name="zoom">
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14" selected>14 (standaard)</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
			</select>
		</div>
		<div class="field-name">Co&ouml;rdinaten middelpunt overschrijven</div>
		<div class="field">
			<div>
				<input type="text" name="coor_lat" placeholder="Latitude"/>
			</div>
			<div>
				<input type="text" name="coor_lon" placeholder="Longitude"/>
			</div>
		</div>
		<div class="field-name">Titelblok</div>
		<div class="field">
			<select name="banner">
				<option value="on">Aan (standaard)</option>
				<option value="off">Uit</option>
			</select>
		</div>
		<div class="field-name">Zoomen met scrollwheel</div>
		<div class="field">
			<select name="scroll">
				<option value="on">Aan (standaard)</option>
				<option value="off">Uit</option>
			</select>
		</div>
		<h2>Embed code</h2>
		<div class="field">
			<textarea id="embed" rows="4"></textarea>
		</div>
		<h2>Preview</h2>
		<div id="preview"></div>
	</div>
</div>

</body>

</html>