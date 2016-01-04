<!DOCTYPE html>
<html <?php language_attributes(); ?> />
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<link rel="profile" href="http://gmgp.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<?php wp_head(); ?> <!--them cai hook wp_head() de them cac doan code can thiet vao file header.php nay, tuong tu wp_footer() cho footer.php-->
</head>
<body <?php body_class(); ?> >
	<div id="container">
		<div class="logo">
		<?php thachpham_header(); ?>
		<?php thachpham_menu('primary-menu'); ?>
		</div>



