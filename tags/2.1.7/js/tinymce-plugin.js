(function() {
    tinymce.PluginManager.add('dobsondev_shrtcode_tinymce', function( editor, url ) {

        // DobsonDev Shortcodes Button in the TinyMCE Editor which contains a dropdown menu
        // that holds the buttons for all the shorcodes that DobsonDev Shortcodes has
        editor.addButton( 'dobsondev_shrtcode_tinymce_button', {
            title: 'DobsonDev Shortcodes',
            // text: 'DobsonDev Shortcodes',
            type: 'menubutton',
            icon: 'icon dobsondev-icon',
            menu: [{
                text: 'Embed PDF',
                icon: 'icon fa fa-file-pdf-o dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Embed PDF',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'source',
                                label: 'Source *'
                            },
                            {
                                type: 'textbox',
                                name: 'width',
                                label: 'Width'
                            },
                            {
                                type: 'textbox',
                                name: 'height',
                                label: 'Height'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required field source is filled out
                            if ( ! e.data.source ) {
                                alert("You must fill in the Source to embed a PDF");
                                return;
                            }
                            // go through all permutations of width and height being included
                            if ( ! e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedPDF source="' + e.data.source + '"]' );
                            } else if ( ! e.data.width && e.data.height ) {
                                editor.insertContent( '[embedPDF source="' + e.data.source + '" height="' + e.data.height + '"]' );
                            } else if ( e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedPDF source="' + e.data.source + '" width="' + e.data.width + '"]' );
                            } else {
                                editor.insertContent( '[embedPDF source="' + e.data.source + '" width="' + e.data.width + '" height="' + e.data.height + '"]' );
                            }
                        }
                    });
                }
            },
            {
                text: 'Embed GitHub Gist',
                icon: 'icon fa fa-github dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Embed GitHub Gist',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'source',
                                label: 'Source *'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required field source is filled out
                            if ( ! e.data.source ) {
                                alert("You must fill in the Source to embed a GitHub Gist");
                                return;
                            }
                            editor.insertContent( '[embedGist source="' + e.data.source + '"]' );
                        }
                    });
                }
            },
            {
                text: 'Embed GitHub Readme',
                icon: 'icon fa fa-github dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Embed GitHub Readme',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'owner',
                                label: 'Owner *'
                            },
                            {
                                type: 'textbox',
                                name: 'repo',
                                label: 'Repository *'
                            },
                            {
                                type: 'textbox',
                                name: 'cacheid',
                                label: 'Cache ID'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required fields owner and repo are filled out
                            if ( ! e.data.owner || ! e.data.repo ) {
                                alert("You must fill in the Owner and Repository to embed a GitHub Readme");
                                return;
                            }
                            // check to see if the cache ID is set or not
                            if ( ! e.data.cacheid ) {
                                editor.insertContent( '[embedGitHubReadme owner="' + e.data.owner + '" repo="' + e.data.repo + '"]' );
                            } else {
                                editor.insertContent( '[embedGitHubReadme owner="' + e.data.owner + '" repo="' + e.data.repo + '" cache_id="' + e.data.cacheid + '"]' );
                            }
                        }
                    });
                }
            },
            {
                text: 'Embed GitHub File',
                icon: 'icon fa fa-github dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Embed GitHub File Contents',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'owner',
                                label: 'Owner *'
                            },
                            {
                                type: 'textbox',
                                name: 'repo',
                                label: 'Repository *'
                            },
                            {
                                type: 'textbox',
                                name: 'path',
                                label: 'Path to File *'
                            },
                            {
                                type: 'checkbox',
                                name: 'markdown',
                                label: 'Markdown',
                                value: 'yes',
                                checked: false
                            },
                            {
                                type: 'textbox',
                                name: 'cacheid',
                                label: 'Cache ID'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required fields owner, repo and path are filled out
                            if ( ! e.data.owner || ! e.data.repo || ! e.data.path ) {
                                alert("You must fill in the Owner, Repository and Path to the File in order to embed a GitHub File");
                                return;
                            }
                            // check all the permutations of markdown and cache ID
                            if ( ! e.data.markdown && ! e.data.cacheid ) {
                                editor.insertContent( '[embedGitHubContent owner="' + e.data.owner + '" repo="' + e.data.repo + '" path="' + e.data.path + '"]' );
                            } else if ( ! e.data.markdown && e.data.cacheid ) {
                                editor.insertContent( '[embedGitHubContent owner="' + e.data.owner + '" repo="' + e.data.repo + '" path="' + e.data.path + '" cache_id="' + e.data.cacheid + '"]' );
                            } else if ( e.data.markdown && ! e.data.cacheid ) {
                                editor.insertContent( '[embedGitHubContent owner="' + e.data.owner + '" repo="' + e.data.repo + '" path="' + e.data.path + '" markdown="' + e.data.markdown + '"]' );
                            } else {
                                editor.insertContent( '[embedGitHubContent owner="' + e.data.owner + '" repo="' + e.data.repo + '" path="' + e.data.path + '" markdown="' + e.data.markdown + '" cache_id="' + e.data.cacheid + '"]' );
                            }
                        }
                    });
                }
            },
            {
                text: 'Twitch Stream',
                icon: 'icon fa fa-twitch dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Embed Twitch Stream',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'username',
                                label: 'Username *'
                            },
                            {
                                type: 'textbox',
                                name: 'width',
                                label: 'Width'
                            },
                            {
                                type: 'textbox',
                                name: 'height',
                                label: 'Height'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required username field is filled out
                            if ( ! e.data.username ) {
                                alert("You must fill in the Username in order to embed a Twitch Stream");
                                return;
                            }
                            // go through all the permutation of width and height
                            if ( ! e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedTwitch username="' + e.data.username + '"]' );
                            } else if ( ! e.data.width && e.data.height ) {
                                editor.insertContent( '[embedTwitch username="' + e.data.username + '" height="' + e.data.height + '"]' );
                            } else if ( e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedTwitch username="' + e.data.username + '" width="' + e.data.width + '"]' );
                            } else {
                                editor.insertContent( '[embedTwitch username="' + e.data.username + '" width="'+ e.data.width + '" height="' + e.data.height + '"]' );
                            }
                        }
                    });
                }
            },
            {
                text: 'Twitch Chat',
                icon: 'icon fa fa-twitch dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Embed Twitch Chat',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'username',
                                label: 'Username *'
                            },
                            {
                                type: 'textbox',
                                name: 'width',
                                label: 'Width'
                            },
                            {
                                type: 'textbox',
                                name: 'height',
                                label: 'Height'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required username field is filled out
                            if ( ! e.data.username ) {
                                alert("You must fill in the Username in order to embed a Twitch Chat");
                                return;
                            }
                            // go through all the permutations of width and height
                            if ( ! e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedTwitchChat username="' + e.data.username + '"]' );
                            } else if ( ! e.data.width && e.data.height ) {
                                editor.insertContent( '[embedTwitchChat username="' + e.data.username + '" height="' + e.data.height + '"]' );
                            } else if ( e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedTwitchChat username="' + e.data.username + '" width="' + e.data.width + '"]' );
                            } else {
                                editor.insertContent( '[embedTwitchChat username="' + e.data.username + '" width="'+ e.data.width + '" height="' + e.data.height + '"]' );
                            }
                        }
                    });
                }
            },
            {
                text: 'YouTube Video',
                icon: 'icon fa fa-youtube dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Embed YouTube Video',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'videoid',
                                label: 'Video ID *'
                            },
                            {
                                type: 'textbox',
                                name: 'width',
                                label: 'Width'
                            },
                            {
                                type: 'textbox',
                                name: 'height',
                                label: 'Height'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required username field is filled out
                            if ( ! e.data.videoid ) {
                                alert("You must fill in the Video ID in order to embed a YouTube video");
                                return;
                            }
                            // go through all the combinations of width and height
                            if ( ! e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedYouTube video="' + e.data.videoid + '"]' );
                            } else if ( ! e.data.width && e.data.height ) {
                                editor.insertContent( '[embedYouTube video="' + e.data.videoid + '" height="' + e.data.height + '"]' );
                            } else if ( e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedYouTube video="' + e.data.videoid + '" width="' + e.data.width + '"]' );
                            } else {
                                editor.insertContent( '[embedYouTube video="' + e.data.videoid + '" width="'+ e.data.width + '" height="' + e.data.height + '"]' );
                            }
                        }
                    });
                }
            },
            {
                text: 'Vimeo Video',
                icon: 'icon fa fa-vimeo dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Embed Vimeo Video',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'videoid',
                                label: 'Video ID *'
                            },
                            {
                                type: 'textbox',
                                name: 'width',
                                label: 'Width'
                            },
                            {
                                type: 'textbox',
                                name: 'height',
                                label: 'Height'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required username field is filled out
                            if ( ! e.data.videoid ) {
                                alert("You must fill in the Video ID in order to embed a Vimeo video");
                                return;
                            }
                            // go through all the combinations of width and height
                            if ( ! e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedVimeo video="' + e.data.videoid + '"]' );
                            } else if ( ! e.data.width && e.data.height ) {
                                editor.insertContent( '[embedVimeo video="' + e.data.videoid + '" height="' + e.data.height + '"]' );
                            } else if ( e.data.width && ! e.data.height ) {
                                editor.insertContent( '[embedVimeo video="' + e.data.videoid + '" width="' + e.data.width + '"]' );
                            } else {
                                editor.insertContent( '[embedVimeo video="' + e.data.videoid + '" width="'+ e.data.width + '" height="' + e.data.height + '"]' );
                            }
                        }
                    });
                }
            },
            {
                text: 'Embed Kodi Addon Download',
                icon: 'icon fa fa-television dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Embed Kodi Addon Download',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'addonid',
                                label: 'AddonID *'
                            },
                            {
                                type: 'textbox',
                                name: 'addonxmlurl',
                                label: 'URL to addon.xml *'
                            },
                            {
                                type: 'textbox',
                                name: 'repoprefix',
                                label: 'Repo-Prefix (optional) *'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required fields addonid and addonxmlurl are filled out
                            if ( ! e.data.addonid || ! e.data.addonxmlurl ) {
                                alert("You must fill in the AddonID and addon.xml URL to embed a Kodi Addon Download Link");
                                return;
                            }
                            editor.insertContent( '[embedKodiAddonDownload addonid="' + e.data.addonid + '" addonxmlurl="' + e.data.addonxmlurl + '" repoprefix="' + e.data.repoprefix + '"]' );
                        }
                    });
                }
            },
            {
                text: 'Embed Kodi Addon Info',
                icon: 'icon fa fa-television dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Embed Kodi Addon Info',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'addonid',
                                label: 'AddonID *'
                            },
                            {
                                type: 'textbox',
                                name: 'addonxmlurl',
                                label: 'URL to addon.xml *'
                            },
                            {
                                type: 'textbox',
                                name: 'repoprefix',
                                label: 'Repo-Prefix (optional) *'
                            }
                        ],
                        onsubmit: function( e ) {
                            // check that the required fields addonid and addonxmlurl are filled out
                            if ( ! e.data.addonid || ! e.data.addonxmlurl ) {
                                alert("You must fill in the AddonID and addon.xml URL to embed a Kodi Addon Download Link");
                                return;
                            }
                            editor.insertContent( '[embedKodiAddonInfo addonid="' + e.data.addonid + '" addonxmlurl="' + e.data.addonxmlurl + '" repoprefix="' + e.data.repoprefix + '"]' );
                        }
                    });
                }
            },
            {
                text: 'Inline Code',
                icon: 'icon fa fa-code dobsondev-shortcodes',
                value: '[startCode][endCode]',
                onclick: function() {
                    editor.insertContent(this.value());
                }
            },
            {
                text: 'Code Block',
                icon: 'icon fa fa-file-code-o dobsondev-shortcodes',
                value: '[startCodeBlock][endCodeBlock]',
                onclick: function() {
                    editor.insertContent(this.value());
                }
            },
            {
                text: 'Button',
                icon: 'icon fa fa-plus-square dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Embed Button',
                        body:
                        [
                            {
                                type: 'textbox',
                                name: 'text',
                                label: 'Button Text *'
                            },
                            {
                                type: 'listbox',
                                name: 'color',
                                label: 'Color',
                                values:
                                [
                                    {
                                        text: 'Blue',
                                        value: 'blue',
                                        selected: true
                                    },
                                    {
                                        text: 'Green',
                                        value: 'green'
                                    },
                                    {
                                        text: 'Red',
                                        value: 'red'
                                    },
                                    {
                                        text: 'Orange',
                                        value: 'orange'
                                    },
                                    {
                                        text: 'Purple',
                                        value: 'purple'
                                    },
                                    {
                                        text: 'Turquoise',
                                        value: 'turquoise'
                                    }
                                ]
                            },
                            {
                                type: 'textbox',
                                name: 'link',
                                label: 'Link'
                            }
                        ],
                        onsubmit: function( e ) {
                            // go through all the combinations of color and link
                            if ( ! e.data.color && ! e.data.link ) {
                                editor.insertContent( '[button text="' + e.data.text + '"]' );
                            } else if ( ! e.data.color && e.data.link ) {
                                editor.insertContent( '[button text="' + e.data.text + '" link="' + e.data.color + '"]' );
                            } else if ( e.data.color && ! e.data.link ) {
                                editor.insertContent( '[button text="' + e.data.text + '" color="' + e.data.color + '"]' );
                            } else {
                                editor.insertContent( '[button text="' + e.data.text + '" color="'+ e.data.color + '" link="' + e.data.link + '"]' );
                            }
                        }
                    });
                }
            },
            {
                text: 'User Interaction Message',
                icon: 'icon fa fa-quote-left dobsondev-shortcodes',
                onclick: function() {
                    editor.windowManager.open({
                        title: '',
                        body:
                        [
                            {
                                type: 'listbox',
                                name: 'messagetype',
                                label: 'Message Type *',
                                values:
                                [
                                    {
                                        text: 'Info Message',
                                        value: 'info',
                                        selected: true
                                    },
                                    {
                                        text: 'Success Message',
                                        value: 'success'
                                    },
                                    {
                                        text: 'Warning Message',
                                        value: 'warning'
                                    },
                                    {
                                        text: 'Error Message',
                                        value: 'error'
                                    }
                                ]
                            },
                            {
                                type: 'textbox',
                                name: 'text',
                                label: 'Text *'
                            }
                        ],
                        onsubmit: function( e ) {
                            // pick the correct message type based on what was selected
                            if ( e.data.messagetype == 'info' ) {
                                editor.insertContent( '[infoMessage text="' + e.data.text + '"]' );
                            } else if ( e.data.messagetype == 'success' ) {
                                editor.insertContent( '[successMessage text="' + e.data.text + '"]' );
                            } else if ( e.data.messagetype == 'warning' ) {
                                editor.insertContent( '[warningMessage text="' + e.data.text + '"]' );
                            } else {
                                editor.insertContent( '[errorMessage text="' + e.data.text + '"]' );
                            }
                        }
                    });
                }
            },
            {
                text: 'Social Share',
                icon: 'icon fa fa-share-alt dobsondev-shortcodes',
                value: '[socialShare]',
                onclick: function() {
                    editor.insertContent(this.value());
                }
            },
            {
                text: 'Related Posts',
                icon: 'icon dashicons-admin-post dobsondev-shortcodes',
                value: '[relatedPosts posts=""]',
                onclick: function() {
                    editor.insertContent(this.value());
                }
            }]
        });
    });
})();
