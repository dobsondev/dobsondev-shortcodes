<?php
/**
 * Plugin Name: DobsonDev Shortcodes
 * Plugin URI: http://dobsondev.com/portfolio/dobsondev-shortcodes/
 * Description: A collection of helpful shortcodes.
 * Version: 0.666
 * Author: Alex Dobson
 * Author URI: http://dobsondev.com/
 * License: GPLv2
 *
 * Copyright 2014  Alex Dobson  (email : alex@dobsondev.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


/* Adds a shortcode for displaying PDF's Inline */
function embed_PDF($atts) {
	extract(shortcode_atts(array(
		'source' => "Invalid Source",
		'width' => "100%",
		'height' => "600",
	), $atts));
  $source_headers = @get_headers($source);
  if ($source_headers[0] == 'HTTP/1.1 404 Not Found') {
    return '<p> Invalid PDF source. Please check your PDF source. </p>';
  } else {
    return '<object width="' . $width . '" height="' . $height . '" type="application/pdf" data="' . $source . '"></object>';
  }
}
add_shortcode('embedPDF', 'embed_pdf');


/* Adds a shortcode for displaying GitHub Gists */
function create_github_gist($atts) {
  extract(shortcode_atts(array(
    'source' => "Invalid Source",
  ), $atts));
  $source_headers = @get_headers($source);
  if ($source_headers[0] == 'HTTP/1.1 404 Not Found') {
    return '<p> Invalid GitHub Gist Source. Please check your source. </p>';
  } else {
    return '<script src="' . $source . '.js"></script>';
  }
}
add_shortcode('github_gist', 'create_github_gist');

?>