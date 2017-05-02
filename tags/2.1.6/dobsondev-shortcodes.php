<?php
/**
 * Plugin Name: DobsonDev Shortcodes
 * Plugin URI: http://dobsondev.com/portfolio/dobsondev-shortcodes/
 * Description: A collection of helpful shortcodes.
 * Version: 2.1.6
 * Author: Alex Dobson
 * Author URI: http://dobsondev.com/
 * License: GPLv2
 *
 * Copyright 2016  Alex Dobson  (email : alex@dobsondev.com)
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
/* Define our version number for the plugin */
define( 'DOBSONDEV_SHRTCODE_VER',  '2.0.0' );


/* Include Parsedown for Markdown Conversion */
include 'libs/Parsedown.php';


/* Enqueue the scripts and style sheets needed for the shortcodes  */
function dobsondev_shrtcode_enqueue_scripts() {
  wp_enqueue_style( 'dobsondev-shortcodes-css', plugins_url( '/css/dobsondev-shortcodes.min.css' , __FILE__ ) );
  wp_enqueue_style( 'dobsondev-shortcodes-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
  wp_enqueue_script( 'dobsondev-shortcodes-js', plugins_url( '/js/dobsondev-shortcodes.min.js', __FILE__ ), array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'dobsondev_shrtcode_enqueue_scripts' );


/* Enqueue the scripts and style sheets needed for the TinyMCE plugin */
function dobsondev_shrtcode_tinymce_enqueue_scripts() {
  wp_enqueue_style( 'dobsondev-shortcodes-css', plugins_url( '/css/dobsondev-shortcodes.min.css' , __FILE__ ) );
  wp_enqueue_style( 'dobsondev-shortcodes-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
  wp_enqueue_script( 'dobsondev-shortcodes-tinymce-plugin', plugins_url( 'js/tinymce-plugin.min.js', __FILE__ ), array( 'jquery' ) );
}
add_action( 'admin_enqueue_scripts', 'dobsondev_shrtcode_tinymce_enqueue_scripts' );


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
    'cache_id' => "NULL",
    'insecure' => "NULL",
  ), $atts));
  if ($owner == "NULL" || $repo == "NULL") {
    return '<p> Please Enter a Owner and Repo for the embedGitHubReadme ShortCode. </p>';
  } else {
    // check to see if we have a cached transient stored
    if ( false === ( $readme_transient = get_transient( 'ddghr-' . md5( $owner . $repo . $cache_id ) ) ) ) {
      // we do not have a transient stored so we have to make the API call
      $curl = curl_init();
      if ( $insecure == "true" || $insecure == "TRUE" || $insecure == "yes" || $insecure == "YES" ) {
        // we have an insecure connection so we have to let cURL know that
        curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => 'https://api.github.com/repos/' . $owner . '/' . $repo . '/readme',
          CURLOPT_USERAGENT => $repo,
          CURLOPT_HEADER => false,
          CURLOPT_SSL_VERIFYPEER => false
        ));
      } else {
        // we are using the regular secure connection
        curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => 'https://api.github.com/repos/' . $owner . '/' . $repo . '/readme',
          CURLOPT_USERAGENT => $repo,
          CURLOPT_HEADER => false
        ));
      }
      $response = curl_exec($curl);
      // var_dump($response);
      if ( FALSE === $response ) {
        $output_error = '<strong>cURL ERROR</strong>: <span style="color: red">' . curl_error($curl) . '</span><br />';
        $output_error .= '<strong>Error #</strong>: <span style="color: red">' . curl_errno($curl) . '</span><br /><br />';
        $output_error .= 'If your error reads something like "SSL certificate problem: unable to get local issuer certificate" then please add the <strong>insecure="true"</strong> attribute to your shortcode.';
        return $output_error;
      }
      $response_array = json_decode($response);
      // var_dump($response_array);
      $parsedown = new Parsedown();
      $output_readme = $parsedown->text(base64_decode($response_array->content));
      if ( $cache_id !== "NULL" || !empty( $cache_id ) ) {
        // set the transient so we can use it later for faster loading times
        set_transient(  'ddghr-' . md5( $owner . $repo . $cache_id ), $output_readme, DAY_IN_SECONDS );
      }
      // var_dump("DID NOT get Transient");
      return $output_readme;
    }
    // the transient was found so we will use it
    return $readme_transient;
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
    'cache_id' => "NULL",
    'insecure' => "NULL",
  ), $atts));
  if ($owner == "NULL" || $repo == "NULL" || $path == "NULL") {
    return '<p> Please Enter a Owner, Repo and Path for the embedGitHubReadme ShortCode. </p>';
  } else {
    // check to see if we have a cached transient stored
    if ( false === ( $githubfile_transient = get_transient( 'ddghf-' . md5( $owner . $repo . $path . $cache_id ) ) ) ) {
      // we do not have a transient stored so we have to make the API call
      $curl = curl_init();
      if ( $insecure == "true" || $insecure == "TRUE" || $insecure == "yes" || $insecure == "YES" ) {
        // we have an insecure connection so we have to let cURL know that
        curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => 'https://api.github.com/repos/' . $owner . '/' . $repo . '/contents/' . $path,
          CURLOPT_USERAGENT => $repo,
          CURLOPT_HEADER => false,
          CURLOPT_SSL_VERIFYPEER => false
        ));
      } else {
        // we are using the regular secure connection
        curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => 'https://api.github.com/repos/' . $owner . '/' . $repo . '/contents/' . $path,
          CURLOPT_USERAGENT => $repo,
          CURLOPT_HEADER => false
        ));
      }
      $response = curl_exec($curl);
      // var_dump($response);
      if ( FALSE === $response ) {
        $output_error = '<strong>cURL ERROR</strong>: <span style="color: red">' . curl_error($curl) . '</span><br />';
        $output_error .= '<strong>Error #</strong>: <span style="color: red">' . curl_errno($curl) . '</span><br /><br />';
        $output_error .= 'If your error reads something like "SSL certificate problem: unable to get local issuer certificate" then please add the <strong>insecure="true"</strong> attribute to your shortcode.';
        return $output_error;
      }
      $response_array = json_decode($response);
      // var_dump($response_array);
      if (strcasecmp($markdown, "yes") == 0 || strcasecmp($markdown, "true") == 0) {
        $parsedown = new Parsedown();
        $output_md_file = $parsedown->text(base64_decode($response_array->content));
        if ( $cache_id !== "NULL" || !empty( $cache_id ) ) {
          // set the transient if the cache_id is set so we can use it later for faster loading time
          set_transient(  'ddghf-' . md5( $owner . $repo . $path . $cache_id ), $output_md_file, DAY_IN_SECONDS );
        }
        // var_dump("DID NOT get Transient");
        return $output_md_file;
      } else {
        $output_file = nl2br(base64_decode($response_array->content));
        if ( $cache_id !== "NULL" || !empty( $cache_id ) ) {
          // set the transient if the cache_id is set so we can use it later for faster loading time
          set_transient( 'ddghf-' . md5( $owner . $repo . $path . $cache_id ), $output_file, DAY_IN_SECONDS );
        }
        return $output_file;
      }
    }
    // the transient was found so we will use it
    return $githubfile_transient;
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
    $output = '<br />';
    $output .= '<div class="dobdev-youtube-container">';
    $output .= '<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $video . '" frameborder="0" allowfullscreen></iframe>';
    $output .= '</div><!-- END .dobdev-youtube-container -->';
    $output .= '<br />';

    return $output;
  }
}
add_shortcode('embedYouTube', 'dobsondev_shrtcode_embed_youtube');


