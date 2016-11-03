<?php

### Variables
$mode='';
$posturl_settings = array('posturl_options');
$posturl_active_options_version = '1.2'; // HARD CODED VERSION STRING

### Form Processing 
// Update Options
if(!empty($_POST['Submit'])) {
    $posturl_options = array();
    $posturl_options['header_text'] = $_POST['header_text'];
    $posturl_options['footer_text'] = $_POST['footer_text'];
    $posturl_options['add_credit'] = isset($_POST['add_credit']);
    $posturl_options['add_to_home'] = isset($_POST['add_to_home']);
    $posturl_options['add_to_category'] = isset($_POST['add_to_category']);
    $posturl_options['add_to_tag'] = isset($_POST['add_to_tag']);
    $posturl_options['add_to_archive'] = isset($_POST['add_to_archive']);
    $posturl_options['add_to_single'] = isset($_POST['add_to_single']);
    $posturl_options['add_to_feed'] = isset($_POST['add_to_feed']);
    $posturl_options['add_to_page'] = isset($_POST['add_to_page']);
    $posturl_options['add_url_by_default'] = isset($_POST['add_url_by_default']);
    $posturl_options['options_version'] = $posturl_active_options_version;

    // Delete then add again
    delete_option('posturl_options');

    $update_posturl_queries = array();
    $update_posturl_text = array();
    $update_posturl_queries[] = add_option('posturl_options', $posturl_options);
    $update_posturl_text[] = __('Post URL Options', 'wp-posturl');
    $i=0;
    $text = '';
    foreach($update_posturl_queries as $update_posturl_query) {
        if($update_posturl_query) {
            $text .= '<font color="green">'.$update_posturl_text[$i].' '.__('Updated', 'wp-posturl').'</font><br />';
        }
        $i++;
    }
    if(empty($text)) {
        $text = '<font color="red">'.__('No Post URL Option Updated', 'wp-posturl').'</font>';
    }
}
// Uninstall Add Post URL
if(!empty($_POST['do'])) {
    switch($_POST['do']) {
    case __('UNINSTALL Add Post URL', 'wp-posturl') :
        if(trim($_POST['uninstall_posturl_yes']) == 'yes') {
            echo '<div id="message" class="updated fade">';
            echo '<p>';
            foreach($posturl_settings as $setting) {
                $delete_setting = delete_option($setting);
                if($delete_setting) {
                    echo '<font color="green">';
                    printf(__('Setting Key \'%s\' has been deleted.', 'wp-posturl'), "<strong><em>{$setting}</em></strong>");
                    echo '</font><br />';
                } else {
                    echo '<font color="red">';
                    printf(__('Error deleting Setting Key \'%s\'.', 'wp-posturl'), "<strong><em>{$setting}</em></strong>");
                    echo '</font><br />';
                }
            }
            echo '</p>';
            echo '</div>'; 
            $mode = 'end-UNINSTALL';
        }
        break;
    }
}


