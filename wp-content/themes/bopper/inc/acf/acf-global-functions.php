<?php
/**
 * Print ACF button, set in the block content.
 *
 * @param array $button
 *
 * @return string|void Empty string if the button data is not provided, print button otherwise.
 *
 * @author Aivaras Stankevicius <aivaras@bopdesign.com>
 */
function bopper_display_block_buttons( $buttons ) {
	// Bail if the button is not set.
	if ( empty( $buttons ) ) {
		return '';
	}

	// Print our buttons block <OPENING> tag.
	printf( '<div class="wp-block-buttons d-flex is-layout-flex justify-content-center">' );

	// Loop through our buttons array.
	$i = 0;
	foreach ( $buttons as $button ) {
		$button_class      = 'wp-block-button__link wp-element-button';
		$button_target     = '';
		$button_style      = $button['button_style'];
		$button_color      = $button['button_color']['color_picker'];
		$button_text_color = $button['button_text_color']['color_picker'];

		if ( ! empty( $button_color ) || ! empty( $button_text_color ) ) {
			if ( ! empty( $button_color ) ) {
				$button_class .= ' has-' . esc_attr( $button_color ) . '-background-color has-background';
			}

			if ( ! empty( $button_text_color ) ) {
				$button_class .= ' has-' . esc_attr( $button_text_color ) . '-color has-text-color';
			}
		}

		if ( $i > 0 ) {
			$button_class .= ' ms-2 ms-lg-3';
		}

		if ( ! empty( $button['button_link']['target'] ) ) {
			$button_target = ' target="' . esc_attr( $button['button_link']['target'] ) . '"';
		}

		// Print our button with options.
		printf(
			'<div class="wp-block-button is-style-%s"><a href="%s" class="%s"%s>%s</a></div>',
			esc_attr( $button_style ),
			esc_url( $button['button_link']['url'] ),
			esc_attr( $button_class ),
			$button_target,
			esc_html__( $button['button_link']['title'], THEME_TEXT_DOMAIN )
		);

		$i++;
	}

	// Print our buttons block </CLOSING> tag.
	printf( '</div>' );
}