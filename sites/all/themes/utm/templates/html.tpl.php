<!DOCTYPE html>

<html <?= $html_attributes.$rdf_namespaces; ?>>

<head>

<?= $head; ?>

<title><?= $head_title; ?></title>

<link href="<?= base_path().path_to_theme(); ?>/ui/icon/app-icon/icon-180.png" rel="apple-touch-icon" sizes="180x180"/>
<link href="<?= base_path().path_to_theme(); ?>/ui/icon/app-icon/icon-192.png" rel="icon" sizes="192x192"/>
<meta name="MobileOptimized" content="width">
<meta name="HandheldFriendly" content="true">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">

<?= $styles; ?>
<?= $scripts; ?>
<script>var base_path = '<?= base_path(); ?>';</script>
<?php if($add_html5_shim): ?>
<!--[if lt IE 9]><script src="<?= $base_path.$path_to_zen; ?>/js/html5shiv.min.js"></script><![endif]-->
<?php endif; ?>

</head>

<body class="<?= $classes; ?>" <?= $attributes;?>>

<?= $page_top; ?>
<?= $page; ?>
<?= $page_bottom; ?>

</body>

</html>