### Determines Which Mode It Is
switch($mode) {
    //  Deactivating Add Post URL
case 'end-UNINSTALL':
    $deactivate_url = 'plugins.php?action=deactivate&amp;plugin=' . basename(dirname(__FILE__)) . '/wp-posturl.php';
    if(function_exists('wp_nonce_url')) { 
        $deactivate_url = wp_nonce_url($deactivate_url, 'deactivate-plugin_' . basename(dirname(__FILE__)) . '/wp-posturl.php');
    }
    echo '<div class="wrap">';
    echo '<h2>'.__('Uninstall Add Post URL', 'wp-posturl').'</h2>';
    echo '<p><strong>'.sprintf(__('<a href="%s">Click Here</a> To Finish The Uninstallation And Add Post URL Will Be Deactivated Automatically.', 'wp-posturl'), $deactivate_url).'</strong></p>';
    echo '</div>';
    break;
    // Main Page
default:
    $posturl_options = get_option('posturl_options');
?>
<?php if(!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
<script type="text/javascript">
    function views_default(template) {
        default_footer_text = "<?php echo addslashes(__('<div style="margin-top: 15px; font-style: italic"><p><strong>From</strong> <a href="%site_url%">%site_name%</a>, <strong>post</strong> <a href="%post_url%">%post_title%</a></p></div>','wp-posturl')); ?>";
        document.getElementById("header_text").value = '';
        document.getElementById("footer_text").value = default_footer_text;
        document.getElementById("add_credit").checked = true;
        document.getElementById("add_to_home").checked = true;
        document.getElementById("add_to_category").checked = true;
        document.getElementById("add_to_tag").checked = true;
        document.getElementById("add_to_archive").checked = true;
        document.getElementById("add_to_single").checked = true;
        document.getElementById("add_to_feed").checked = true;
        document.getElementById("add_to_page").checked = true;
        document.getElementById("add_url_by_default").checked = true;
    }
</script>
<div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php _e('Post URL Options', 'wp-posturl'); ?></h2>
        <h3><?php _e('Post URL Text', 'wp-posturl'); ?></h3>
        <table class="form-table">
            <tr>
                <td valign="top" width="30%"><?php _e('Add Header and/or Footer For Old Posts (Keep selected if in doubt):', 'wp-posturl'); ?></td>
                <td>
                    <input name="add_url_by_default" id="add_url_by_default" type="checkbox" value="true" <?php if($posturl_options['add_url_by_default']) echo 'checked="checked"'; ?> />
                </td>
            </tr>
            <tr>
                <td valign="top" width="30%"><strong><?php _e('Header Text:', 'wp-posturl'); ?></strong><br />
                    <?php _e('This text will be inserted at beginning of your post if not empty.', 'wp-posturl'); ?><br /><br />
                    <?php _e('Allowed Variables:', 'wp-posturl'); ?>
                    <ul>
                        <li> <?php _e('<code>%site_url%</code> - the URL of your site', 'wp-posturl'); ?></li>
                        <li><?php _e('<code>%site_name%</code> - the name of your site', 'wp-posturl'); ?></li>
                        <li><?php _e('<code>%post_url%</code>  - the URL of a post', 'wp-posturl'); ?></li>
                        <li><?php _e('<code>%post_title%</code> -the title of a post', 'wp-posturl'); ?></li>
                    </ul>
                </td>
                <td>
                    <textarea name="header_text" id="header_text" cols="64" rows="10"><?php echo htmlspecialchars(stripslashes($posturl_options['header_text']), ENT_QUOTES); ?></textarea><br />
                </td>
            </tr>
            <tr>
                <td valign="top" width="30%"><strong><?php _e('Footer Text:', 'wp-posturl'); ?></strong><br />
                    <?php _e('This text will be inserted at end of your post if not empty.', 'wp-posturl'); ?><br /><br />
                    <?php _e('Allowed Variables:', 'wp-posturl'); ?>
                    <ul>
                        <li> <?php _e('<code>%site_url%</code> - the URL of your site', 'wp-posturl'); ?></li>
                        <li><?php _e('<code>%site_name%</code> - the name of your site', 'wp-posturl'); ?></li>
                        <li><?php _e('<code>%post_url%</code>  - the URL of a post', 'wp-posturl'); ?></li>
                        <li><?php _e('<code>%post_title%</code> -the title of a post', 'wp-posturl'); ?></li>
                    </ul>
                </td>
                <td>
                    <textarea name="footer_text" id="footer_text" cols="64" rows="10"><?php echo htmlspecialchars(stripslashes($posturl_options['footer_text']), ENT_QUOTES); ?></textarea><br />
                </td>
            </tr>
                <tr>
                    <td valign="top" width="30%"><?php _e('Add To Blog Home:', 'wp-posturl'); ?></td>
                    <td>
                        <input name="add_to_home" id="add_to_home" type="checkbox" value="true" <?php if($posturl_options['add_to_home']) echo 'checked="checked"'; ?> />
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="30%"><?php _e('Add To Pages:', 'wp-posturl'); ?></td>
                    <td>
                        <input name="add_to_page" id="add_to_page" type="checkbox" value="true" <?php if($posturl_options['add_to_page']) echo 'checked="checked"'; ?> />
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="30%"><?php _e('Add To Categories:', 'wp-posturl'); ?></td>
                    <td>
                        <input name="add_to_category" id="add_to_category" type="checkbox" value="true" <?php if($posturl_options['add_to_category']) echo 'checked="checked"'; ?> />
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="30%"><?php _e('Add To Tags:', 'wp-posturl'); ?></td>
                    <td>
                        <input name="add_to_tag" id="add_to_tag" type="checkbox" value="true" <?php if($posturl_options['add_to_tag']) echo 'checked="checked"'; ?> />
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="30%"><?php _e('Add To Archives:', 'wp-posturl'); ?></td>
                    <td>
                        <input name="add_to_archive" id="add_to_archive" type="checkbox" value="true" <?php if($posturl_options['add_to_archive']) echo 'checked="checked"'; ?> />
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="30%"><?php _e('Add To Single:', 'wp-posturl'); ?></td>
                    <td>
                        <input name="add_to_single" id="add_to_single" type="checkbox" value="true" <?php if($posturl_options['add_to_single']) echo 'checked="checked"'; ?> />
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="30%"><?php _e('Add To Feed:', 'wp-posturl'); ?></td>
                    <td>
                        <input name="add_to_feed" id="add_to_feed" type="checkbox" value="true" <?php if($posturl_options['add_to_feed']) echo 'checked="checked"'; ?> />
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="30%"><?php _e('Help Promote WP-PostURL Plugin:', 'wp-posturl'); ?></td>
                    <td>
                        <input name="add_credit" id="add_credit" type="checkbox" value="true" <?php if($posturl_options['add_credit']) echo 'checked="checked"'; ?> />
                    </td>
                </tr>
        </table>
        <br /> <br />
        <table> <tr>
        <td>
            <input type="submit" name="Submit" class="button" value="<?php _e('Save Changes', 'wp-posturl'); ?>" class="submit"/>
        </td>
        <td> &nbsp; </td>
        <td>
        <input type="button" name="RestoreDefault" value="<?php _e('Restore Default Values', 'wp-posturl'); ?>" onclick="views_default();" class="button" />
        </td>
        </tr> </table>
</div>
</form> 
<p>&nbsp;</p>

<!-- Uninstall Add Post URL -->
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
<div class="wrap"> 
        <h3><?php _e('Uninstall Add Post URL', 'wp-posturl'); ?></h3>
        <p>
          <?php _e('Deactivating Add Post URL plugin does not remove any data that may have been created, such as the post URL options. To completely remove this plugin, you can uninstall it here.', 'wp-posturl'); ?>
        </p>
        <p style="color: red">
          <strong><?php _e('WARNING:', 'wp-posturl'); ?></strong><br />
          <?php _e('Once uninstalled, this cannot be undone. You should use a Database Backup plugin of WordPress to back up all the data first.', 'wp-posturl'); ?>
        </p>
        <p style="color: red">
          <strong><?php _e('The following WordPress Options will be DELETED:', 'wp-posturl'); ?></strong><br />
        </p>
        <table class="widefat">
          <thead>
            <tr>
              <th><?php _e('WordPress Options', 'wp-posturl'); ?></th>
            </tr>
          </thead>
          <tr>
            <td valign="top">
              <ol>
                <?php
                    foreach($posturl_settings as $settings) {
                      echo '<li>'.$settings.'</li>'."\n";
                    }
                ?>
              </ol>
            </td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <p style="text-align: center;">
        <input type="checkbox" name="uninstall_posturl_yes" value="yes" />&nbsp;<?php _e('Yes', 'wp-posturl'); ?><br /><br />
        <input type="submit" name="do" value="<?php _e('UNINSTALL Add Post URL', 'wp-posturl'); ?>" class="button" onclick="return confirm('<?php _e('You Are About To Uninstall Add Post URL From WordPress.\nThis Action Is Not Reversible.\n\n Choose [Cancel] To Stop, [OK] To Uninstall.', 'wp-posturl'); ?>')" />
        </p>
</div> 
</form>
<?php
} // End switch($mode)
?>
