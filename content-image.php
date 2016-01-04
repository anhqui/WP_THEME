<article id ="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-thumbnail"> 
		<?php thachpham_thumbnail('large'); ?>
	</div>
	<div class="entry-header"> 
		<?php thachpham_entry_header(); ?> <!-- hien thi tieu de bai viet-->
		 <?php  $attachment = get_children(array('post_parent'=> $post->ID )); /* ham get_children dem co bao nhieu thanh phan con trong post/page do, tham so post_parent se dem cac thanh phan con trong mot cai post */
		 $attachment_number=count($attachment);
		 		printf(__('This image post contains %1$s photos','thachpham'),$attachment_number); // $attachment_number la tham so cho %1$s
	      
		 ?>


   </div>
	<div class="entry-content">
		<?php thachpham_entry_content(); ?>
		<?php (is_single() ? thachpham_entry_tag() : ''); ?><!--ham if rut gon, neu la single thi dung han thachpham_entry_tag con khong thi ko hien thi gi ca-->

	</div>
</article>