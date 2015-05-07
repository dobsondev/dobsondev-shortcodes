jQuery( document ).ready(function($) {

  /* Creates the related posts slideshow */
  function fade( curIndex ) {
    // Grab the related posts
    var related_posts = $( '.dobdev-related-posts-post' );
    // Get the current index which was passed in
    var currentIndex = curIndex;
    // Check if we need to go back to the first related post
    if (currentIndex >= related_posts.length) {
      currentIndex = 0;
    }
    var current = related_posts.eq(currentIndex);

    // Fade in the current post
    current.fadeIn(300, function() {
      $(this).css("display", "block");
    }).delay( 2500 );

    // Fade out the current post and move to the next post
    current.fadeOut(100, function() {
      $(this).css("display", "none");
      fade(currentIndex + 1);
    });
  }

  // We want to start with index 0 on our related posts slideshow
  fade(0);

});