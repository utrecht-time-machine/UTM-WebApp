<?php
function utm_theme(){
	$items = array();
	$items['user_login'] = array(
		'render element' => 'form',
		'path' => drupal_get_path('theme', 'utm').'/templates/forms',
		'template' => 'user-login',
		'preprocess functions' => array(
			'utm_preprocess_user_login'
		),
	);
	$items['user_pass'] = array(
		'render element' => 'form',
		'path' => drupal_get_path('theme', 'utm').'/templates/forms',
		'template' => 'user-pass',
		'preprocess functions' => array(
			'utm_preprocess_user_pass'
		),
	);
	return $items;
}