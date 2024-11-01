<?php
/*
Plugin Name: Single Random Post With Text
Plugin URI: http://blog.121416.co.cc/wordpress/wordpress-plugin-single-random-post-with-text/
Description: This plugin will allow you to display a single post selected random from your posts database, from a specific category and will display some text from the post, too.
Version: 2.0
Author: Cristescu Bogdan
Author URI: http://blog.121416.co.cc
*/

//This function is for making the content to be "excerpted"

function dp_content($excerpt, $substr=0) {
	$string = strip_tags(str_replace('[...]', '...', $excerpt));
	if ($substr>0) {
		$string = substr($string, 0, $substr);
	}
	return $string;
}

//Here starts the calling of the plugin. Here I made for you the technology of Single Random Post With Text

function single_random_post_text() {
	global $post;
	$rand_posts = $post;

//You can edit the category ID number in the get_posts function. The default number is 5, change it with your preferred category ID.

	$rand_posts = get_posts('numberposts=1&orderby=rand&category=5');
	foreach( $rand_posts as $post ) : setup_postdata($post);
		echo '<h2><a href="';
		    echo the_permalink($post->ID);
		echo '">';
		    echo the_title();
		echo '</a></h2>';
		echo '<p>';

//You can edit the characters number in the db_content function. The default number is 200 characters, but you can increase or decrease this number.

		    echo dp_content($post->post_content, 200);
		echo '</p>';
		echo '<a href="';
		    echo the_permalink($post->ID);
		echo '"> [read more]</a>';
		endforeach;
		$post = $rand_posts;
}
?>