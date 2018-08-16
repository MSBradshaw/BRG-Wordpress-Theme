<?php
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123427641-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-123427641-1');
    </script>
    <script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0013/2955.js" async="async"></script>
	<meta charset="UTF-8">
	<title><?php wp_title() ?></title>
	<link rel="shortcut icon" href="https://www.byu.edu/themes/home_d8/favicon.ico" type="image/png" />
	<link type="text/css" rel="stylesheet" href="//cloud.typography.com/75214/6517752/css/fonts.css" media="all" />
	<link rel="stylesheet" href="https://cdn.byu.edu/byu-theme-components/latest/byu-theme-components.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cloud.typography.com/75214/6517752/css/fonts.css" />
	<script async src="https://cdn.byu.edu/byu-theme-components/latest/byu-theme-components.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	wp_head();
	?>
</head>
<body>
<byu-header>
	<span slot="site-title"><?php echo esc_html( get_field( 'title','options' ) )?></span>
	<byu-menu slot="nav" collapsed>
		<?php while ( have_rows( 'navigation','options' ) ) {
			the_row();
			?>
			<a href="<?php echo esc_url( get_sub_field( 'url','options' ) )?>"><?php echo esc_html( get_sub_field( 'name','options' ) )?></a>
		<?php } ?>
	</byu-menu>
</byu-header>
<div class="content">
