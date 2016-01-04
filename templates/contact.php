<?php 
/*
Template Name: Contact
*/
 ?>

 <?php get_header(); ?>
<div class="content">
	<div id="main-content">
		 <div class="contact-info">
		 	<h4>Địa chỉ liên hệ</h4>
		 	<p>4112 Chadburn Cres, Mississauga ON</p>
		 	<p>647.381.4582</p>
		 </div>
		<div class="contact-form">
			<?php echo do_shortcode('[contact-form-7 id="46" title="Contact form 1"]'); ?>
		</div>	
	</div>
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>