<?php 
	if (is_active_sidebar('main-sidebar')): // ktra neu sidebar co widget roi thi se hien thi khong thi thoi
		dynamic_sidebar('main-sidebar');
		else:
			_e('This is a sidebar. You have to add some widgets','thachpham');
	endif;

 ?>
