<?php



//build main menu



$uri = trim(drupal_get_path_alias());
$uri_lang = trim(substr($uri, 0, 3), '/');
switch($uri_lang){
	case 'en': $uri_lang = 'en'; break;
	case 'nl': default: $uri_lang = 'nl'; break;
}
$lang_str = array(
	'btn_nav' => array('nl' => 'Menu', 'en' => 'Menu'),
	'btn_map' => array('nl' => 'Kaart', 'en' => 'Map'),
);
$menu = array();
$tree = menu_tree_page_data($uri_lang == 'en' ? 'menu-main-en' : 'main-menu');
foreach($tree as $e){
	$a = false;
	$e = $e['link'];
	if($e['external'] == '1'){
		$u = $e['link_path'];
	} else{
		$u = trim(drupal_get_path_alias($e['link_path']), '/');
		if(substr($uri, 0, strlen($u)) == $u){
			$a = true;
		}
		$u = base_path().$u;
	}
	$menu[] = array(
		'uri' => $u,
		'title' => $e['link_title'],
		'classes' => ($a ? 'on' : ''),
	);
}



//build logo bar + tabs



$logo_view = views_embed_view('misc', 'logo_bar');
$page_tabs = render($tabs);



//load overworld map



$overworld = utm_map(
	'overworld',
	$uri_lang,
	false,
	false,
	52.090833,
	5.122222,
	14,
	true
);
?>
<div class="omni-menu">
	<a id="btn-map"><div><?= $lang_str['btn_map'][$uri_lang]; ?></div></a>
	<a id="btn-nav"><div><?= $lang_str['btn_nav'][$uri_lang]; ?></div></a>
</div>
<div class="omni-icon">
	<a href="<?= base_path().$uri_lang; ?>/home"></a>
</div>
<div class="omni">
	<header>
		<div class="header-bar">
			<div class="inner">
				<div class="name">
					<a href="<?= base_path(); ?>">Utrecht<br/>Time Machine</a>
				</div>
				<div class="menu">
					<div>
						<ul id="menu-main">
<?php foreach($menu as $e): ?>
							<li class="<?= $e['classes']; ?>">
								<a href="<?= $e['uri']; ?>"><span><?= $e['title']; ?></span></a>
							</li>
<?php endforeach; ?>
						</ul>
					</div>
					<div>
						<ul id="menu-lang">
							<li class="<?= ($uri_lang == 'nl' ? 'on' : ''); ?>">
								<a class="nl" href="<?= base_path(); ?>nl/home">
									<span>Nederlands</span>
									<span>NL</span>
								</a>
							</li>
							<li class="<?= ($uri_lang == 'en' ? 'on' : ''); ?>">
								<a class="en" href="<?= base_path(); ?>en/home">
									<span>English</span>
									<span>EN</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="outer"></div>
		</div>
		<?= render($page['header']); ?>
	</header>
<?php if(!empty($page_tabs)): ?>
	<div class="node-tabs">
		<div class="band">
			<div class="node-tabs-inner">
				<div><?= $page_tabs; ?></div>
<?php if(isset($node) && !empty($node->nid) && user_is_logged_in()): ?>
				<div class="node-revision"><?= views_embed_view('misc', 'revision', $node->nid); ?></div>
<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
	<div class="page">
		<main>
			<?= $messages; ?>
			<?= render($page['content']); ?>
		</main>
		<?= render($page['footer']); ?>
		<?= render($page['bottom']); ?>
	</div>
	<div class="bottom-bar">
		<div class="band">
			<div class="bottom-bar-inner">
				<div>
					<div class="bottom-brand">
						<div>Utrecht<br/>Time Machine</div>
					</div>
				</div>
<?php if(user_is_logged_in() !== true): ?>
				<div>
					<a href="<?= base_path(); ?>user" class="user-login-button">Inloggen</a>
				</div>
<?php endif; ?>
			</div>
			<div class="logo-bar">
				<?= $logo_view; ?>
			</div>
			<span class="credit">&copy; <?= date('Y'); ?> Utrecht Time Machine</span>
		</div>
	</div>
</div>
<div class="overlay overlay-map">
	<div>
		<?= $overworld; ?>
	</div>
</div>
<div class="overlay overlay-nav">
	<div>
		<div class="overlay-nav-inner">
			<div>
				<div>
					<div class="brand-icon"></div>
					<div class="brand-name">Utrecht<br/>Time Machine</div>
					<ul>
<?php foreach($menu as $e): ?>
						<li class="<?= $e['classes']; ?>">
							<a href="<?= $e['uri']; ?>"><?= $e['title']; ?></a>
						</li>
<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="overlay overlay-pop">
	<div>
		<a class="pop-end"></a>
		<div class="overlay-pop-inner" id="pop"></div>
	</div>
</div>