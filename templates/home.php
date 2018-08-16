<?php
/*
Template Name: Home
*/
?>
<?php
wp_enqueue_style( 'home-css', get_stylesheet_directory_uri() . '/css/home.css' );
get_header( 'create' );
?>
	<div class="banner">
		<img src="<?php echo get_field( 'header_image' ); ?>">
	</div>
	<div class="container">
		<a href="" class="mid-page-button button-left">Projects</a>
		<a href="" class="mid-page-button button-right">Memebers</a>

<?php
if ( have_rows( 'boxed_links' ) ) {
    $i = 0;
	while ( have_rows( 'boxed_links' ) ) {
		the_row();
		?>
        <div class="block">
            <img src="<?php echo esc_url( get_sub_field( 'box_background_image' ) ); ?>" >
            <div class="block__content">
            <h3 class="block__title block__title-top"><?php echo esc_html( get_sub_field( 'box_title' ) );?></h3>
            <h3 class="block__title block__title-bottom"><?php echo esc_html( get_sub_field( 'box_title_part_2' ) );?></h3>
            <?php
            if ( have_rows( 'box_links' ) ) {
                while ( have_rows( 'box_links' ) ) {
                the_row();
                    $link         = array();
                    $link['url']  = get_sub_field( 'box_link_url' );
                    $link['text'] = get_sub_field( 'box_link_text' );
                    array_push( $block['links'], $link );
                    ?>
                    <a href="<?php echo esc_url( get_sub_field( 'box_link_url' ) ); ?>" class="block__item"><p><?php echo esc_html( get_sub_field( 'box_link_text' ) );?></p></a>
                    <?php
                }
            }
            ?>
            </div>
        </div>
        <?php

		$block['image']        = get_sub_field( 'box_background_image' );
		$block['mobile_image'] = get_sub_field( 'box_background_image_mobile' );
		$block['img_alt_text'] = get_sub_field( 'image_alt_text' );

	}
}
?></div><?php
get_footer( 'create' );