/* Adds a shortcode to embed a Vimeo video */
function dobsondev_shrtcode_embed_vimeo($atts) {
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
  $source_headers = @get_headers("https://vimeo.com/" . $video);
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid Vimeo video ID. Please check your Vimeo video ID. </p>';
  } else {
    $output = '<br />';
    $output .= '<div class="dobdev-vimeo-container">';
    $output .= '<iframe width="' . $width . '" height="' . $height . '" src="https://player.vimeo.com/video/' . $video . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    $output .= '</div><!-- END .dobdev-vimeo-container -->';
    $output .= '<br />';

    return $output;
  }
}
add_shortcode('embedVimeo', 'dobsondev_shrtcode_embed_vimeo');


/* Adds a shortcode for displaying Kodi addon download link onto a page */
function dobsondev_shrtcode_kodi_addon_download($atts) {
  extract(shortcode_atts(array(
  	'addonid' => "NULL",
  	'addonxmlurl' => "NULL",
    'repoprefix' => ""
  ), $atts));
  if ( $addonid == "NULL" || $addonxmlurl == "NULL" ) {
    return '<p> Please Enter a AddonID and the path to the repos addon.xml. </p>';
  } else {
    $curl = curl_init();
  	curl_setopt_array($curl, array(
  	  CURLOPT_RETURNTRANSFER => 1,
  	  CURLOPT_URL => $addonxmlurl,
  	  CURLOPT_USERAGENT => 'Repo Info Grabber 1.0',
  	  CURLOPT_HEADER => false,
  	  CURLOPT_SSL_VERIFYPEER => false
  	));
    $response = curl_exec($curl);
    // var_dump($response);

    if ( FALSE === $response ) {
      $output_error = '<strong>cURL ERROR</strong>: <span style="color: red">' . curl_error($curl) . '</span><br />';
      $output_error .= '<strong>Error #</strong>: <span style="color: red">' . curl_errno($curl) . '</span><br /><br />';
      $output_error .= 'If your error reads something like "SSL certificate problem: unable to get local issuer certificate" then please add the <strong>insecure="true"</strong> attribute to your shortcode.';
      return $output_error;
    }

    // HIER MUSS NUN XML GEPARST WERDEN
    // this XML must be parse by this point
    $repo_addonxml = new SimpleXMLElement($response);
    $repobaseurl = str_replace("addons.xml","",$addonxmlurl);
    foreach ($repo_addonxml->addon as $addon) {
      if ( $addon['id'] == $addonid ) {
        #$fileurl = $repobaseurl.$addon['id']."/".$addon['id']."-".$addon['version'].".zip";
        if ( $repoprefix == "" ) {
          $fileurl = $repobaseurl.$addon['id']."/".$addon['id']."-".$addon['version'].".zip";
        } else {
          $fileurl = $repobaseurl.$repoprefix."/".$addon['id']."/".$addon['id']."-".$addon['version'].".zip";
        }
        $outtxt = "<a href=\"".$fileurl."\">".$addon['id']."-".$addon['version'].".zip</a>";
      }
    }
    return $outtxt;
  }
}
add_shortcode('embedKodiAddonDownload', 'dobsondev_shrtcode_kodi_addon_download');


