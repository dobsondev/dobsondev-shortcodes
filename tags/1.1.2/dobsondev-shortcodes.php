<?php
/**
 * Plugin Name: DobsonDev Shortcodes
 * Plugin URI: http://dobsondev.com/portfolio/dobsondev-shortcodes/
 * Description: A collection of helpful shortcodes.
 * Version: 1.1.2
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


/* Define our text domain for the plugin */
define( 'DOBSONDEV_SHRTCODE_TEXTDOMAIN',  'dobsondev-shortcodes' );

/* Include Parsedown for Markdown Conversion */
include 'libs/Parsedown.php';


/* Enqueue the Style Sheet */
function dobsondev_shrtcode_enqueue_scripts() {
  wp_enqueue_style( 'dobsondev-shortcodes', plugins_url( 'dobsondev-shortcodes.css' , __FILE__ ) );
  wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
  wp_enqueue_script( 'dobsondev-shortcodes-js', plugins_url( 'dobsondev-shortcodes.js', __FILE__ ), array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'dobsondev_shrtcode_enqueue_scripts' );


/* Adds a shortcode for displaying PDF's Inline */
function dobsondev_shrtcode_embed_PDF($atts) {
  extract(shortcode_atts(array(
    'source' => "Invalid Source",
    'width' => "100%",
    'height' => "600",
  ), $atts));
  if ($source == "http://yoursite.com/path-to-the-pdf.pdf") {
    $source = "Invalid Source";
  }
  if ($width == "###" || $height == "###") {
    $width = "100%";
    $height = "600";
  }
  $source_headers = @get_headers($source);
  if ( strpos($source_headers[0], '404 Not Found') || $source == "Invalid Source" ) {
    return '<p> Invalid PDF source. Please check your PDF source. </p>';
  } else {
    $output = '<div class="dobdev-pdf-container">';
    $output .= '<object width="' . $width . '" height="' . $height . '" type="application/pdf" data="' . $source . '"></object>';
    $output .= '</div><!-- END .dobdev-pdf-container -->';

    return $output;
  }
}
add_shortcode('embedPDF', 'dobsondev_shrtcode_embed_PDF');


/* Adds a shortcode for displaying GitHub Gists */
function dobsondev_shrtcode_create_github_gist($atts) {
  extract(shortcode_atts(array(
    'source' => "Invalid Source",
  ), $atts));
  if ($source == "http://gist.github.com/your-account/gist-id") {
    $source = "Invalid Source";
  }
  $source_headers = @get_headers($source);
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid GitHub Gist source. Please check your source. </p>';
  } else {
    return '<script src="' . $source . '.js"></script>';
  }
}
add_shortcode('embedGist', 'dobsondev_shrtcode_create_github_gist');

/* Adds a shortcode for displaying GitHub README onto a page */
function dobsondev_shrtcode_create_github_readme($atts) {
  extract(shortcode_atts(array(
    'owner' => "NULL",
    'repo' => "NULL",
  ), $atts));
  if ($owner == "NULL" || $repo == "NULL") {
    return '<p> Please Enter a Owner and Repo for the embedGitHubReadme ShortCode. </p>';
  } else {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'https://api.github.com/repos/' . $owner . '/' . $repo . '/readme',
      CURLOPT_USERAGENT => $repo,
      CURLOPT_HEADER => false
    ));
    $response = curl_exec($curl);
    // var_dump($response);
    $response_array = json_decode($response);
    // var_dump($response_array);
    $parsedown = new Parsedown();
    return $parsedown->text(base64_decode($response_array->content));
  }
}
add_shortcode('embedGitHubReadme', 'dobsondev_shrtcode_create_github_readme');


/* Adds a shortcode for displaying GitHub README onto a page */
function dobsondev_shrtcode_create_github_file_contents($atts) {
  extract(shortcode_atts(array(
    'owner' => "NULL",
    'repo' => "NULL",
    'path' => "NULL",
    'markdown' => "no",
  ), $atts));
  if ($owner == "NULL" || $repo == "NULL" || $path == "NULL") {
    return '<p> Please Enter a Owner, Repo and Path for the embedGitHubReadme ShortCode. </p>';
  } else {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'https://api.github.com/repos/' . $owner . '/' . $repo . '/contents/' . $path,
      CURLOPT_USERAGENT => $repo,
      CURLOPT_HEADER => false
    ));
    $response = curl_exec($curl);
    // var_dump($response);
    $response_array = json_decode($response);
    // var_dump($response_array);
    if (strcasecmp($markdown, "yes") == 0) {
      $parsedown = new Parsedown();
      return $parsedown->text(base64_decode($response_array->content));
    } else {
      return base64_decode($response_array->content);
    }
  }
}
add_shortcode('embedGitHubContent', 'dobsondev_shrtcode_create_github_file_contents');


