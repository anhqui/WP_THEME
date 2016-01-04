<?php
/**
@ Khai bao hang gia tri
	@ THEME_URL = lay duong dan thu muc theme
	@ CORE = lay duong dan cua thu muc /core
**/
define ('THEME_URL', get_stylesheet_directory());  //Dinh nghia THEME_URL= duong dan den /thachpham
define ('CORE', THEME_URL. '/core'); // Dinh nghia CORE= duong dan den /thachpham/core

/**
@ Nhung file /core/init.php
**/
require_once( CORE.'/init.php');

/**
@ Thiet lap chieu rong noi dung
**/
if (!isset($content_width)) {  // Neu bien $content_width chua duoc gan gia tri
$content_width = 620;  // chieu rong toi da la 620px (chi chap nhan px)

}

/**
@ Khai bao nhung chuc nang cua theme
**/
if (!function_exists('thachpham_theme_setup')) { // Neu ham thachpham_theme_setup chua ton tai thi tao ra no

function thachpham_theme_setup(){

	/* Thiet lap textdomain*/
	   $language_folder=THEME_URL.'/languages';// Thiet lap textdomain
		load_theme_textdomain('thachpham','$language_folder'); // ham nay lay 2 tham so la textdomain va duong dan language
  	
  	/* Tu dong them link RSS len <head> **/
  		add_theme_support('automatic-feed-links');

  	/* Them post thumbnail */
  		add_theme_support('post-thumbnails');	// khi new post se xuat hien muc Set Featured Image

  	/*	Post Format */
  	add_theme_support('post-formats', array( // khi new post se xuat hien cac radio Format ben duoi, tuc la format cho tung loai kieu post hinh anh hay video
      'image',
      'video',
      'gallery',
      'quote',
      'link'
  		));

  	/* Theme title-tag */
  	add_theme_support('title-tag'); // tu dong them the <title> ABC (page), Website ban hang (ten website) </title> cho theme, no se hien thi ten trang minh vao va ten trang website; hoat dong tot voi plugin SEO by YOAST

  	/* Them custom background */
  	$default_background = array(
  			'default-color' => '#e8e8e8'
  		);
  	add_theme_support('custom-background',$default_background); // cho phep nguoi dung thay doi background, se xuat hien muc background trong Appearance

  	/* Them menu */
  	register_nav_menu('primary-menu',__('Primary Menu','thachpham')); // thay vi dat ten la 'Primary Menu' ta thay bang __('Primary Menu','thachpham') de sau nay co the sua duoc trong file memo voi thachpham la textdomain; se xuat hien Primary Menu trong phan Appearance>Menu

  	/* Tao sidebar */
  	$sidebar = array (
  			'name' => __('Main Sidebar','thachpham'),
  			'id'=> 'main-sidebar',
  			'description'=> __('Default sidebar'),
  			'class' => 'main-sidebar',
  			'before_title' => '<h3 class="widgettitle">',
  			'after_title' => '</h3>'
  		);
  	register_sidebar($sidebar);

}

add_action('init','thachpham_theme_setup');
}

/*===================
TEMPLATE FUNCTIONS */

if (!function_exists('thachpham_header')) {
function thachpham_header(){ ?> <!--dong the php lai vi lenh ke tiep la the html-->

			<div class="site-name">
				<?php 
				global $tp_options;
				if ($tp_options['logo-on']==0) :
			 	?>
				<?php 
					if (is_home()) {
						printf('<h1> <a href="%1$s" title="%2$s"> %3$s </a></h1>',
						get_bloginfo('url'), //%1%s se lay gia tri cua get_bloginfo('url')
						get_bloginfo('description'), //%2$s se lay gia tri cua get_bloginfo('description')
						get_bloginfo('sitename')); //%3$s se lay gia tri cua get_bloginfo('sitename')
					} else {

						printf('<p> <a href="%1$s" title="%2$s"> %3$s </a></p>',
						get_bloginfo('url'), //%1%s se lay gia tri cua get_bloginfo('url')
						get_bloginfo('description'), //%2$s se lay gia tri cua get_bloginfo('description')
						get_bloginfo('sitename')); //%3$s se lay gia tri cua get_bloginfo('sitename')

					}
				?>
				<?php 
					else:
				 ?>
				<img src="<?php echo $tp_options['logo-image']['url']; ?>" />
			<?php endif; ?>
			</div> 
			<div class="site-description"> 
			<?php bloginfo('description'); //bloginfo() tu dong se in ra con get_bloginfo() phai dung echo de in ra do no chi tra ve gia tri thoi ?> </div>
            <?php // mo the php lai vi ket thuc the html va tro lai the php
}

}

