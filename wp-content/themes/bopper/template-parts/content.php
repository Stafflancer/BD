<?php
/**
 * Template part for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bopper
 */

$author_id = get_post_field( 'post_author', get_the_ID());
?>

<div id="post-<?php the_ID(); ?>">
	<div class="first-entry">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<div class="post-details">
					<span class="post-created-date"><?php echo get_the_date(); ?></span>| 
					<span class="post-by">BY <?php echo get_the_author_meta('display_name', $author_id); ?></span>
				</div>
				<div class="reading"><?php echo do_shortcode('[rt_reading_time label="Reading Time:" postfix="minutes" postfix_singular="minute"]'); ?></div>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .entry-header -->

	<?php bopper_post_thumbnail(); ?>

</div><!-- #post-<?php the_ID(); ?> -->