/* Adds a shortcode for displaying Kodi addon info table onto a page */
function dobsondev_shrtcode_kodi_addon_info($atts) {
  extract(shortcode_atts(array(
    'addonid' => "NULL",
    'addonxmlurl' => "NULL",
    'repoprefix' => ""
  ), $atts));
  if ($addonid == "NULL" || $addonxmlurl == "NULL") {
    return '<p> Please Enter a AddonID and the path to the repos addon.xml. </p>';
  } else {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $addonxmlurl,
      CURLOPT_USERAGENT => 'Repo Info Grabber 1.0',
      CURLOPT_HEADER => false,
      CURLOPT_SSL_VERIFYPEER => false
    ));
    $response = curl_exec($curl);
    // var_dump($response);

    if ( FALSE === $response ) {
      $output_error = '<strong>cURL ERROR</strong>: <span style="color: red">' . curl_error($curl) . '</span><br />';
      $output_error .= '<strong>Error #</strong>: <span style="color: red">' . curl_errno($curl) . '</span><br /><br />';
      $output_error .= 'If your error reads something like "SSL certificate problem: unable to get local issuer certificate" then please add the <strong>insecure="true"</strong> attribute to your shortcode.';
      return $output_error;
    }

    $repo_addonxml = new SimpleXMLElement($response);
    $repobaseurl = str_replace("addons.xml","",$addonxmlurl);
    foreach ($repo_addonxml->addon as $addon) {
      if ( $addon['id'] == $addonid ) {
        if ( $repoprefix == "" ) {
          $fileurl = $repobaseurl.$addon['id']."/".$addon['id']."-".$addon['version'].".zip";
          $icon = $repobaseurl.$addon['id']."/icon.png";
        } else {
          $fileurl = $repobaseurl.$repoprefix."/".$addon['id']."/".$addon['id']."-".$addon['version'].".zip";
          $icon = $repobaseurl.$repoprefix."/".$addon['id']."/icon.png";
        }
        $outtxt =
          '<table style="height: 180px; width: 501.25px;">'.
          '<tbody>'.
          '<tr>'.
          '<td style="width: 186px; text-align: justify; vertical-align: text-top;"><img id="__wp-temp-img-id" title="" src="'.$icon.'" alt="" width="176" height="176" /></td>'.
          '<td style="width: 296.25px;">'.
          '<table style="height: 180px; width: 300.117px;">'.
          '<tbody>'.
          '<tr>'.
          '<td style="width: 116px;"><strong>Addon:</strong></td>'.
          '<td style="width: 168.117px;">'.$addon['name'].'</td>'.
          '</tr>'.
          '<tr>'.
          '<td style="width: 116px;"><strong>Version:</strong></td>'.
          '<td style="width: 168.117px;">'.$addon['version'].'</td>'.
          '</tr>'.
          '<tr>'.
          '<td style="width: 116px;"><strong>Ersteller:</strong></td>'.
          '<td style="width: 168.117px;">'.$addon['provider-name'].'</td>'.
          '</tr>'.
          '<tr>'.
          '<td style="width: 116px;"><strong>Download:</strong></td>'.
          '<td style="width: 168.117px;"><a href="'.$fileurl.'">'.$addon['id'].'-'.$addon['version'].'.zip</a></td>'.
          '</tr>'.
          '</tbody>'.
          '</table>'.
          '</td>'.
          '</tr>'.
          '</tbody>'.
          '</table>';
      }
    }
    return $outtxt;
  }
}
add_shortcode('embedKodiAddonInfo', 'dobsondev_shrtcode_kodi_addon_info');



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
  return '<div class="dobdev-info-msg"><i class="fa fa-info-circle dobsondev-shortcodes"></i> ' . $text . '</div>';
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
  return '<div class="dobdev-success-msg"><i class="fa fa-check dobsondev-shortcodes"></i> ' . $text . '</div>';
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
  return '<div class="dobdev-warning-msg"><i class="fa fa-warning dobsondev-shortcodes"></i> ' . $text . '</div>';
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
  return '<div class="dobdev-error-msg"><i class="fa fa-times-circle dobsondev-shortcodes"></i> ' . $text . '</div>';
}
add_shortcode('errorMessage', 'dobsondev_shrtcode_error_message');


