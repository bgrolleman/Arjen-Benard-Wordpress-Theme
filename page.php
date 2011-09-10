<?php get_header(); ?>
  <div class="allContent">
	<?php if ( wpo_have_images() ) { ?>
		<div class="leftContent">
			<?php
				wpo_get_images( $size = 'large' );
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
