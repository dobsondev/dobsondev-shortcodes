=== DobsonDev Shortcodes ===
Contributors: DobsonDev
Donate link: https://dobsondev.com/donate/
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl.html
Tags: dobsondev, shortcodes, pdf, portable document format, github gists, github, gists, github readme, github project readme, github repo readme, github file contents, twitch streams, twitch, twitch tv, twitch chat, YouTube video, YouTube, inline code, code snippets, code block, programming, code examples, button, buttons, css button, css buttons, button shortcode, buttons shortcodes, user interaction, user interaction messages, info message, information message, success message, warning message, error message, related posts, related posts shortcode, jquery, jquery related posts, related posts slideshow, tinymce, tinymce plugin, user interface
Requires at least: 2.5
Tested up to: 4.7.4
Stable tag: 2.1.6

Add a collection of helpful shortcodes to your site.

== Description ==

A collection of helpful shortcodes that I use in my own work that I wanted to share with the WordPress Community. If you want to suggest any shortcodes please email me at [alex@dobsondev.com](mailto:alex@dobsondev.com). Please download from the [Offical WordPress Repository](https://wordpress.org/plugins/dobsondev-shortcodes/) for easiest installation. If you would like to donate please [click here](http://dobsondev.com/donate/).

As of version 2.0.0 DobsonDev Shortcodes includes a TinyMCE Plugin that provides a button and user interface for adding the shortcodes. The button is the DobsonDev Shortcodes logo and if you click on it you will see a dropdown menu with all of the different shortcodes available to you. Click on the shortcode you want and a popup will appear (for the most part - three of the shortcodes just appear in the editor and you can fill their content in) containing the different attributes for that shortcode. The required attributes are marked with stars and you must fill them in. The other optional attributes can either be filled in to include them or left blank to leave them out.

= Shortcodes Included =

* Embed PDFs - Embeds PDFs into pages rather than separate links.
* Embed [GitHub Gists](http://gist.github.com/) - Easily add GitHub gists to your site or blog.
* Embed [GitHub Repo Readme](http://github.com/) - Easily add the content from your GitHub repository README.md file.
* Embed [GitHub Repo File Contents](http://github.com/) - Easily add the content from a file from any GitHub repository.
* Embed [Twitch Stream](http://twitch.tv/) - Embeds a Twitch Stream into the page.
* Embed [Twitch Stream](http://twitch.tv/) Chat - Embeds the chat from a Twitch Stream into the page.
* Embed [YouTube Video](http://youtube.com/) - Embeds a YouTube Video into the page.
* Embed [Vimeo Video](https://vimeo.com/) - Embeds a Vimeo Video into the page.
* Inline Code - Displays inline code snippets that are visually different than the body text.
* Code Block - Displays a simple code block for simple, small pieces of code.
* Button - Displays a purely CSS button with choice of color, text and link.
* User Interaction Messages - Displays a message with appropriate color that you can use to notify users of how their interaction is working.
* Related Posts - Displays manually entered related posts on your post's page that cycle through in a little slideshow. Only for use with posts, NOT pages!
* Social Share - Displays a section for sharing your page on social media, shows links for Twitter, Facebook, Google Plus and Linkedin.

**Embed PDF**

[embedPDF source="http://yoursite.com/path-to-the-pdf.pdf" width="###" height="###"]

This Shortcode will embed a PDF into the page rather than making it a seperate link that must be clicked to be viewed. It is displayed in the browsers default PDF reader since it is embedded as an application. The source attribute is the URL of the PDF and is required. The width and height attribute will set the size of the embedded application, and are both optional. If they are not entered then the width is set to 100% and the height to 600.

Please note that setting the width to "auto" will not work. Rather, please set the width to "100%" to get the same effect. If you are looking to add your own custom CSS to the container around the PDF embed, the class is "div.dobdev-pdf-container". This should only be done by someone experienced using CSS, otherwise the results could cause harm to the layout of your site.

**Embed GitHub Gists**

[embedGist source="http://gist.github.com/your-account/gist-id"]

This Shortcode will embed a GitHub Gist into the page. The Gist will be embedded in a little box that makes it easy to share code samples with other developers (or whoever you want to share them with). The source attribute is the URL to the Gist and is required.

If you are looking to add some custom CSS to the Gists, they are automatically put into "div.gist" by GitHub. Use that class when doing any CSS changes. This should only be done by someone experienced using CSS, otherwise the results could cause harm to the layout of your site.

**Embed GitHub Repo Readme**

[embedGitHubReadme owner="Owner_of_Repo" repo="Repo_Name" cache_id="id"]

This shortcode will display the contents of any GitHub repository's README file. The markdown will displayed as HTML output onto the page. This shortcode uses GitHub API calls to ensure that as you update you README file the output from this shortcode will also update.

The style will match that of your default page style, but if you want to change the style just wrap the shortcode inside of a div and then edit as much as the style as you want.

If you want to take advantage of WordPress' transient API for caching, simply enter an ID for the cache_id argument. Note that this ID can be anything other than "NULL", it doesn't necessarily have to be a number. Once entered this will cause the shortcode to cache the results of the API call for 24 hours. This means the shortcode will use those cached results and speed up the load times for 24 hours, at which point it will then call the API again to get any updates and use those cached results for another 24 hours.

If you're receiving an error similar to "SSL certificate : unable to get local issuer certificate" then please add the attribute insecure="true" to your shortcode. This stops cURL from verifying the peer's certificate which may be required in some cases depending on your server. If you would rather you can instead sdd the root CA (the CA signing the server certificate) to etc/ssl/certs/ca-certificates.crt which will allow secure connections to work. By default the shortcode will use secure connections.

**Embed GitHub Repo File Contents**

[embedGitHubContent owner="Owner_of_Repo" repo="Repo_Name" path="Path_to_File" markdown="Yes/No"  cache_id="id"]

This shortcode will display the contents of a file from any GitHub repository. You must include the Owner of the repository, the repository name and the path to the file. Optionally, if the file is a markdown file you can put markdown="yes" and the plugin will output the markdown as HTML onto the page. If you give the shortcode a path to a folder rather than to a file it will output an array of the folders contents.

If you want to take advantage of WordPress' transient API for caching, simply enter an ID for the cache_id argument. Note that this ID can be anything other than "NULL", it doesn't necessarily have to be a number. Once entered this will cause the shortcode to cache the results of the API call for 24 hours. This means the shortcode will use those cached results and speed up the load times for 24 hours, at which point it will then call the API again to get any updates and use those cached results for another 24 hours.

If you're receiving an error similar to "SSL certificate : unable to get local issuer certificate" then please add the attribute insecure="true" to your shortcode. This stops cURL from verifying the peer's certificate which may be required in some cases depending on your server. If you would rather you can instead sdd the root CA (the CA signing the server certificate) to etc/ssl/certs/ca-certificates.crt which will allow secure connections to work. By default the shortcode will use secure connections.

**Embed Twitch Stream**

[embedTwitch username="your-username" width="###" height="###"]

This Shortcode will embed a Twitch stream into the page. The username attribute is the Twitch Stream's username, which can be found at the end of the URL of the stream. An example would be [http://twitch.tv/day9tv](http://twitch.tv/day9tv). The username for this stream is "day9tv", so that would be entered. The username is a required attribute. The width and height attributes will set the size of the embedded stream, and both are optional attributes. If they are not entered the width will default to 100% and the height will default to 378.

Please note that setting the width to "auto" will not work. Rather, please set the width to "100%" to get the same effect. If you are looking to add your own custom CSS to the container around the Twitch Stream embed, the class is "div.dobdev-twitch-container". This should only be done by someone experienced using CSS, otherwise the results could cause harm to the layout of your site.

**Embed Twitch Stream Chat**

[embedTwitchChat username="your-username" width="###" height="###"]

This Shortcode will embed a Twitch stream's chat into the page. The username attribute is the Twitch Stream's username, which can be found at the end of the URL of the stream. An example would be [http://twitch.tv/day9tv](http://twitch.tv/day9tv). The username for this stream is "day9tv", so that would be entered. The username is a required attribute. The width and height attributes will set the size of the embedded chat, and both are optional attributes. If they are not entered the width will default to 350 and the height will default to 500.

If you are looking to add your own custom CSS to the container around the Twitch Chat embed, the class is "div.dobdev-twitch-chat-container". This should only be done by someone experienced using CSS, otherwise the results could cause harm to the layout of your site.

**Embed YouTube Video**

[embedYouTube video="video-id" width="###" height="###"]

This Shortcode will embed a YouTube video into the page. The video attribute is the YouTube video ID of the video you want to embed into the page. It can be found at the end of the URL on YouTube. For example, the video located at [https://www.youtube.com/watch?v=uCdfze1etec](https://www.youtube.com/watch?v=uCdfze1etec) has the video ID "uCdfze1etec". You will always find the video ID after the "watch?v=". The video attribute is required. The width and height attributes will set the size of the embedded video, and both are optional attributes. If they are not entered the width will default to 560 and the height will default to 315.

Please note that setting the width to "auto" will not work. Rather, please set the width to "100%" to get the same effect. If you are looking to add your own custom CSS to the container around the YouTube video embed, the class is "div.dobdev-youtube-container". This should only be done by someone experienced using CSS, otherwise the results could cause harm to the layout of your site.


**Embed Vimeo Video**

[embedVimeo video="video-id" width="###" height="###"]

This Shortcode will embed a Vimeo video into the page. The video attribute is the Vimeo video ID of the video you want to embed into the page. It can be found at the end of the URL on Vimeo. For example, the video located at [https://vimeo.com/14651522](https://vimeo.com/14651522) has the video ID "14651522". You will always find the video ID after the "/" in the Vimeo URL. The video attribute is required. The width and height attributes will set the size of the embedded video, and both are optional attributes. If they are not entered the width will default to 560 and the height will default to 315.

Please note that setting the width to "auto" will not work. Rather, please set the width to "100%" to get the same effect. If you are looking to add your own custom CSS to the container around the Vimeo video embed, the class is "div.dobdev-vimeo-container". This should only be done by someone experienced using CSS, otherwise the results could cause harm to the layout of your site.

**Inline Code Snippets**

[startCode]

This shortcode will create the start tags for an inline code snippet which will then be ended using the [endCode] shortcode. If you use these two together you can create small inline code samples that look great, are easy to copy, and distinguish themselves from the rest of your text content in appearance. These make it easy to include code snippets without having to switch to the HTML editor in WordPress.

[endCode]

This shortcode will create the end tags for the inline code snippet started by [startCode]. If you use these two together you can create small inline code samples that look great, are esay to copy, and distinguish themselves from the rest of your text content in appearance. These make it easy to include code snippets without having to switch to the HTML editor in WordPress.

If you want to change any of the styling for the inline code snippets, please use the CSS class "code.dobdev-code-inline". From here you can change font size, font family, and even colour using your theme's (hopefully child theme's) stylesheet. This should only be done by someone experienced using CSS, otherwise the results could cause harm to the layout of your site.

**Code Blocks**

[startCodeBlock]

This shortcode will create the start tags for a code block which will then be ended using the [endCodeBlock] shortcode. If you use these two together you can create small, simple code blocks that have a black background with white text, which is the common convention for code blocks. This is great for showing Terminal commands or very small code snippets (I recommend using the embed GitHub Gists shortcode for longer code samples).

[endCodeBlock]

This shortcode will create the end tags for the code snippet started by [startCode]. If you use these two together you can create small, simple code blocks that have a black background with white text, which is the common convention. This is great for showing Terminal commands or very small code snippets (I recommend using the embed GitHub Gists shortcode for longer code samples).

If you want to change any of the styling for the code blocks, please use the CSS class "pre.dobdev-code-block". From here you can change font size, font family, background color, padding and even the actual text color using your theme's (hopefully child theme's) stylesheet. This should only be done by someone experienced using CSS, otherwise the results could cause harm to the layout of your site.

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
eg. [relatedPosts post="1; 2; 3; 4"]

This shortcode will create a small slideshow of related posts wherever you put it. Note that you must enter the post ID's yourself, as this shortcode will not automatically index and display related posts for you. Although this is more work it has a significantly smaller load time than plugins which do automatically index them for you. I would recommend this to people who run their own personal blogs with fewer articles. The slideshow is made using only CSS and jQuery.

Please note that this shortcode should only be used on posts, NOT pages. It will cause pages to hang.

**Social Share**

[socialShare]

This shortcode will create a section with links for sharing your page or post to Twitter, Facebook, Google Plus and Linkedin. The links are color coded to match the colors of each of their respective websites. You can use this like a normal shortcode in your page/post's content or you can add it to your template files by using "echo do_shortcode('[socialShare]');".

== Installation ==

1. Upload the entire dobsondev-shortcodes folder to the /wp-content/plugins/ directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

For more information about the shortcodes avaliable through the plugin please visit the plugin site. The site contains a description and usage information for each shortcode avaliable through the plugin.

* [Plugin Site](http://dobsondev.com/portfolio/dobsondev-shortcodes/)

If you have any shortcodes you want to suggest or to add to the plugin, please contact me at [alex@dobsondev.com](mailto:alex@dobsondev.com).

== Changelog ==

= - 2.1 - =

New Features

* Added a shortcode for displaying a WordPress menu (2.1.4)
* Added a shortcode for displaying a social sharing section with links to share to Twitter, Facebook, Google Plus and Linkedin (2.1.1)
* Added a shortcode for embedding Vimeo videos (2.1.0)
* Added TinyMCE GUI option for Vimeo Embeds (2.1.0)
* Added a shortcode for embedding Kodi addon download link - special thanks to [tobias-d-oe](https://github.com/tobias-d-oe) who contributed this shortcode via [GitHub](https://github.com/) (2.1.0)
* Added a shortcode for embedding Kodi addon information - special thanks to [tobias-d-oe](https://github.com/tobias-d-oe) who contributed this shortcode via [GitHub](https://github.com/) (2.1.0)
* Updated Font Awesome to version 4.6.3 (2.1.0)

Bug Fixes

* Setting markdown equal to "true" will now work for embedding GitHub files instead of just "yes" 4.7.4 (2.1.6)
* Tested up to Wordpress 4.7.4 (2.1.6)
* Tested up to Wordpress 4.7.3 (2.1.5)
* Tested up to Wordpress 4.7 (2.1.4)
* Tested up to WordPress 4.6.1 (2.1.3)
* Fixed a bug where the Insert Code Block TinyMCE button would not use the correct syntax for the shortcode - thanks to [Chris Dillon](https://wordpress.org/support/profile/cdillon27) for catching the bug and letting me know (2.1.2)
* Formated some of the code for the Kodi addon download link and Kodi addon information shortcodes (2.1.1)
* Changed the way the YouTube embed works with line breaks before the container div (2.1.0)

= - 2.0 - =

New Features

* Added a shortcode (divClear) that provides a <div> with clear: both; (2.0.1)
* Added a TinyMCE Plugin that provides a user interface for the shortcodes. Click on the DobsonDev Shortcodes button in the TinyMCE editor will produce a dropdown with all of the available shortcodes you can use, simply click on the shortcode you want and a popup with the available attributes will appear. Fill them out and the shortcode will appear in the editor completed. (2.0.0)
* Updated Font Awesome to 4.4.0 (2.0.0)

Bug Fixes

* Fixed a bug where a debug string was being displayed on the front end, thanks to [igorpecovnik](https://github.com/igorpecovnik) for finding the bug and letting me know (2.0.2)
* Fixed a bug where other Font Awesome usages could be affected by this plugin's CSS (2.0.1)
* Tested up to WordPress 4.4 (2.0.0)
* Fixed a bug where not all of the CSS and JavaScript files were minified (2.0.0)

= - 1.1 - =

New Features

* Added Transient Cache support for the GitHub README and File shortcodes (1.1.3)
* Added shortcode for displaying GitHub repository file contents (1.1.1)
* Added shortcode for displaying GitHub repository README.md files (1.1.0)

Bug Fixes

* Fixed a bug where the GitHub File Contents shortcode didn't work. When changing from version 1.1.8 to 1.1.9 the API call was mistakenly switched to the README file but this has now been fixed. Thanks to [Igor Pečovnik](https://github.com/igorpecovnik) for finding the error and letting me know. (1.1.10)
* Found a bug where the GitHub Readme and GitHub File Contents shortcodes would not return anything because cURL was unable to verify the certificate provided by the server. This can now be avoided using the insecure="true" attribute on the shortcode. Thanks to [JacobD10](https://profiles.wordpress.org/jacobd10/) for finding the error. (1.1.9)
* More substantial error handling has been added to both the GitHub Readme and GitHub File Contents shortcodes which should help users identify what kind of cURL error they are getting. (1.1.9)
* Tested up to WordPress 4.3 (1.1.8)
* Added the tags for tested up to WordPress 4.2.4 (1.1.7)
* Fixed where the Related Posts Shortcode would brick the page it was loading on (1.1.6)
* Fixed a bug where GitHub file contents wouldn't display line breaks properly if they were not a markdown file - thanks to [Stephanie Locke](https://github.com/stephlocke) for catching this and letting me know (1.1.5)
* Fixed a naming error for the WordPress transients used in the GitHub README and File shortcodes (1.1.4)
* Minified the CSS and JS scripts (1.1.3)
* Fixed a return error in the GitHub README and GitHub File Contents shortcodes (1.1.2)
* Changed some documentation errors (1.1.1)
* Added some documentation that was missing (1.1.0)
* Added the tags for tested up to WordPress 4.1.1 (1.1.0)

= - 1.0 - =

I've decided on an updating scheme that this plugin will now follow. Any change in a #.#.1 increment will denote minor bug fixes. Any change in a #.1.# increment will represent a new shortcode added to the plugin. Finally any change in 1.#.# will donate either a major shortcode being added or this could also go up if enough smaller shortcodes are added to the plugin.

From now on Bug Fixes will all fall under #.# Changlog. However, in brackets will show the exact version number where the bug was fixed. You can see an example below under the "Bug Fixes" heading where some bug fixes are noted as being fixed in the 1.0.1 patch.

**New Features**

* Full 1.0 Release - I feel there is enough content now to justify it
* Added shortcode for displaying a related posts slideshow

**Bug Fixes**

* Created CSS wrapper classes for the Twitch, Twitch Chat, and PDF embeds (1.0.1)
* Changed the default with of the Twitch embed to 100% rather than 620 (1.0.1)
* Fixed a bug where all related posts would display when the page was loaded (1.0.1)

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
