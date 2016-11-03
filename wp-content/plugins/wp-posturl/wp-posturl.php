<?php
/*
Plugin Name: Add Post URL
Plugin URI: http://easwy.com/blog/wordpress/wp-posturl/
Description: This plugin allows you to insert a user specific text (such as copyright, credit, advertisement, etc.) at the beginning/ending of your posts. You can also decide which posts display the specific text.
Version: 2.1.0
Author: Easwy Yang
Author URI: http://easwy.com/
*/

/*  Copyright 2009-2012  Easwy Yang  (Homepage: http://easwy.com/)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Current version
global $posturl_active_options_version;
$posturl_active_options_version = '1.2'; // HARD CODED VERSION STRING

### Create Text Domain For Translations
add_action('init', 'posturl_textdomain');
function posturl_textdomain() {
    $plugin_dir = basename(dirname(__FILE__));
    load_plugin_textdomain( 'wp-posturl', 'wp-content/plugins/' . $plugin_dir, $plugin_dir );
}


### Function: Post URL Option Menu
add_action('admin_menu', 'posturl_menu');
function posturl_menu() {
    $plugin_dir = basename(dirname(__FILE__));
    if (function_exists('add_options_page')) {
        add_options_page(__('Add Post URL', 'wp-posturl'),
            __('Add Post URL', 'wp-posturl'), 'manage_options',
            $plugin_dir . '/posturl-options.php') ;
    }
}

### Function: Post URL: Add Post URL for Post
add_action('the_content', 'wp_posturl', 0);
function wp_posturl($text) {
    global $post;
    global $posturl_active_options_version;

    $posturl_options = get_option('posturl_options');

    // Check options version here
    if (!array_key_exists('options_version', $posturl_options)
        || $posturl_options['options_version'] != $posturl_active_options_version)
    {
        posturl_upgrade_options();
        $posturl_options = get_option('posturl_options');
    }

    /*
     * If set 'posturl_add_url' meta to 'yes', or adding url is disabled by 
     * default, return origin text.
     * Also keeping compatible with QingFeng's change.
     */
    $add_url = get_post_meta($post->ID, 'posturl_add_url', true);
    $url_hide = get_post_meta($post->ID, 'posturl_hide', true);
    if (($add_url == 'no') || $url_hide
        || (empty($add_url) && !$posturl_options['add_url_by_default']))
    {
        return $text;
    }

    if ((is_single() && $posturl_options['add_to_single'])
        || (is_home() && $posturl_options['add_to_home'])
        || (is_page() && $posturl_options['add_to_page'])
        || (is_category() && $posturl_options['add_to_category'])
        || (is_tag() && $posturl_options['add_to_tag'])
        || (is_feed() && $posturl_options['add_to_feed'])
        || ((is_day() || is_month() || is_year()) && $posturl_options['add_to_archive'])
    ) {

        // Add header text if not empty
        $header_text = $posturl_options['header_text'];
        $header_text = trim($header_text);
        if (!empty($header_text))
        {
            $header_text = str_replace("%site_url%", site_url('/'), $header_text);
            $header_text = str_replace("%site_name%", get_bloginfo('sitename'), $header_text);
            $header_text = str_replace("%post_url%", get_permalink(), $header_text);
            $header_text = str_replace("%post_title%", the_title('', '', false), $header_text);
            $header_text = stripslashes($header_text);
            $text = $header_text . $text;
        }

        $footer_text = $posturl_options['footer_text'];
        $footer_text = trim($footer_text);
        if (!empty($footer_text))
        {
            $footer_text = str_replace("%site_url%", site_url('/'), $footer_text);
            $footer_text = str_replace("%site_name%", get_bloginfo('sitename'), $footer_text);
            $footer_text = str_replace("%post_url%", get_permalink(), $footer_text);
            $footer_text = str_replace("%post_title%", the_title('', '', false), $footer_text);
            $footer_text = stripslashes($footer_text);
            $text .= $footer_text;
        }

        // add credit?
        $add_credit = $posturl_options["add_credit"];
        if ($add_credit) 
        {
            $text .= sprintf(__('<div style="margin-top: 0; margin-bottom: 15px; color: #888888; font-size: 80%%; font-style: italic"><p>Post Footer automatically generated by <a href="%1$s" style="color: #8888FF; text-decoration: underline;">wp-posturl plugin</a> for wordpress.</p></div>', 'wp-posturl'), 'http://easwy.com/blog/wordpress/wp-posturl/');
        }
    }

    return $text;
}

### Function: Post URL Options
add_action('activate_' . basename(dirname(__FILE__)) . '/wp-posturl.php', 'posturl_init');
function posturl_init() {
    posturl_textdomain();

    // When activating, upgrade options
    posturl_upgrade_options();
}

