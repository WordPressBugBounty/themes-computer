<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since Computer 1.0
	 *
	 * @return void
	 */
	function computer_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'computer-columns-overlap',
				'label' => esc_html__( 'Overlap', 'computer' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'computer-border',
				'label' => esc_html__( 'Borders', 'computer' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'computer-border',
				'label' => esc_html__( 'Borders', 'computer' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'computer-border',
				'label' => esc_html__( 'Borders', 'computer' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'computer-image-frame',
				'label' => esc_html__( 'Frame', 'computer' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'computer-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'computer' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'computer-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'computer' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'computer-border',
				'label' => esc_html__( 'Borders', 'computer' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'computer-separator-thick',
				'label' => esc_html__( 'Thick', 'computer' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'computer-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'computer' ),
			)
		);
	}
	add_action( 'init', 'computer_register_block_styles' );
}
