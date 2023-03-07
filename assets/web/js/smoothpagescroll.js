$(function() {
	$('a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({scrollTop: target.offset().top}, 1000);
				return false;
			}
		}
	});
});

var pxShow=400;var fadeInTime=400;var fadeOutTime=400;var scrollSpeed=400;
$(window).scroll(function(){if($(window).scrollTop()>=pxShow){$("#backtotop").fadeIn(fadeInTime);}else{$("#backtotop").fadeOut(fadeOutTime);}});
$('#backtotop a').click(function(){$('html, body').animate({scrollTop:0},scrollSpeed);return false;});