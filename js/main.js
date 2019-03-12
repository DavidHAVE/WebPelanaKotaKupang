$(document).ready(function () {					
	$(".signin").click(function(){
		$(".login-back").css("filter", "alpha(opacity=90)");
		$(".login-back").fadeIn(300);
		$(this).parent().parent().find(".login-back").fadeIn(300);
		})
		$(".login-back, .close").click(function(){
			$(".login-back, .login-back").fadeOut(300);
	});
	/* -- */

	/* login box */
	$(".signin").click(function(){
		$(".login-back").css("filter", "alpha(opacity=90)");
		$(".login-back, .loginbox-panel").fadeIn(300);
		})
		$(".login-back, .close").click(function(){
			$(".login-back, .loginbox-panel").fadeOut(300);
	});
	/* -- */

	/* autoclear function for inputs */
	$('.autoclear').click(function() {
		if (this.value == this.defaultValue) {
		this.value = '';
		}
	});
	$('.autoclear').blur(function() {
		if (this.value == '') {
		this.value = this.defaultValue;
		}
	});

	$('.gotop').click(function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
	});

	/* Menu */
	$(function(){ 
		if (!!$('#nav-fixed').offset()) {
			var stickyTop = $('#nav-fixed').offset().top;
			$(window).scroll(function(){
				var windowTop = $(window).scrollTop();
				if (stickyTop < windowTop){
					$('#nav-fixed').css({ position: 'fixed', top: 0 });
				}
				else {
					$('#nav-fixed').css('position','static');
				}
			});
		}
	});
	/* Menu Collapse*/
	$(".menu-collapse").html();
		$(".collapse-button .span").click(function(){
			if ($(".menu-collapse ul").hasClass("expanded")) {
				$(".menu-collapse ul.expanded").removeClass("expanded").slideUp(250);
				$(".collapse-button .span span").removeClass("open");
			} else {
				$(".menu-collapse ul").addClass("expanded").slideDown(250);
				$(".collapse-button .span span").addClass("open");
			}
	});

	$(".box").html();
		$(".contact-collapse span").click(function(){
			if ($(".box .contact").hasClass("expanded")) {
				$(".box .contact.expanded").removeClass("expanded").slideUp(250);
				$(".contact-collapse span").removeClass("open");
			} else {
				$(".box .contact").addClass("expanded").slideDown(250);
				$(".contact-collapse span").addClass("open");
			}
	});
});