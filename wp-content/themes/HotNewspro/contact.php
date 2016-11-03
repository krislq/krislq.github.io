<?php
/*
Template Name: 联系方式
*/
?>

<?php get_header(); ?>
<div id="content">
	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>	
	<!-- menu -->
	<div id="map">
		<div class="browse">现在位置 ＞<a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> ＞<?php the_title(); ?></div>
		<div id="feed"><a href="<?php echo get_option('swt_rsssub'); ?>" title="RSS">RSS</a></div>
	</div>
	<!-- end: menu -->
	<!-- entry -->
	<div class="clear"></div>
	<div class="entry_box_s">
		<div class="entry">
			<div class="page" id="post-<?php the_ID(); ?>">
				<?php the_content('More &raquo;'); ?>
				<div class="clear"></div>
			</div>
		<div class="contact" style="padding:30px;">
				<h3>联系我</h3>
				<div id="hint">可以使用下面的表单发送Email，我会尽快回复！</div>
				<form action="" id="wr" name="wr" class="index_contact_form">
					<div class="contact_form_inner_form">
						<div class="index_contact_form_title">昵称</div>
						<input type="text" name="name" id="form_name" style="padding:3px;border:1px solid #0196e3;"/>
						<div class="index_contact_form_title">邮箱</div>
						<input type="text" name="email" id="form_email" style="padding:3px;border:1px solid #0196e3;"/>
						<div class="index_contact_form_title">网站</div>
						<input type="text" name="website" id="form_website" style="padding:3px;border:1px solid #0196e3;"/>
						<div class="index_contact_form_title">内容</div>
						<textarea name="message" id="form_message" style="height:100px;padding:10px;border:1px solid #0196e3;width:96.5%;" cols="" rows=""></textarea>
						<input type="button" value="发送邮件" class="contact_form_submit" onclick="initrequest('<?php bloginfo('template_url'); ?>/includes/form.php');" style="cursor:pointer;background: #498FE1;width:87px;height:26px;color: #fff;text-align:center;text-shadow: 0px 1px 0px #000;margin:10px 0 0 0;border:0px;"/>
					</div>
				</form>
			</div>
		</div>
		<!-- end: entry -->
		<div class="clear"></div>
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_sb">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- end: content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
