<?php

	/**
	 * @package tipTwitterCard
	 * @version 1.0
	 */
	/*
	Plugin Name: The Idea People Twitter Card
	Plugin URI: 
	Description: Handles putting the correct meta data in your posts to create a twitter summary card.
	Author: Doug Grubba
	Version: 1.0
	Author URI: http://theideapeople.com/
	*/

	function tipTwitterCard()
	{
		$htmlStr = '';

		/*
		twitter:url	Canonical URL of the card content.
		twitter:title	The title of your content as it should appear in the card.
		twitter:description	A description of the content in a maximum of 200 characters.
		twitter:image	A URL to the image representing the content.
		 */
		
		if( is_single() ) {

			//stuff like this is why people hate php
			global $post;

			//create the meta tags
			$htmlStr.= '<meta name="twitter:card" content="summary">';
			$htmlStr.= '<meta name="twitter:title" content=" ' . addslashes( $post->post_title ) . '">';
			$htmlStr.= '<meta name="twitter:description" content=" ' . addslashes( $post->post_excerpt ) . '">';
			$htmlStr.= '<meta name="twitter:url" content="'. get_permalink( $post->ID ) .'">';

			//if it hast a feature image, add that too
			if ( has_post_thumbnail( $post->ID ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
				$htmlStr.= '<meta name="twitter:image" content="' . $image[0] . '">';
			}
		}

		//parse it out
		echo $htmlStr;
	}

	add_action('wp_head', 'tipTwitterCard');