<div class="random_r">
<?php
if ( is_single() ) :
global $post;
$categories = get_the_category();
foreach ($categories as $category) :
?>
	<h3>本分类最新文章<!-- <?php echo $category->name; ?> --></h3>
	<div class="box_r">
		<div class="mcat_img"></div>
	    <ul> 
	        <?php
	        $posts = get_posts('numberposts=5&category='. $category->term_id);
	        foreach($posts as $post) :
	        ?>
			<li><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 31, '');?></a></li>
	        <?php endforeach; ?>
	    </ul>
		<?php endforeach; endif ; ?>
		<div class="clear"></div>
	</div>
	<div class="box-bottom">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
</div>