/*
  Utility function to get the post by ID for the dobsondev_shrtcode_related_posts function
  http://wordpress.stackexchange.com/questions/26729/get-excerpt-using-get-the-excerpt-outside-a-loop
*/
function dobsondev_shrtcode_get_excerpt_by_id( $id, $length ){
  $post = get_post($id);                            // Gets post ID
  $excerpt = $post->post_content;                    // Gets post_content to be used as a basis for the excerpt
  $excerpt = strip_tags(strip_shortcodes($excerpt)); // Strips tags and images
  $words = explode(' ', $excerpt, $length + 1);

  if(count($words) > $length) :
    array_pop($words);
    array_push($words, '…');
    $excerpt = implode(' ', $words);
  endif;

  return $excerpt;
}
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


/* Adds a shortcode for displaying a menu */
function dobsondev_shrtcode_menu($atts) {
  extract(shortcode_atts(array(
    'menu'            => '',
    'container'       => 'div',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'menu',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'depth'           => 0,
    'walker'          => '',
    'theme_location'  => ''
  ), $atts));

  return wp_nav_menu( array(
    'menu'            => $menu,
    'container'       => $container,
    'container_class' => $container_class,
    'container_id'    => $container_id,
    'menu_class'      => $menu_class,
    'menu_id'         => $menu_id,
    'echo'            => false,
    'fallback_cb'     => $fallback_cb,
    'before'          => $before,
    'after'           => $after,
    'link_before'     => $link_before,
    'link_after'      => $link_after,
    'depth'           => $depth,
    'walker'          => $walker,
    'theme_location'  => $theme_location
  ));
}
add_shortcode('menu', 'dobsondev_shrtcode_menu');


