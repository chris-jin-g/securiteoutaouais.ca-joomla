<script type="text/javascript">
/*! Jquery scrollto function */
!function(o,n){var l=function(){var l,t=n(o.documentElement),e=n(o.body);return t.scrollTop()?t:(l=e.scrollTop(),e.scrollTop(l+1).scrollTop()==l?t:e.scrollTop(l))}();n.fn.smoothScroll=function(o){return o=~~o||400,this.find('a[href*="#s5"]').click(function(t){var e=this.hash,a=n(e);location.pathname.replace(/^\//,"")===this.pathname.replace(/^\//,"")&&location.hostname===this.hostname&&a.length&&(t.preventDefault(),jQuery.fn.fullpage?jQuery.fn.fullpage.scrollPage2(a):l.stop().animate({scrollTop:a.offset().top},o,function(){location.hash=e}))}).end()}}(document,jQuery);
function initSmoothscroll(){
	jQuery('html').smoothScroll(700);
}
jQuery(document).ready(function(){
	initSmoothscroll();
});
var s5_page_scroll_enabled = 1;
function s5_page_scroll(obj){ if(jQuery.browser.mozilla) var target = 'html'; else var target='html body'; jQuery(target).stop().animate({scrollTop:jQuery(obj).offset().top},700,function(){location.hash=obj}); } 
function s5_hide_scroll_to_top_display_none() { if (window.pageYOffset < 300) { document.getElementById("s5_scrolltopvar").style.display = "none"; } }
function s5_hide_scroll_to_top_fadein_class() { document.getElementById("s5_scrolltopvar").className = "s5_scrolltop_fadein"; }
function s5_hide_scroll_to_top() {
	if (window.pageYOffset >= 300) {document.getElementById("s5_scrolltopvar").style.display = "block";
		document.getElementById("s5_scrolltopvar").style.visibility = "visible";
		window.setTimeout(s5_hide_scroll_to_top_fadein_class,300);}
	else {document.getElementById("s5_scrolltopvar").className = "s5_scrolltop_fadeout";window.setTimeout(s5_hide_scroll_to_top_display_none,300);}}
jQuery(document).ready( function() {s5_hide_scroll_to_top();});
jQuery(window).resize(s5_hide_scroll_to_top);
if(window.addEventListener) {
	window.addEventListener('scroll', s5_hide_scroll_to_top, false);   
}
else if (window.attachEvent) {
	window.attachEvent('onscroll', s5_hide_scroll_to_top); 
}
</script>
<div id="s5_scrolltopvar" class="s5_scrolltop_fadeout" style="visibility:hidden">
<a href="#s5_scrolltotop" id="s5_scrolltop_a" class="s5_scrolltotop"><?php if ($template_date == "June 2011") {?>Scroll Up<?php } ?></a>
</div>


	