### Function: Upgrade options or set default options
function posturl_upgrade_options() {
    global $posturl_active_options_version;

    $default_footer_text = addslashes(__('<div style="margin-top: 15px; font-style: italic"><p><strong>From</strong> <a href="%site_url%">%site_name%</a>, <strong>post</strong> <a href="%post_url%">%post_title%</a></p></div>','wp-posturl'));

    // Default options
    $new_options = array(
        'footer_text'           => $default_footer_text,
        'header_text'           => '',
        'add_credit'            => true,
        'add_to_home'           => true,
        'add_to_category'       => true,
        'add_to_tag'            => true,
        'add_to_archive'        => true,
        'add_to_single'         => true,
        'add_to_feed'           => true,
        'add_to_page'           => true,
        'add_url_by_default'    => true,
        'options_version'       => $posturl_active_options_version
    );

    $old_options = get_option('posturl_options');
    if ($old_options === false)
    {
        // First installation, add options
        add_option('posturl_options', $new_options);
    }
    else
    {
        // Upgrade options
        if (!array_key_exists('options_version', $old_options)
            || $old_options['options_version'] != $posturl_active_options_version)
        {
            // Keep user's old options
            foreach ($new_options as $key => $value)
            {
                if (array_key_exists($key, $old_options))
                {
                    switch($key)
                    {
                    case 'header_text':
                    case 'footer_text':
                        $new_options[$key] = $old_options[$key];
                        break;
                    case 'options_version':
                        // nothing to do
                        break;
                    default:
                        if (isset($old_options[$key]))
                        {
                            if ($old_options[$key] === 'Yes'
                                || $old_options[$key] === 'true'
                                || $old_options[$key] === true)
                            {
                                $new_options[$key] = true;
                            }
                            else
                            {
                                $new_options[$key] = false;
                            }
                        }
                        else
                        {
                            $new_options[$key] = false;
                        }
                        break;
                    }
                }
            }

            // Upgrade add_to_beginning option
            if (array_key_exists('add_to_beginning', $old_options))
            {
                if ($old_options['add_to_beginning'] == 'Yes')
                {
                    if (array_key_exists('post_url_text', $old_options))
                    {
                        $new_options['header_text'] = $old_options['post_url_text'];
                    }
                    else
                    {
                        $new_options['header_text'] = $default_footer_text;
                    }
                    $new_options['footer_text'] = '';
                }
                else
                {
                    if (array_key_exists('post_url_text', $old_options))
                    {
                        $new_options['footer_text'] = $old_options['post_url_text'];
                    }
                }
            }

            /*
             * To fix the problem in 2.0.1/2.0.2, set to true by default
             * It may change the user configuration if you re-activate
             * the plugin
             */
            $new_options['add_url_by_default'] = true;

            // Update options version
            $new_options['options_version'] = $posturl_active_options_version;

            // refresh options
            delete_option('posturl_options');
            add_option('posturl_options', $new_options);
        }
        else
        {
            // Option version no change, nothing to do
        }
    }
}


### Function: Post URL Meta Box
function posturl_meta_box() {
    global $post;
    $add_url = get_post_meta($post->ID, 'posturl_add_url', true);
    if (empty($add_url))
    {
        $posturl_options = get_option('posturl_options');
        if ($posturl_options['add_url_by_default'])
        {
            $add_url = 'yes';
        }
        else
        {
            $add_url = 'no';
        }
    }
    echo '
        <p>'.__('Add Post URL?', 'wp-posturl').'
        &nbsp;
    <input type="radio" name="add_url" id="add_url_yes" value="yes" '.checked('yes', $add_url, false).' /> <label for="add_url_yes">'.__('Yes', 'wp-posturl').'</label> &nbsp;&nbsp;
    <input type="radio" name="add_url" id="add_url_no" value="no" '.checked('no', $add_url, false).' /> <label for="add_url_no">'.__('No', 'wp-posturl').'</label>
        ';
    echo '
        </p>
        ';
}

### Function: Post URL Add Meta Box
function posturl_add_meta_box() {
    add_meta_box('posturl_post_form', __('Add Post URL', 'wp-posturl'), 'posturl_meta_box', 'post', 'side');
}
add_action('admin_init', 'posturl_add_meta_box');

### Function: Post URL Store Meta Data
function posturl_store_post_options($post_id) {
    $post = get_post($post_id);

    if (!$post || $post->post_type == 'revision') {
        return;
    }

    $saved_meta = get_post_meta($post_id, 'posturl_add_url', true);
    $posted_meta = $_POST['add_url'];

    $save = false;
    if (!empty($posted_meta)) {
        $posted_meta == 'yes' ? $meta = 'yes' : $meta = 'no';
        $save = true;
    }
    else if (empty($saved_meta)) {
        $posturl_options = get_option('posturl_options');
        $posturl_options['add_url_by_default'] ? $meta = 'yes' : $meta = 'no';
        $save = true;
    }

    if ($save) {
        update_post_meta($post_id, 'posturl_add_url', $meta);
    }
}
add_action('draft_post', 'posturl_store_post_options', 1, 2);
add_action('publish_post', 'posturl_store_post_options', 1, 2);
add_action('save_post', 'posturl_store_post_options', 1, 2);

?>
