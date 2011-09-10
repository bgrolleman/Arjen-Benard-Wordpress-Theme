<?php get_header(); ?>
  <div class="allContent">
	<?php if ( get_post_meta($post->ID, 'photo1', true)) { ?>
		<div class="leftContent">
			<?php
				wpo_get_images( $size = 'medium' );
				custom_photo($post, "photo1");	
				custom_photo($post, "photo2");	
				custom_photo($post, "photo3");	
				custom_photo($post, "photo4");	
				custom_photo($post, "photo5");	
				custom_photo($post, "photo6");	
			?>
		</div>
		<div class="rightContent">
			<?php get_template_part('theloop'); ?>
		</div>
	<?php 
		} else {
			get_template_part ( 'theloop' );
		}
	?>
    <br class="clearfloat" />
<?php get_footer() ?>
