		<div class="Content">
			<?php if(have_posts()) : while ( have_posts()) : the_post(); ?>
			<p>
				<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h1>
				<?php the_content('Read More'); ?>
			</p>
			<?php endwhile; ?>
			<h2>&nbsp;</h2>
			<?php endif; ?>
		</div>
