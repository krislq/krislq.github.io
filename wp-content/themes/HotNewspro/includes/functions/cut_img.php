<?php if (get_option('swt_cut_img') == 'Hide') { ?>
<?php { echo ''; } ?>
<?php } else { 
add_image_size('thumbnail', 140, 100, true);
add_image_size('show', 400, 248, true);
add_image_size('hot', 236, 155, true);
 } ?>