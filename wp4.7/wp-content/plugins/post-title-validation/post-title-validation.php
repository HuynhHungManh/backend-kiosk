<?php
/*Plugin Name: Post Title Validation
Plugin URI: http://www.indiatale.com/post-title-validation/
Description: This plugin validate post and page title field. It will also work for custom content type.
Author: Pranav Pathak
Version: 1.1
Author URI: http://www.indiatale.com/post-title-validation/
*/

/**  Copyright 2013  Pranav Pathak  (email : pranavpathak125@gmail.com)
 *
 *    This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License, version 2, as 
 *    published by the Free Software Foundation.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program; if not, write to the Free Software
 *    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * This file use worpdress hook called admin_enqueue_scripts and attach a javascript file called 
 * post_title_validation.js. The function post_title_validation_function only works when post.php 
 * edit.php or post-new.php files runs.
 */
add_action( 'admin_enqueue_scripts', 'post_title_validation_function' );

function post_title_validation_function($hook){
	if( 'post.php' != $hook && 'edit.php' != $hook && 'post-new.php' != $hook)
        return;
	wp_enqueue_script( 'custom_admin_script',  plugins_url('/js/post-title-validation.js', __FILE__));
}