/* Adds a shortcode to embed a Twitch Stream */
function dobsondev_shrtcode_embed_twitch($atts) {
  extract(shortcode_atts(array(
    'username' => "Invalid Username",
    'width' => "100%",
    'height' => "375",
  ), $atts));
  if ($username == "your-username") {
    $source = "Invalid Username";
  }
  if ($width == "###" || $height == "###") {
    $width = "100%";
    $height = "375";
  }
  $source_headers = @get_headers("http://twitch.tv/" . $username);
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid Twitch channel name. Please check your username and channel settings on Twitch to make '
    . 'sure they are setup correctly. </p>';
  } else {
    $output = '<div class="dobdev-twitch-container">';
    $output .= '<object type="application/x-shockwave-flash" height="' . $height . '" width="' . $width . '" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=' . $username . '" bgcolor="#000000">';
    $output .= '<param name="allowFullScreen" value="true" />';
    $output .= '<param name="allowScriptAccess" value="always" />';
    $output .= '<param name="allowNetworking" value="all" />';
    $output .= '<param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />';
    $output .= '<param name="flashvars" value="hostname=www.twitch.tv&channel=' . $username . '&auto_play=true&start_volume=25" />';
    $output .= '</object>';
    $output .= '</div><!-- END .dobdev-twitch-container -->';

    return $output;
  }
}
add_shortcode('embedTwitch', 'dobsondev_shrtcode_embed_twitch');


/* Adds a shortcode to embed a Twitch Stream's chat */
function dobsondev_shrtcode_embed_twitch_chat($atts) {
  extract(shortcode_atts(array(
    'username' => "Invalid Username",
    'width' => "350",
    'height' => "500",
  ), $atts));
  if ($username == "your-username") {
    $source = "Invalid Username";
  }
  if ($width == "###" || $height == "###") {
    $width = "620";
    $height = "378";
  }
  $source_headers = @get_headers("http://twitch.tv/chat/embed?channel=" . $username . "&popout_chat=true");
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid Twitch channel name. Please check your username and channel settings on Twitch to make '
    . 'sure they are setup correctly. </p>';
  } else {
    $output = '<div class="dobdev-twitch-chat-container">';
    $output .= '<iframe frameborder="0" scrolling="no" id="chat_embed" src="http://twitch.tv/chat/embed?channel=' . $username . '&popout_chat=true" height="' . $height . '" width="' . $width . '"></iframe>';
    $output .= '</div><!-- END .dobdev-twitch-chat-container -->';

    return $output;
  }
}
add_shortcode('embedTwitchChat', 'dobsondev_shrtcode_embed_twitch_chat');


/* Adds a shortcode to embed a YouTube video */
function dobsondev_shrtcode_embed_youtube($atts) {
  extract(shortcode_atts(array(
    'video' => "Invalid Video ID",
    'width' => "560",
    'height' => "315",
  ), $atts));
  if ($video == "video-id") {
    $source = "Invalid Video ID";
  }
  if ($width == "###" || $height == "###") {
    $width = "560";
    $height = "315";
  }
  $source_headers = @get_headers("http://youtube.com/watch?v=" . $video);
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid YouTube video ID. Please check your YouTube video ID. </p>';
  } else {
    $output = '<div class="dobdev-youtube-container">';
    $output .= '<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $video . '" frameborder="0" allowfullscreen></iframe>';
    $output .= '</div><!-- END .dobdev-youtube-container -->';

    return $output;
  }
}
add_shortcode('embedYouTube', 'dobsondev_shrtcode_embed_youtube');


/* Adds a shortcode for start tags for displaying inline code */
function dobsondev_shrtcode_inline_code_start($atts) {
  extract(shortcode_atts(array(
  ), $atts));
  return '<code class="dobdev-code-inline"><strong>';
}
add_shortcode('startCode', 'dobsondev_shrtcode_inline_code_start');


/* Adds a shortcode for end tags for displaying inline code */
function dobsondev_shrtcode_inline_code_end($atts) {
  extract(shortcode_atts(array(
  ), $atts));
  return '</strong></code>';
}
add_shortcode('endCode', 'dobsondev_shrtcode_inline_code_end');


