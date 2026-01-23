<?php

/**
 * Adds admin functionality for the Text slide format.

 */
class Foyer_Admin_Slide_Format_Fbg1 {

	/**
	 * Saves additional data for the Text slide format.
	 *
	 * @since	1.5.0
	 *
	 * @param	int		$post_id	The ID of the post being saved.
	 * @return	void
	 */
	static function save_slide( $post_id ) {
		$slide_text_pretitle = sanitize_text_field( $_POST['slide_text_pretitle'] );
		$slide_text_title = sanitize_text_field( $_POST['slide_text_title'] );
		$slide_text_subtitle = sanitize_text_field( $_POST['slide_text_subtitle'] );
		$slide_text_content = wp_kses_post( $_POST['slide_text_content'] );
		$slide_text_extraspace = esc_url( $_POST['slide_text_extraspace'] );

		// URL för veckodagar

		$slide_text_url1 = sanitize_text_field( $_POST['slide_text_url1'] );
		$slide_text_url2 = sanitize_text_field( $_POST['slide_text_url2'] );
		$slide_text_url3 = sanitize_text_field( $_POST['slide_text_url3'] );
		$slide_text_url4 = sanitize_text_field( $_POST['slide_text_url4'] );
		$slide_text_url5 = sanitize_text_field( $_POST['slide_text_url5'] );

		update_post_meta( $post_id, 'slide_text_pretitle', $slide_text_pretitle );
		update_post_meta( $post_id, 'slide_text_title', $slide_text_title );
		update_post_meta( $post_id, 'slide_text_subtitle', $slide_text_subtitle );
		update_post_meta( $post_id, 'slide_text_content', $slide_text_content );
		update_post_meta( $post_id, 'slide_text_extraspace', $slide_text_extraspace );

		update_post_meta( $post_id, 'slide_text_url1', $slide_text_url1 );
		update_post_meta( $post_id, 'slide_text_url2', $slide_text_url2 );
		update_post_meta( $post_id, 'slide_text_url3', $slide_text_url3 );
		update_post_meta( $post_id, 'slide_text_url4', $slide_text_url4 );
		update_post_meta( $post_id, 'slide_text_url5', $slide_text_url5 );
	}

	/**
	 * Outputs the meta box for the Text slide format.
	 *
	 * @since	1.5.0
	 *
	 * @param	WP_Post	$post	The post of the current slide.
	 * @return	void
	 */
	static function slide_meta_box( $post ) {
		$slide_text_pretitle = get_post_meta( $post->ID, 'slide_text_pretitle', true );
		$slide_text_title = get_post_meta( $post->ID, 'slide_text_title', true );
		$slide_text_subtitle = get_post_meta( $post->ID, 'slide_text_subtitle', true );
		$slide_text_content = get_post_meta( $post->ID, 'slide_text_content', true );
		$slide_text_extraspace = get_post_meta( $post->ID, 'slide_text_extraspace', true );

		$slide_text_url1 = get_post_meta( $post->ID, 'slide_text_url1', true );
		$slide_text_url2 = get_post_meta( $post->ID, 'slide_text_url2', true );
		$slide_text_url3 = get_post_meta( $post->ID, 'slide_text_url3', true );
		$slide_text_url4 = get_post_meta( $post->ID, 'slide_text_url4', true );
		$slide_text_url5 = get_post_meta( $post->ID, 'slide_text_url5', true );

		?><table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="slide_text_pretitle"><?php _e( 'Rum / skärm', 'foyer' ); ?></label>
					</th>
					<td>
						<input type="text" name="slide_text_pretitle" id="slide_text_pretitle" class="large-text" value="<?php echo esc_html( $slide_text_pretitle ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="slide_text_title"><?php _e( 'Title', 'foyer' ); ?></label>
					</th>
					<td>
						<input type="text" name="slide_text_title" id="slide_text_title" class="large-text" value="<?php echo esc_html( $slide_text_title ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="slide_text_subtitle"><?php _e( 'Default Google Slide URL', 'foyer' ); ?></label>
					</th>
					<td>
						<input type="text" name="slide_text_subtitle" id="slide_text_subtitle" class="large-text" value="<?php echo esc_html( $slide_text_subtitle ); ?>" />
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="slide_text_url1"><?php _e( 'Måndag Google Slide URL', 'foyer' ); ?></label>
					</th>
					<td>
						<input type="text" name="slide_text_url1" id="slide_text_url1" class="large-text" value="<?php echo esc_html( $slide_text_url1 ); ?>" />
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="slide_text_url2"><?php _e( 'Tisdag Google Slide URL', 'foyer' ); ?></label>
					</th>
					<td>
					<input type="text" name="slide_text_url2" id="slide_text_url2" class="large-text" value="<?php echo esc_html( $slide_text_url2 ); ?>" />
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="slide_text_url3"><?php _e( 'Onsdag Google Slide URL', 'foyer' ); ?></label>
					</th>
					<td>
					<input type="text" name="slide_text_url3" id="slide_text_url3" class="large-text" value="<?php echo esc_html( $slide_text_url3 ); ?>" />
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="slide_text_url4"><?php _e( 'Torsdag Google Slide URL', 'foyer' ); ?></label>
					</th>
					<td>
					<input type="text" name="slide_text_url4" id="slide_text_url4" class="large-text" value="<?php echo esc_html( $slide_text_url4 ); ?>" />
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="slide_text_url5"><?php _e( 'Fredag Google Slide URL', 'foyer' ); ?></label>
					</th>
					<td>
					<input type="text" name="slide_text_url5" id="slide_text_url5" class="large-text" value="<?php echo esc_html( $slide_text_url5 ); ?>" />
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="slide_text_content"><?php _e( 'Kommentarer', 'foyer' ); ?></label>
					</th>
					<td>
						<textarea name="slide_text_content" id="slide_text_content" class="large-text" rows="8"><?php echo esc_html( $slide_text_content ); ?></textarea>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="slide_text_extraspace"><?php _e( 'Extra Yta Google Slide URL', 'foyer' ); ?></label>
					</th>
					<td>
						<input type="text" name="slide_text_extraspace" id="slide_text_extraspace" class="large-text" value="<?php echo esc_html( $slide_text_extraspace ); ?>" />
					</td>
				</tr>
			</tbody>
		</table><?php
	}
}
