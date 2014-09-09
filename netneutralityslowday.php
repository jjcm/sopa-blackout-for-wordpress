<?php
/**
 *  * @package Net Neutrality Slow Day
 *   */
/*
 * Plugin Name: Net Neutrality Slow Day JS
 * Plugin URI: https://github.com/jjcm/slow-day-for-wordpress
 * Description: Net Neutrality Slow Day JS helps you support the Net Neutrality Slow Day by inserting JavaScript into your page head on 10 September 2014.
 * Version: 1.0.1
 * Author: Jacob Miller
 * Author URI: http://jjcm.org
 * License: GPLv2
 * */

/*
 * This program is free software; you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published by 
 * the Free Software Foundation; version 2 of the License.
 *
 * This program is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
 * GNU General Public License for more details. 
 *
 * You should have received a copy of the GNU General Public License 
 * along with this program; if not, write to the Free Software 
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA 
 * */

define('NET_NEUTRALITY_SLOW_DAY', '1.0.0');

if ( ! class_exists('Net_Neutrality_JS_Filter') ) {
    /**
     * Filter functions for WordPress
     */
    class Net_Neutrality_JS_Filter {

        /**
         * Net Neutrality Slow Day date, in ISO-8601 format.
         *
         * @var string
         * @access public
         */
        const DATE_SLOW     = '2014-09-10';

        /**
         * URL for source JavaScript file.
         *
         * @var string
         * @access public
         */
        const JAVASCRIPT_URL    = 'http://js.netneutralityslowday.com/slowday.js';

        /**
         * JavaScript filename.
         *
         * @var string
         * @access public
         */
        const JAVASCRIPT_FNAME  = 'slowday.js';

        /**
         * Determine if the blog is in SOPA Blackout time
         *
         * Method appropriated from https://github.com/chrisguitarguy/WP-SOPA-Blackout/blob/master/wp-sopa-blackout.php
         *
         * @return bool
         * @access public
         */
        function is_slow_day_time() {
            return ( ! is_admin() && date('Y-m-d', current_time('timestamp')) == self::DATE_SLOW );
        }

        /**
         * Output the relevant JavaScript
         *
         * @return void
         * @access public
         */
        function enqueue_scripts() {
            $src = plugins_url(self::JAVASCRIPT_FNAME, __FILE__);

            if (self::is_slow_day_time()) {
                wp_enqueue_script('slowday', $src);
            }
        }
    }
}

add_action('wp_enqueue_scripts', array('Net_Neutrality_JS_Filter','enqueue_scripts'), 2);



