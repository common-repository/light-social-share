<?php
/*
Plugin Name: Light Social Share
Author: Zakaria Binsaifullah
Author URI: https://www.wpquerist.com
Description: Displaying social sharing icons with the easiest way after each post content.
Version: 1.0.2
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: light-social-share
Domain Path:  /languages
*/


function ess_activation() {
    //silent is golden
}

register_activation_hook(__FILE__, 'ess_activation');

function ess_deactivation() {
    // silent is golden
}

register_deactivation_hook(__FILE__, 'ess_deactivation');

function ess_text_domain() {
    load_plugin_textdomain('light-social-share', false, dirname(__FILE__) . "/languages");
}

add_action('plugins_loaded', 'ess_text_domain');

/*
 * Plugin's asset 
 * */

function ess_plugin_assets() {
    wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'assets/css/font-awesome.min.css', null, '4.7.0', 'all');
    wp_enqueue_style('ess-style', plugin_dir_url(__FILE__) . 'assets/css/ess.css', null, '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'ess_plugin_assets');


/*
 * Plugin's root codes are here....
 * */

function ess_plugin_function($content) {
    if (is_single()) {
        /*
         * Current Post's necessary info
         * */
        $current_post_id        = get_the_ID();
        $current_post_title     = get_the_title($current_post_id);
        $current_post_link      = get_the_permalink($current_post_id);
        $current_post_thumbnail = get_the_post_thumbnail_url($current_post_id, 'full');

        /*
         * Common Social Media Share links with current post's info
         * */


        $fb_link = 'http://www.facebook.com/sharer/sharer.php?u=' . $current_post_link . '&t=' . $current_post_title;
        $tw_link = 'https://www.twitter.com/intent/tweet?text=' . $current_post_title . '&amp;url=' . $current_post_link . '&amp;via=ess';
        $gp_link = 'https://plus.google.com/share?url=' . $current_post_link;
        $li_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $current_post_link . '&amp;title=' . $current_post_title;
        $pr_link = 'https://pinterest.com/pin/create/button/?url=' . $current_post_link . '&amp;media=' . $current_post_thumbnail . '&amp;description=' . $current_post_title;
        $rd_link = 'https://reddit.com/submit?url=' . $current_post_link . '&title=' . $current_post_title;
        $tr_link = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $current_post_link . '&title=' . $current_post_title;


        /*
         * Links with icons are attached
         * */
        $content .= "<div class='ess_social_share'>";

        $content .= "<a href='" . $fb_link . "' target='_blank'><i class='fa fa-facebook'></i></a>";
        $content .= "<a href='" . $tw_link . "' target='_blank'><i class='fa fa-twitter'></i></a>";
        $content .= "<a href='" . $gp_link . "' target='_blank'><i class='fa fa-google-plus'></i></a>";
        $content .= "<a href='" . $li_link . "' target='_blank'><i class='fa fa-linkedin'></i></a>";
        $content .= "<a href='" . $pr_link . "' target='_blank'><i class='fa fa-pinterest'></i></a>";
        $content .= "<a href='" . $rd_link . "' target='_blank'><i class='fa fa-reddit'></i></a>";
        $content .= "<a href='" . $tr_link . "' target='_blank'><i class='fa fa-tumblr'></i></a>";

        $content .= "</div>";

        return $content;
    } else {
        return $content;
    }
}

add_filter('the_content', 'ess_plugin_function');


