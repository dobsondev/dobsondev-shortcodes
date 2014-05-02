DobsonDev Shortcodes
====================

A collection of helpful shortcodes for use with WordPress sites.

Copyright 2014  Alex Dobson  (email : [alex@dobsondev.com](mailto:alex@dobsondev.com))

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

# Description

A collection of helpful shortcodes that I use in my own work that I wanted to share with the WordPress Community. If you want to suggest any shortcodes please email me at [alex@dobsondev.com](mailto:alex@dobsondev.com).

## Shortcodes Included

* Embed PDFs - Embeds PDFs into pages rather than separate links.
* Embed [GitHub Gists](http://gist.github.com/) - Easily add GitHub gists to your site or blog.
* Embed [Twitch Stream](http://twitch.tv/) - Embeds a Twitch Stream into the page.
* Embed [Twitch Stream](http://twitch.tv/) Chat - Embeds the chat from a Twitch Stream into the page.
* Embed [YouTube Video](http://youtube.com/) - Embeds a YouTube Video into the page.

**Embed PDF**

[embedPDF source="http://yoursite.com/path-to-the-pdf.pdf" width="###" height="###"]

This Shortcode will embed a PDF into the page rather than making it a seperate link that must be clicked to be viewed. It is displayed in the browsers default PDF reader since it is embedded as an application. The source attribute is the URL of the PDF and is required. The width and height attribute will set the size of the embedded application, and are both optional. If they are not entered then the width is set to 100% and the height to 600.

**Embed GitHub Gists**

[embedGist source="http://gist.github.com/your-account/gist-id"]

This Shortcode will embed a GitHub Gist into the page. The Gist will be embedded in a little box that makes it easy to share code samples with other developers (or whoever you want to share them with). The source attribute is the URL to the Gist and is required.

**Embed Twitch Stream**

[embedTwitch username="your-username" width="###" height="###"]

This Shortcode will embed a Twitch stream into the page. The username attribute is the Twitch Stream's username, which can be found at the end of the URL of the stream. An example would be [http://twitch.tv/day9tv](http://twitch.tv/day9tv). The username for this stream is "day9tv", so that would be entered. The username is a required attribute. The width and height attributes will set the size of the embedded stream, and both are optional attributes. If they are not entered the width will default to 620 and the height will default to 378.

**Embed Twitch Stream Chat**

[embedTwitchChat username="your-username" width="###" height="###"]

This Shortcode will embed a Twitch stream's chat into the page. The username attribute is the Twitch Stream's username, which can be found at the end of the URL of the stream. An example would be [http://twitch.tv/day9tv](http://twitch.tv/day9tv). The username for this stream is "day9tv", so that would be entered. The username is a required attribute. The width and height attributes will set the size of the embedded chat, and both are optional attributes. If they are not entered the width will default to 350 and the height will default to 500.

**Embed YouTube Video**

[embedYouTube video="video-id" width="###" height="###"\]

This Shortcode will embed a YouTube video into the page. The video attribute is the YouTube video ID of the video you want to embed into the page. It can be found at the end of the URL on YouTube. For example, the video located at [https://www.youtube.com/watch?v=uCdfze1etec](https://www.youtube.com/watch?v=uCdfze1etec) has the video ID "uCdfze1etec". You will always find the video ID after the "watch?v=". The video attribute is required. The width and height attributes will set the size of the embedded video, and both are optional attributes. If they are not entered the width will default to 560 and the height will default to 315.

# Installation

1. Upload the entire dobsondev-shortcodes folder to the /wp-content/plugins/ directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

# Frequently Asked Questions

For more information about the shortcodes avaliable through the plugin please visit the plugin site. The site contains a description and usage information for each shortcode avaliable through the plugin.

* [Plugin Site](http://dobsondev.com/portfolio/dobsondev-shortcodes/)

If you have any shortcodes you want to suggest or to add to the plugin, please contact me at [alex@dobsondev.com](mailto:alex@dobsondev.com).

# Changelog

## 0.669

**New Features**

* Added a Stylesheet for the plugin

**Bug Fixes**

* Made the embedded YouTube videos responsive

## 0.668

**New Features**

* Added a Shortcode for embedding Twitch.tv stream chats on your site

**Bug Fixes**

* Added esc_url() to all URL sources for shortcodes

## 0.667

**New Features**

* Added a Shortcode for embedding Twitch.tv streams on your site
* Added a Shortcode for embedding YouTube videos on your site

**Changes**

* GitHub Gist Shortcode changed from \[github_gist source=""\] to \[embedGist source=""\]

**Bug Fixes**

* Refined method for checking HTTP Headers

## 0.666

* Initial Beta Release