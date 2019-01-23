
			<?php get_header();?>
			<main class="wp-content">
			<?php
			while ( have_posts() ) :
				the_post();

				the_content();

				endwhile; // End of the loop.
			?></main>	<?php
				get_footer();

				?>
					