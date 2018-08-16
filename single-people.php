<?php
wp_enqueue_style( 'single-people-css', get_stylesheet_directory_uri() . '/css/single-people.css' );
get_header( 'create' );
the_post();
?>
	<div class="banner">
		<img src="<?php echo get_field( 'header_image' ); ?>">
		<h2 class="name"><?php echo esc_html( the_field( 'full_name' ) ); ?></h2>
	</div>
	<div class="container">
		<img src="<?php echo esc_url( get_field( 'portrait' ) ); ?>">
	<div class="content">
        <a href="mailto:<?php echo esc_html( get_field( 'email' ) ); ?>"><p class="content__email"><?php echo esc_html( get_field( 'email' ) ); ?></p></a>
		<a href="tel:<?php echo esc_html( get_field( 'phone' ) ); ?>"><p class="content__phone"><?php echo esc_html( get_field( 'phone' ) ); ?></p></a>
		<?php
		$projects = get_field( 'projects' );
		if ( count( $projects ) > 0 ) {
			?>
			<h3 class="content__projects">Projects:</h3> 
			<?php
			foreach ( $projects as $project ) {
				?>
				<a class="content__projects__item" href="<?php echo get_permalink( $project ); ?>"><p><?php echo get_the_title( $project ); ?></p></a> 
	<?php
			}
		}
		?>
	</div>
	<div class="description"><?php the_content(); ?></div>
	</div>
	<?php
	get_footer( 'create' );
