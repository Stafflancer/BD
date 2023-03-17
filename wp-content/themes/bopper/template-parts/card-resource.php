<?php
/**
 * Template part for displaying reusable card in blocks and archives.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bopper
 */
$resource_type = get_the_terms( get_the_ID(), 'resource_type' );
if(!empty($resource_type)){
	$category_name = array();
	foreach( $resource_type as $category ) {
		$category_name[] = $category->name;
	}
} 
?>
<div class="col-sm-6 col-lg-4 mb-4">
	<div class="card">
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="blog_img">
					<?php bopper_post_thumbnail(); ?>
				</div>
			<?php } ?>
			<div class="blog-block-bottom">
				<div class="blog_content"><?php
					if(!empty($resource_type)){ ?>
						<label><?php echo implode(" | ",$category_name); ?></label><?php
					} ?>
					<h2 class="blog_heading"><?php echo get_the_title(); ?></h2>
				</div>
				<div class="bottom-date-btn text-right">
					<span class="common-btn sbtn-view">
						<svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
							<rect id="Area_ICON:feather_twitter_SIZE:MEDIUM_STATE:DEFAULT_STYLE:STYLE2_" data-name="Area [ICON:feather/twitter][SIZE:MEDIUM][STATE:DEFAULT][STYLE:STYLE2]" width="20" height="20" fill="rgba(253,73,198,0.35)" opacity="0"></rect><g id="Icon" transform="translate(4.167 4.168)"><line id="Line" x2="11.667" transform="translate(0 5.833)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></line><path id="Path" d="M4.167,15.833,10,10,4.167,4.167" transform="translate(1.666 -4.167)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></path></g>
                        </svg>
					</span>
				</div>
			</div>
		</a>
	</div>
</div>