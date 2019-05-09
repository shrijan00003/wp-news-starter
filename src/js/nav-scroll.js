jQuery("document").ready(function($) {
  //scroll to top link
  const $link =
    '<a href="#top" class="top" style="background:red; ">&uarr;</a>';
  $("body").append($link);
  $(".top").hide();
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $(".top").fadeIn();
    } else {
      $(".top").fadeOut();
    }
  });
  $(".top").click(function(e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, 400);
  });
}); //end of document ready
