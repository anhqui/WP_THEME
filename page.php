<?php get_header(); ?>
<div class="content">
	<div id="main-content">
		<?php if (have_posts()): while (have_posts()): the_post(); ?>
	
				<?php get_template_part('content',get_post_format()); ?>
				<!-- ham nay nhung mot tap tin content ten $format.php con neu post hien tai khong co format no se lay file content.php -->
			
		<?php endwhile; ?>
		<?php else: ?>
			<?php get_template_part('content','none'); ?> <!--no se nhung mot tap tin ten content-none.php -->
		<?php endif; ?>
	</div>
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>