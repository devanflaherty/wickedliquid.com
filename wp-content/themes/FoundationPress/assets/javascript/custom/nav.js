$("#masthead a").append("<span></span><span></span>");

$("#masthead a").hover(
  function() {
    $( this ).addClass( "anim" );
  }, function() {
    $(this).one('animationiteration webkitAnimationIteration', function() {
        $(this).removeClass("anim");
    });
  }
);

function open_tab(tab_id,panel) {
  $("#"+tab_id).foundation("selectTab",$("#"+panel));
}

$(".header-tab a").click(function(){
  $(".header-tab a").parent('li').removeClass('is-active');

  $(this).parent('li').addClass('is-active');
  var getTab = $(this).attr('href');
  getTab = getTab.replace('#', '');

  open_tab('work', getTab);
});

$(".tabs-title a").click(function(){
  var getTab = $(this).attr('href');
  $(".header-tab").removeClass('is-active');

  $(".header-tab a[href=" + getTab + "]").parent('li').addClass('is-active');
});
