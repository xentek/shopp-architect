<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="template" content="Shopp Architect" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/blueprint/screen.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/blueprint/print.css" type="text/css" media="print" />	
	<!--[if lt IE 8]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->

	<?php if ( get_stylesheet() != get_template() ): ?>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/style.css" />
	<?php else: ?>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<?php endif; ?>

	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />

	<?php if ( is_singular() ): ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php endif; ?>

	<?php wp_head(); ?>

	<?php wp_get_archives('type=monthly&format=link'); ?>
	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/hoverIntent.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/superfish.js"></script>
	<script type="text/javascript">
		jQuery(function($) {
			$('#mainnav').superfish();
		});
	</script>
	
</head>
<body class="<?php sa_body_classes(); ?>">

<div id="skip">
	<a href="#main" accesskey="2">Skip To Content</a>
</div>

<div id="wrap">
	<?php $block = ( is_front_page() ? 'h1' : 'div' ); // for SEO ?>
	<div id="header">
		<?php echo "<$block id=\"logo\">"; ?><a href="<?php bloginfo('siteurl'); ?>" accesskey="1" title="<?php bloginfo('name'); ?>: <?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a><?php echo "</$block>"; ?>
		<ul id="topnav">
			<li><a href="<?php bloginfo('siteurl'); ?>">Home</a></li>
	
			<?php if (SA_SHOPP_ACTIVE): ?>
				<li><a href="<?php shopp('customer','url'); ?>">My Account</a></li>
				<li><a href="<?php shopp('cart','url'); ?>">My Cart</a></li>
			<?php endif; ?>
			<?php do_action('sa_topnav_links'); ?>
		</ul><!-- end top-nav -->
		<p id="blogdesc"><?php bloginfo('description'); ?></p>
		<div >
			<ul id="mainnav">
				<li><a href="<?php bloginfo('siteurl'); ?>">Home</a></li>
				
				<?php do_action('sa_mainnav_links'); 
					/* in a child theme you can pass in an multi-dimensional array with a named param of exclude
						which represents a list of shopp categories not to display */
				?>
			</ul>
		</div> <!-- end main-nav -->
	</div><!-- end header -->

	<hr />
