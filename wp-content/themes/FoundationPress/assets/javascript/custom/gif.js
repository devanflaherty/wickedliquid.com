// GIF loading
$(function() {
  // $('img[src$=".gif"]').each(function() {
  //   var src = $(this).attr("src");
  //   $(this).attr("src", src.replace(/\.gif$/i, ".jpg"));
  //   $(this).addClass("gif");
  // });
  $('.gif-me').hover(function() {
      var src = $(this).attr("src");
      $(this).attr("src", src.replace(/\.jpg$/i, ".gif"));
    },
    function()
    {
      var src = $(this).attr("src");
      $(this).attr("src", src.replace(/\.gif$/i, ".jpg"));
    });
});
