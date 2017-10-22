/* Require jQuery */
if (!jQuery) { throw new Error("WP Theme requires jQuery") }
/* ==================================
* Start of General Site Wide JavaScript
================================== */
jQuery(document).ready(function($){

  var i = 0;
  $('.widget-group .panel').each(function() {
    $(this).find('.panel-heading').attr('id', 'heading' + i);
    $(this).find('.panel-collapse').attr('id', 'toggle' + i);
    $(this).find('.panel-collapse').attr('aria-labelledby', 'heading' + i);
    $(this).find('.panel-title a').attr('href', '#toggle' + i);
    $(this).find('.panel-title a').attr('aria-controls', 'toggle' + i);
    i++;
  }); 

  $('.footer-menu>li>a').each(function(){
    $(this).addClass('hvr-underline-from-center black-clr');
  });

});
/* Toggle Off Accordion Icon CLick */
jQuery('.panel-title a').on('click', function(){
  var faIcon = jQuery(this).find('i');
  if (faIcon.hasClass('rotate-up180') ){
    faIcon.removeClass('rotate-up180').addClass('rotate-0');
  } else {
    faIcon.removeClass('rotate-0').addClass('rotate-up180');
  }
});
/* Function Declaration */
function vidRescale(e){
  /* aspectRatio = 16:9 */
  var aspectRatioW = 16;
  var aspectRatioH = 9;
  $(e).attr('width', '100%');
  var w = $(e).width();
  var h = (w*aspectRatioH)/aspectRatioW;
  jQuery(e).height(h);
}
/* Function Calls */
jQuery(window).on('load resize', function(){
  vidRescale('.article-video-col iframe, .single-content iframe');
});
/* ==================================
* End of General Site Wide JavaScript
================================== */