/* Adds a shortcode for displaying a simple <div> with clear both */
function dobsondev_shrtcode_clear_div($atts) {
  extract( shortcode_atts( array(), $atts ) );
  return '<div style="clear: both;"></div>';
}
add_shortcode('divClear', 'dobsondev_shrtcode_clear_div');


/* Adds a Shortcode for displaying a social share section */
function dobsondev_shrtcode_social_share($atts) {
  extract( shortcode_atts( array(), $atts ) );
  return '
    <div class="dobdev-social-share">
      <!-- Twitter -->
      <a href="http://twitter.com/share?url=' . get_permalink() . '" target="_blank" class="share-btn twitter">
          <i class="fa fa-twitter"></i>
      </a>

      <!-- Google Plus -->
      <a href="https://plus.google.com/share?url=' . get_permalink() . '" target="_blank" class="share-btn google-plus">
          <i class="fa fa-google-plus"></i>
      </a>

      <!-- Facebook -->
      <a href="http://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '" target="_blank" class="share-btn facebook">
          <i class="fa fa-facebook"></i>
      </a>

      <!-- LinkedIn -->
      <a href="http://www.linkedin.com/shareArticle?url=' . get_permalink() . '" target="_blank" class="share-btn linkedin">
          <i class="fa fa-linkedin"></i>
      </a>
    </div>
  ';
}
add_shortcode('socialShare', 'dobsondev_shrtcode_social_share');


/**
 *
 * The following section is where all the code required for the TinyMCE Plugin that adds the
 * DobsonDev Shortcodes editor button.
 *
 */


/* Our main function that adds the TinyMCE plugin where it needs to go */
function dobsondev_shrtcode_tinymce_main() {
  global $typenow;
  // check the current user's permissions
  if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
    return;
  }
  // verify the post type that the user will work with
  if ( !in_array( $typenow, array( 'post', 'page' ) ) ) {
    return;
  }
  // check if WYSIWYG is enabled
  if ( get_user_option('rich_editing') == 'true' ) {
    add_filter( 'mce_external_plugins', 'dobsondev_shrtcode_add_tinymce_plugin' );
    add_filter( 'mce_buttons_2', 'dobsondev_shrtcode_register_tinymce_buttons' );
  }
}
add_action('admin_head', 'dobsondev_shrtcode_tinymce_main');


/* Adds the DobsonDev Shortcodes TinyMCE plugin to the plugins that are loaded into TinyMCE editor */
function dobsondev_shrtcode_add_tinymce_plugin( $plugin_array ) {
  $plugin_array['dobsondev_shrtcode_tinymce'] = plugins_url( '/js/tinymce-plugin.js', __FILE__ );
  return $plugin_array;
}


/* Registers and adds our custom DobsonDev Shortcode button from the TinyMCE plugin into the TinyMCE editor */
function dobsondev_shrtcode_register_tinymce_buttons( $buttons ) {
  array_push( $buttons, 'dobsondev_shrtcode_tinymce_button' );
  return $buttons;
}


?>
