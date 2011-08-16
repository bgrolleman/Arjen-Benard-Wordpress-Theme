<?php
	// This Theme assumes Wordpress 3.0 or higher
  	add_theme_support('menus');
	register_nav_menu('primary_nav', 'Primary Navigation');
	register_nav_menu('footer_left', 'Footer Left');
	register_nav_menu('footer_center', 'Footer Center');
	register_nav_menu('footer_right', 'Footer Right');

	register_sidebar(array(
		'name' => 'right',
		'before_widget' => '<div class="block"><div class="block_inside">',
		'after_widget' => '</div></div>'
	));

	function get_menu_title ( $id ) {
		$menu_locations = get_nav_menu_locations();
		$menu = get_term_by('id',$menu_locations[$id],'nav_menu',ARRAY_A);
		return $menu['name'];
	}

	function custom_photo ( $post, $meta ) {
		if ( get_post_meta($post->ID, $meta, true)) { ?>
			<div class="image_block">
				<img src="<?php echo get_post_meta($post->ID, $meta, true);?>" alt="<?=$meta?>" />
			</div>
		<?php }
	}

	function wpo_get_images(
			$size = 'thumbnail',
			$limit = '0',
			$offset = '0',
			$big = 'large',
			$post_id = '$post->ID',
			$link = '1',
			$img_class = 'attachment-image',
			$wrapper = 'div',
			$wrapper_class = 'attachment-image-wrapper'
		) {
			global $post;
			$images = get_children( 
				array(
					'post_parent' => $post_id,
					'post_status' => 'inherit', 
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order ID'
				) 
			);
			if ($images) {
				$num_of_images = count($images);
				if ($offset > 0) : $start = $offset--; else : $start = 0; endif;
				if ($limit > 0) : $stop = $limit+$start; else : $stop = $num_of_images; endif;
				$i = 0;
				foreach ($images as $attachment_id => $image) {
					if ($start <= $i and $i < $stop) {
						$img_title = $image->post_title;   // title.
						$img_description = $image->post_content; // description.
						$img_caption = $image->post_excerpt; // caption.
						//$img_page = get_permalink($image->ID); // The link to the attachment page.
						$img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
						if ($img_alt == '') { $img_alt = $img_title; }
						if ($big == 'large') {
							$big_array = image_downsize( $image->ID, $big );
							$img_url = $big_array[0]; // large.
						} else {
							$img_url = wp_get_attachment_url($image->ID); // url of the full size image.
						}
						
						// FIXED to account for non-existant thumb sizes.
						$preview_array = image_downsize( $image->ID, $size );
						if ($preview_array[3] != 'true') {
						$preview_array = image_downsize( $image->ID, 'thumbnail' );
						$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
						$img_width = $preview_array[1];
						$img_height = $preview_array[2];
					} else {
						$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
						$img_width = $preview_array[1];
						$img_height = $preview_array[2];
					}
					// End FIXED to account for non-existant thumb sizes.

					///////////////////////////////////////////////////////////
					// This is where you'd create your custom image/link/whatever tag using the variables above.
					// This is an example of a basic image tag using this method.
					if ( $wrapper != 0 ) : ?>
						<<?=$wrapper; ?> class="<?=$wrapper_class; ?>">
					<?php endif; ?>
					<?php if ($link == '1') : ?>
						<a href="<?php echo $img_url; ?>" title="<?php echo $img_title; ?>">
					<?php endif; ?>
					<img class="<?php echo $img_class; ?>" src="<?php echo $img_preview; ?>" alt="<?php echo $img_alt; ?>" title="<?php echo $img_title; ?>" />
					<?php if ($link == '1') : ?>
						</a>
					<?php endif; ?>
					<?php if ($img_caption != '') : ?>
						<div class="attachment-caption"><?php echo $img_caption; ?></div>
					<?php endif; ?>
					<?php if ($img_description != '') : ?>
						<div class="attachment-description"><?php echo $img_description; ?></div>
					<?php endif; ?>
					<?php if ($wrapper != '0') : ?>
						</<?=$wrapper; ?>>
					<?php endif; ?>
					<?
					// End custom image tag. Do not edit below here.
					///////////////////////////////////////////////////////////
				}
				$i++;
			}
		}
	} 

?>
