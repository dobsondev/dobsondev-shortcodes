=== DobsonDev Shortcodes ===
Contributors: DobsonDev
Donate link: https://dobsondev.com/donate/
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl.html
Tags: dobsondev, shortcodes, pdf, portable document format, github gists, github, gists, twitch streams, twitch, twitch tv, twitch chat, YouTube video, YouTube, inline code, code snippets, code block, programming, code examples, button, buttons, css button, css buttons, button shortcode, buttons shortcodes, user interaction, user interaction messages, info message, information message, success message, warning message, error message, related posts, related posts shortcode, jquery, slideshow
Requires at least: 2.5
Tested up to: 4.0.1
Stable tag: 1.0

Add a collection of helpful shortcodes to your site.

== Description ==

A collection of helpful shortcodes that I use in my own work that I wanted to share with the WordPress Community. If you want to suggest any shortcodes please email me at [alex@dobsondev.com](mailto:alex@dobsondev.com).

= Shortcodes Included =

* Embed PDFs - Embeds PDFs into pages rather than separate links.
* Embed [GitHub Gists](http://gist.github.com/) - Easily add GitHub gists to your site or blog.
* Embed [Twitch Stream](http://twitch.tv/) - Embeds a Twitch Stream into the page.
* Embed [Twitch Stream](http://twitch.tv/) Chat - Embeds the chat from a Twitch Stream into the page.
* Embed [YouTube Video](http://youtube.com/) - Embeds a YouTube Video into the page.
* Inline Code - Displays inline code snippets that are visually different than the body text.
* Code Block - Displays a simple code block for simple, small pieces of code.
* Button - Displays a purely CSS button with choice of color, text and link.
* User Interaction Messages - Displays a message with appropriate color that you can use to notify users of how their interaction is working.
* Related Posts - Displays manually entered related posts on your post's page that cycle through in a little slideshow. Only for use with posts, NOT pages!

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

[embedYouTube video="video-id" width="###" height="###"]

This Shortcode will embed a YouTube video into the page. The video attribute is the YouTube video ID of the video you want to embed into the page. It can be found at the end of the URL on YouTube. For example, the video located at [https://www.youtube.com/watch?v=uCdfze1etec](https://www.youtube.com/watch?v=uCdfze1etec) has the video ID "uCdfze1etec". You will always find the video ID after the "watch?v=". The video attribute is required. The width and height attributes will set the size of the embedded video, and both are optional attributes. If they are not entered the width will default to 560 and the height will default to 315.

**Inline Code Snippets**

[startCode]

This shortcode will create the start tags for an inline code snippet which will then be ended using the [endCode] shortcode. If you use these two together you can create small inline code samples that look great, are easy to copy, and distinguish themselves from the rest of your text content in appearance. These make it easy to include code snippets without having to switch to the HTML editor in WordPress.

[endCode]

This shortcode will create the end tags for the inline code snippet started by [startCode]. If you use these two together you can create small inline code samples that look great, are esay to copy, and distinguish themselves from the rest of your text content in appearance. These make it easy to include code snippets without having to switch to the HTML editor in WordPress.

**Code Blocks**

[startCodeBlock]

This shortcode will create the start tags for a code block which will then be ended using the [endCodeBlock] shortcode. If you use these two together you can create small, simple code blocks that have a black background with white text, which is the common convention for code blocks. This is great for showing Terminal commands or very small code snippets (I recommend using the embed GitHub Gists shortcode for longer code samples).

[endCodeBlock]

This shortcode will create the end tags for the code snippet started by [startCode]. If you use these two together you can create small, simple code blocks that have a black background with white text, which is the common convention. This is great for showing Terminal commands or very small code snippets (I recommend using the embed GitHub Gists shortcode for longer code samples).

**Buttons**

[button text="buttonText" color="color" link="#"]

This shortcode will create a purely CSS button where ever you place it. The text attribute is the text that will appear within the button. The color atrribute defines what color will show - the choices for color are red, blue, green, orange, purple, and turquoise. The link attribute is what link the user wants to redirect to when the button is clicked. If you do not want a redirect on the button click, just use a "#" and the button will do nothing when clicked.

**User Interaction Messages**

[infoMessage text="your-message"]
[successMessage text="your-message"]
[warningMessage text="your-message"]
[errorMessage text="your-message"]

These shortcodes will display a message with an appropriate color that will notify users of how their interaction is working. The color scheme follows that of many other websites - blue is for information, green is for success, yellow is a warning and red signifies an error.

**Related Posts**

[relatedPosts posts="1stPostID; 2ndPostID; 3rdPostID"]
eg. [relatedPost post="1; 2; 3; 4"]

This shortcode will create a small slideshow of related posts wherever you put it. Note that you must enter the post ID's yourself, as this shortcode will not automatically index and display related posts for you. Although this is more work it has a significantly smaller load time than plugins which do automatically index them for you. I would recommend this to people who run their own personal blogs with fewer articles. The slideshow is made using only CSS and jQuery.

Please note that this shortcode should only be used on posts, NOT pages. It will cause pages to hang.

== Installation ==

1. Upload the entire dobsondev-shortcodes folder to the /wp-content/plugins/ directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

For more information about the shortcodes avaliable through the plugin please visit the plugin site. The site contains a description and usage information for each shortcode avaliable through the plugin.

* [Plugin Site](http://dobsondev.com/portfolio/dobsondev-shortcodes/)

If you have any shortcodes you want to suggest or to add to the plugin, please contact me at [alex@dobsondev.com](mailto:alex@dobsondev.com).

== Changelog ==

= - 1.0 - =

**New Features**

* Full 1.0 Release - I feel there is enough content now to justify it
* Added shortcode for displaying a related posts slideshow

= - 0.674 - =

**New Features**

* Added shortcodes for displaying user interaction messages

**Bug Fixes**

* Renamed CSS classes to ensure no clashing happens between this plugin and other style sheets
* Renamed functions to ensure no clashing happens if you use something else I created (I originally just used my last name to start functions, but switch it to be specific for this plugin)

= - 0.673 - =

**New Features**

* Added a shortcode for displaying CSS buttons

= - 0.672 - =

**Bug Fixes**

* Fixed a bug that would cause the PDF shortcode to redirect to www.ww.38.yoursite.com/path-to-the-pdf.pdf if the shortcode was copied as [embedPDF source="http://yoursite.com/path-to-the-pdf.pdf" width="###" height="###"]
* Fixed the same possibly bug mentioned above with the GitHub Gists, Twitch Stream, Twitch Chat and YouTube Video embeds

= - 0.671 - =

**New Features**

* Tested up to WordPress 4.0
* Added a shortcode for displaying simple code blocks

**Bug Fixes**

* Renamed 'youtube-container' CSS class to 'dobdev_youtube_container' in order to ensure uniqueness
* Added default CSS for the embedded inline code

= - 0.670 - =

**New Features**

* Added shortcodes for inline code snippets

= - 0.669 - =

**New Features**

* Added a Stylesheet for the plugin

**Bug Fixes**

* Made the embedded YouTube videos responsive

= - 0.668 - =

**New Features**

* Added a Shortcode for embedding Twitch.tv stream chats on your site

**Bug Fixes**

* Added esc_url() to all URL sources for shortcodes

= - 0.667 - =

**New Features**

* Added a Shortcode for embedding Twitch.tv streams on your site
* Added a Shortcode for embedding YouTube videos on your site

**Changes**

* GitHub Gist Shortcode changed from \[github_gist source=""\] to \[embedGist source=""\]

**Bug Fixes**

* Refined method for checking HTTP Headers

= - 0.666 - =

* Initial Beta Release
