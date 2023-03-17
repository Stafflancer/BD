<?php
/**
 * FAQs
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$block_header = get_field('block_header');
if(have_rows('faqs')){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'faqs-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'faqs';

    if ( ! empty( $block['className'] ) ) {
        $section_class_name .= ' ' . $block['className'];
    }


    // Start a <container> with possible block options.
    $container_args = [
        'container' => 'section', // Any HTML5 container: section, div, etc...
        'id'        => $id, // Container id.
        'class'     => $section_class_name, // Container class.
    ];

    bopper_display_block_background_options( $block, $container_args ); ?>
    <div class="faqs-main"><?php
        if(!empty($block_header )){
            bopper_display_block_header($block_header);
        } ?>
        <div class="faqs-inner">
            <div id="faqsaccordion"><?php
                $toggleindex = 1;
                while(have_rows('faqs')){  
                    the_row();
                    $question = get_sub_field('question'); 
                    $answer = get_sub_field('answer');
                    if(!empty($question) || !empty($answer)){ ?>
                        <div class="collapsDiv faqs-pannel-tab faq-toggle"><?php
                            if(!empty($question)){ ?>
                                <button class="accordion faqs-panel-heading open">
                                    <div class="faqs-content">
                                        <h4><?php echo $question; ?></h4>
                                    </div>
                                </button><?php
                            } 
                            if(!empty($answer)){ ?>
                                <div class="panel faqs-panel-content" <?php if($toggleindex == 1){ echo 'style="display: block;"'; } else { echo 'style="display: none;"'; } ?>>
                                    <div class="pannel-in">
                                        <?php echo $answer; ?>
                                    </div>
                                </div><?php
                            } ?>
                        </div><?php
                    }
                    $toggleindex++;
                } ?>
            </div>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}