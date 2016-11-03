<?php
	get_currentuserinfo();
	global $current_user, $user_ID, $user_identity;
	if( !$user_ID || '' == $user_ID ) {
?>
<a id="showbtn"  onclick="showid('smallLay');">登录</a>  <?php wp_register(' &#8260; ', ''); ?>
<div id="smallLay">
	<div id="smallLay_box">
	<!-- if not logged -->
	<form action="<?php echo wp_login_url( get_permalink() ); ?>" method="post" id="loginform">
		<div class="loginblock">
			<p class="login"><input type="text" name="log" id="log" size="" tabindex="11" /></p>
			<p class="password"><input type="password" name="pwd" id="pwd"  size="" tabindex="12" /></p>
			<p class="lefted"><button value="Submit" id="submit_t" type="submit" tabindex="13">登录</button></p>
		</div>
		<input type="hidden" name="redirect_to" value="<?php echo $_SERVER[ 'REQUEST_URI' ]; ?>" />
		<input type="checkbox" name="rememberme" id="modlogn_remember" value="yes"  checked="checked" alt="Remember Me" />下次自动登录
	</form>
	<!-- end if not logged -->
	</div>
</div>
<?php
}
?>
