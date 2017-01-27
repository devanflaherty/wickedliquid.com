var controller = new ScrollMagic.Controller();

$('.parallax').each(function(){
  var currentParallax = this;
  var trigger = currentParallax.closest('header');

  var tween_parallax = TweenMax
  .fromTo(currentParallax, 1, {
    transform: 'translate(0px, -75px) scale(1.5)'
  }, {
    transform: 'translate(0px, 75px) scale(1.5)', ease: Linear.easeNone
  });

  var scene = new ScrollMagic.Scene({
    triggerElement: trigger,
    triggerHook: "onEnter",
    duration: "200%"
  })
  .setTween(tween_parallax)
  // .addIndicators({name: "parallax"})
  .addTo(controller);
});

// $('.work-post').each(function(){
//   var currentStatement = this;
//   var trigger = currentStatement.closest('#workPosts');
//
//   var tween_statement = TweenMax
//   .staggerFromTo(currentStatement, 2, {
//     transform: 'translate(0px, 100px)'
//   }, {
//     transform: 'translate(0px, 0px), ease: Back.easeOut'
//   }, 0.15);
//
//   var scene = new ScrollMagic.Scene({
//     triggerElement: trigger,
//     triggerHook: "onEnter",
//     duration: "100%"
//   })
//   .setTween(tween_statement)
//   .addIndicators({name: "Pop"})
//   .addTo(controller);
// });

// var tween = TweenMax.staggerFromTo(".work-post", 2,
// {
//   transform: 'translate(0px, 100px)'
// }, {
//   transform: 'translate(0px, 0px)'
// }, 0.5);
//
// var scene = new ScrollMagic.Scene({
//   triggerElement: '.work-loop',
//   triggerHook: "onEnter"
// })
// .setTween(tween)
// //.addIndicators({name: "Pop"})
// .addTo(controller);
