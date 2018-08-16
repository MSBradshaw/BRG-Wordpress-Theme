<?php 	?>
</div>
<byu-footer>
	<?php
	while ( have_rows( 'columns','options' ) ) {
		the_row();
		?>
		<byu-footer-column>
			<span slot="header"><?php echo esc_html( get_sub_field( 'column_title','options' ) )?></span>
			<?php
			while ( have_rows( 'column_content','options' ) ) {
				the_row();
				if ( 'text' === get_row_layout() ) {
					?><p><?php echo esc_html( get_sub_field( 'text_item' ) )?></p><?php
				} elseif ( 'link' === get_row_layout() ) {
					?><a href="<?php echo esc_url( get_sub_field( 'url' ) )?>" ><?php echo esc_html( get_sub_field( 'text' ) ) ?></a></a><?php
				} elseif ( 'address' === get_row_layout() ) {
					?>
					<p><?php echo esc_html( get_sub_field( 'line_1' ) ) . '</br>' . esc_html( get_sub_field( 'line_2' ) ) . '</br>' . esc_html( get_sub_field( 'line_3' ) ) ?></p>
					<?php
				}
			}
			?>
		</byu-footer-column>
		<?php
	}
	?>
</byu-footer>
</body>
</html>
