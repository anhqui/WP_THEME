<article id ="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-thumbnail"> 
		<?php thachpham_thumbnail('thumbnail'); ?>
	</div>
	<div class="entry-header"> 
		<?php thachpham_entry_header(); ?> <!-- hien thi tieu de bai viet-->
		<?php thachpham_entry_meta(); ?> <!-- hien thi meta nhu ten tac gia, danh muc...-->
   </div>
	<div class="entry-content">
		<?php thachpham_entry_content(); ?>
		<?php (is_single() ? thachpham_entry_tag() : ''); ?><!--ham if rut gon, neu la single thi dung han thachpham_entry_tag con khong thi ko hien thi gi ca-->

	</div>
</article>