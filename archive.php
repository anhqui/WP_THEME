<?php get_header(); ?>
<div class="content">
	<div id="main-content">
	<div class="archive-title">
		<?php 
			if (is_tag()):
				printf(__('Post tagged: %1$s','thachpham'),single_tag_title('',false) ); //single_tag_title() voi tham so thu nhat la tien to cho tag (de trong), tham so thu 2 true thi cho no hien ra con false chi tra ve thoi do ta dang su dung ham printf
				elseif(is_category()):
					printf(__('Post categoried: %1$s','thachpham'),single_tag_title('',false) );
				elseif(is_day()):
					printf(__('Daily archives: %1$s','thachpham'),get_the_time('l, F j, Y') );
				elseif (is_month()) :
					printf(__('Monthly archives: %1$s','thachpham'),get_the_time('F Y') ); // chi hien thi thang va nam
				elseif (is_year()) :
					printf(__('Yearly archives: %1$s','thachpham'),get_the_time('Y') );
			endif;
		 ?>
	</div>
	<?php if(is_tag()||is_category()): ?>
			<div class="archive-description">
				<?php echo term_description(); ?> <!-- tra ve phan tu cua mot taxonomy nao do co the ung dung trong taxonomy hoac custom taxonomy nao do; no se lay theo ID hoac ten cua taxonomy; khong co thong so no se lay mac dinh la theme dang gui query-->

			</div>
	<?php endif; ?>
		<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php get_template_part('content',get_post_format()); ?> <!-- ham nay nhuding mot tap tin content ten $format.php con neu post hien tai khong co format no se lay file content.php -->
		<?php endwhile; ?>
		<?php thachpham_pagination(); ?>
		<?php else: ?>
			<?php get_template_part('content','none'); ?> <!--no se nhung mot tap tin ten content-none.php -->
		<?php endif; ?>
	</div>
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