/**
Thiet lap menu
             **/
 if (!function_exists('thachpham_menu')) {

 	function thachpham_menu($menu) {

         $menu = array(
         	'theme_location' => $menu,
         	'container' => 'nav',
         	'container_class' => $menu,
         	'items_wrap'=>'<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
         	);

  		wp_nav_menu($menu);

 	}


 }

/**
Ham tao phan trang don gian
**/
if (!function_exists('thachpham_pagination')) {

		function thachpham_pagination(){
			if ($GLOBALS['wp_query']->max_num_pages < 2) {

				return '';
			} ?>

			<nav class="pagination" role="navigation" >
				<?php if (get_next_posts_link()): ?>
					<div class="prev"><?php next_posts_link( __('Older Posts','thachpham')); ?>  </div>
				<?php endif; ?>
				<?php if (get_previous_posts_link()): ?>
					<div class="next"> <?php previous_posts_link(__('Newest Posts','thachpham')); ?> </div>
				<?php endif; ?>

			</nav>

			<?php 

}

}
/**
Ham hien thi thumbnail
**/
if (!function_exists('thachpham_thumbnail')) {
	function thachpham_thumbnail($size){
			if (!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')) : ?>
 			 <figure class="post-thumbnail"> <?php the_post_thumbnail($size); ?> </figure>
	<?php endif; ?>
	<?php }


}

/**
thachpham_entry_header = hien thi tieu de post
**/
if (!function_exists('thachpham_entry_header')) {
	function thachpham_entry_header(){ ?>
		<?php if (is_single()): ?>
   			<h1 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?>  </a> </h1>
   				<?php else: ?> 
   					<h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?>  </a> </h2>
   			<?php endif; ?>
<?php	}


}

/**
thachpham_entry_meta=lay du lieu post
**/
if (!function_exists('thachpham_entry_meta')) {
		function thachpham_entry_meta(){ ?>
			<?php if (!is_page()) : ?>
				<div class="entry-meta">
				<?php 
					printf(__('<span class="author">Posted by %1$s','thachpham'),
						get_the_author());

						printf(__('<span class="date-published"> at %1$s', 'thachpham'),
						get_the_date()); // tra ve ngay thang dang bai

						printf(__('<span class="category"> in %1$s ', 'thachpham'),
						get_the_category_list( ', ' ));

						if (comments_open()): 
							echo '<span class="meta-reply">';
								comments_popup_link(
									__('Leave a comment','thachpham'),
									__('One comment','thachpham'),
									__('% comments','thachpham'),
									__('Read all comments','thachpham')

									);
								echo '</span>';
						endif; 

				?>

				</div>
			<?php endif; ?>

<?php   }

}

/**
thachpham_entry_content=ham hien thi noi dung cua post/page
**/
if (!function_exists('thachpham_entry_content')){
	function thachpham_entry_content(){
			if (!is_single() && !is_page()){
				the_excerpt();  // tra ve mot doan rut gon cua noi dung
				} else {

					the_content(); // hien thi toan bo noi dung cua post/page
					
					/* Phan trang trong single */
					$link_pages = array(
							'before' => __('<p>Page: ', 'thachpham'),
							'after' => '</p>',
							'nextpagelink' => __('Next Page','thachpham'),
							'previouspagelink' => __('Previous Page','thachpham')
							);
					wp_link_pages($link_pages);

				}

			
			

	}

}
function thachpham_readmore(){

	return '<a class="read-more" href="'.get_permalink(get_the_ID()).'">'.__('...[Read More]', 'thachpham'). '</a>'; 

}
add_filter ('excerpt_more', 'thachpham_readmore');

/**
thachpham_entry_tag=hien thi tag
**/
if (!function_exists('thachpham_entry_tag')) {
 function thachpham_entry_tag(){
 		if (has_tag()) :
 			echo '<div class="entry-tag">';
 			printf(__('Tagged in %1$s', 'thachpham'), get_the_tag_list('',',')); //get_the_list ls tham so cho %1$s 
 			echo '</div>';
 		endif;
 }



}

/*=====Nhúng file style.css======*/

function thachpham_style(){
wp_register_style('main-style',get_template_directory_uri().'/style.css', 'all');  // ham nay dung de nhung noi dung cua file style.css: tham so 1 la ten cua file style.css. tham so 2 la khai bao duong dan cho file style.css, tham so 3: all cho phep hien thi tren tat ca loai man hinh 
wp_enqueue_style('main-style');
wp_register_style('reset-style',get_template_directory_uri().'/reset.css', 'all');  // ham nay dung de nhung noi dung cua file style.css: tham so 1 la ten cua file style.css. tham so 2 la khai bao duong dan cho file style.css, tham so 3: all cho phep hien thi tren tat ca loai man hinh 
wp_enqueue_style('reset-style');


// Superfish Menu

wp_register_style('superfish-style',get_template_directory_uri().'/superfish.css', 'all');  // ham nay dung de nhung noi dung cua file style.css: tham so 1 la ten cua file style.css. tham so 2 la khai bao duong dan cho file style.css, tham so 3: all cho phep hien thi tren tat ca loai man hinh 
wp_enqueue_style('superfish-style');
wp_register_script('superfish-script',get_template_directory_uri().'/superfish.js', array('jquery'));  // ham nay dung de nhung noi dung cua file style.css: tham so 1 la ten cua file style.css. tham so 2 la khai bao duong dan cho file style.css, tham so 3: all cho phep hien thi tren tat ca loai man hinh 
wp_enqueue_script('superfish-script');

// Custom script
wp_register_script('custom-script',get_template_directory_uri().'/custom.js', array('jquery'));  // ham nay dung de nhung noi dung cua file style.css: tham so 1 la ten cua file style.css. tham so 2 la khai bao duong dan cho file style.css, tham so 3: all cho phep hien thi tren tat ca loai man hinh 
wp_enqueue_script('custom-script');

//test main.js
wp_register_script('main-script',get_template_directory_uri().'/scripts/main.js', 'all');  // ham nay dung de nhung noi dung cua file style.css: tham so 1 la ten cua file style.css. tham so 2 la khai bao duong dan cho file style.css, tham so 3: all cho phep hien thi tren tat ca loai man hinh 
wp_enqueue_script('main-script');

}
add_action('wp_enqueue_scripts','thachpham_style');

/* Tao mot custom post type*/

function tao_custom_post_type()
{
 
    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Các sản phẩm', //Tên post type dạng số nhiều
        'singular_name' => 'Sản phẩm' //Tên post type dạng số ít
    );
 
    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Post type đăng sản phẩm', //Mô tả của post type
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => array( 'category', 'post_tag' ), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, false thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => '', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
 
    register_post_type('sanpham', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên
 
}
/* Kích hoạt hàm tạo custom post type */
add_action('init', 'tao_custom_post_type');

/* Hien thi custom post type ra trang chu */
add_filter('pre_get_posts','lay_custom_post_type');
function lay_custom_post_type($query) {
  if (is_home() && $query->is_main_query ())
    $query->set ('post_type', array ('post','sanpham'));
    return $query;
}





