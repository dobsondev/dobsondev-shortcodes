<?php
/**
 * Plugin Name: DobsonDev Shortcodes
 * Plugin URI: http://dobsondev.com/portfolio/dobsondev-shortcodes/
 * Description: A collection of helpful shortcodes.
 * Version: 0.667
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
function dobson_embed_PDF($atts) {
  extract(shortcode_atts(array(
    'source' => "Invalid Source",
    'width' => "100%",
    'height' => "600",
  ), $atts));
  $source_headers = @get_headers($source);
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid PDF source. Please check your PDF source. </p>';
  } else {
    return '<object width="' . $width . '" height="' . $height . '" type="application/pdf" data="'
    . $source . '"></object>';
  }
}
add_shortcode('embedPDF', 'dobson_embed_pdf');


/* Adds a shortcode for displaying GitHub Gists */
function dobson_create_github_gist($atts) {
  extract(shortcode_atts(array(
    'source' => "Invalid Source",
  ), $atts));
  $source_headers = @get_headers($source);
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid GitHub Gist source. Please check your source. </p>';
  } else {
    return '<script src="' . $source . '.js"></script>';
  }
}
add_shortcode('embedGist', 'dobson_create_github_gist');


/* Adds a shortcode to embed a Twitch Stream */
function dobson_embed_twitch($atts) {
  extract(shortcode_atts(array(
    'username' => "Invalid Username",
    'width' => "620",
    'height' => "378",
  ), $atts));
  $source_headers = @get_headers("http://twitch.tv/" . $username);
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid Twitch channel name. Please check your username and channel settings on Twitch to make '
    . 'sure they are setup correctly. </p>';
  } else {
    return '<object type="application/x-shockwave-flash" height="' . $height . '" width="' . $width
    . '" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel='
    . $username . '" bgcolor="#000000">
    <param name="allowFullScreen" value="true" />
    <param name="allowScriptAccess" value="always" />
    <param name="allowNetworking" value="all" />
    <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
    <param name="flashvars" value="hostname=www.twitch.tv&channel=' . $username . '&auto_play=true&start_volume=25" />
    </object>';
  }
}
add_shortcode('embedTwitch', 'dobson_embed_twitch');


/* Adds a shortcode to embed a YouTube video */
function dobson_embed_youtube($atts) {
  extract(shortcode_atts(array(
    'video' => "Invalid Video ID",
    'width' => "560",
    'height' => "315",
  ), $atts));
  $source_headers = @get_headers("http://youtube.com/watch?v=" . $video);
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid YouTube video ID. Please check your YouTube video ID. </p>';
  } else {
    return '<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $video
    . '" frameborder="0" allowfullscreen></iframe>';
  }
}
add_shortcode('embedYouTube', 'dobson_embed_youtube');

?>