/* Adds a shortcode for the start tags for displaying a code block */
function dobsondev_shrtcode_code_block_start($atts) {
  extract(shortcode_atts(array(
  ), $atts));
  return '<pre class="dobdev-code-block"><code>';
}
add_shortcode('startCodeBlock', 'dobsondev_shrtcode_code_block_start');


/* Adds a shortcode for the end tags for displaying a code block */
function dobsondev_shrtcode_code_block_end($atts) {
  extract(shortcode_atts(array(
  ), $atts));
  return '</code></pre>';
}
add_shortcode('endCodeBlock', 'dobsondev_shrtcode_code_block_end');


/* Adds a shortcode for displaying a simple CSS only button */
function dobsondev_shrtcode_make_button($atts) {
  extract(shortcode_atts(array(
    'text' => "Button",
    'color' => "red",
    'link' => "#",
  ), $atts));
  if ($color == "color") {
    $color = "red";
  }
  return '<a class="dobdev-' . $color . '-button" href="' . $link . '">' . $text . '</a>';
}
add_shortcode('button', 'dobsondev_shrtcode_make_button');


/* Adds a shortcode for displaying a simple user interaction info message */
function dobsondev_shrtcode_info_message($atts) {
  extract(shortcode_atts(array(
    'text' => "This is an info message.",
  ), $atts));
  if ($text == "text") {
    $text = "This is an info message.";
  }
  return '<div class="dobdev-info-msg"><i class="fa fa-info-circle"></i> ' . $text . '</div>';
}
add_shortcode('infoMessage', 'dobsondev_shrtcode_info_message');


/* Adds a shortcode for displaying a simple user interaction success message */
function dobsondev_shrtcode_success_message($atts) {
  extract(shortcode_atts(array(
    'text' => "This is an success message.",
  ), $atts));
  if ($text == "text") {
    $text = "This is an success message.";
  }
  return '<div class="dobdev-success-msg"><i class="fa fa-check"></i> ' . $text . '</div>';
}
add_shortcode('successMessage', 'dobsondev_shrtcode_success_message');


/* Adds a shortcode for displaying a simple user interaction warning message */
function dobsondev_shrtcode_warning_message($atts) {
  extract(shortcode_atts(array(
    'text' => "This is an warning message.",
  ), $atts));
  if ($text == "text") {
    $text = "This is an warning message.";
  }
  return '<div class="dobdev-warning-msg"><i class="fa fa-warning"></i> ' . $text . '</div>';
}
add_shortcode('warningMessage', 'dobsondev_shrtcode_warning_message');


/* Adds a shortcode for displaying a simple user interaction error message */
function dobsondev_shrtcode_error_message($atts) {
  extract(shortcode_atts(array(
    'text' => "This is an error message.",
  ), $atts));
  if ($text == "text") {
    $text = "This is an error message.";
  }
  return '<div class="dobdev-error-msg"><i class="fa fa-times-circle"></i> ' . $text . '</div>';
}
add_shortcode('errorMessage', 'dobsondev_shrtcode_error_message');


/* Adds a shortcode for displaying related posts based on their id */
function dobsondev_shrtcode_related_posts($atts) {
  extract(shortcode_atts(array(
    'posts' => "",
    'excerptLength' => 38,
  ), $atts));
  if ($posts == "post-slug") {
    $posts = "";
  }
  // Turn the passed in post IDs into an array and remove whitespace
  $posts_arr = array_map( 'trim', explode( ';', $posts ) );
  $output = '<div class="dobdev-related-posts">';
  $output .= '<h2> Related Posts </h2>';
  $output .= '<hr />';
  $count = 1;
  foreach ( $posts_arr as $post_id ) {
    $output .= '<div class="dobdev-related-posts-post" id="' . $count . '">';
    $output .= '<a href="' . get_permalink( $post_id ) . '">' . get_the_post_thumbnail( $post_id, array( 130, 130 ), array( 'class' => 'alignleft dobdev-related-posts-thumbnail' ) );
    $output .= '<h4 class="dobdev-related-posts-title">' . get_post_field( 'post_title', $post_id ) . '</h4>';
    $output .= '<p class="dobdev-related-posts-excerpt">' . dobsondev_shrtcode_get_excerpt_by_id( $post_id, $excerptLength ) . '</p>';
    $output .= '</a>';
    $output .= '</div><!-- END .dobdev-related-posts-post -->';
    $count ++;
  }
  $output .= '<br />';
  $output .= '</div><!-- END .dobdev-related-posts -->';

  return $output;
}
add_shortcode('relatedPosts', 'dobsondev_shrtcode_related_posts');


?>