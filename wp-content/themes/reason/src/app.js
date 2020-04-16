// Import styles
import './scss/app.scss';
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/css/fontawesome.min.css';
// Import scripts
import TweenMax from "gsap/TweenMax";
import CSSPlugin from "gsap/CSSPlugin";
import TweenLite from "gsap/TweenLite";
//header
	$(window).scroll(function(){
		let mytop = $(window).scrollTop();	
		if (mytop > 20){
			$('header').addClass('active');
		} else {
			$('header').removeClass('active');
		}
	});
//another ios
	var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	if (iOS) {
	 	//
	}
//scroll
	$('.btnanchor').on('click', function(event){
      	event.preventDefault();
      	let $this = $(this);
      	let href = $this.attr('href');
      	$('html, body').stop().animate({scrollTop: $(href).offset().top - 73}, 800);
 	});
	
//buttons
	$('.nav__mobile').on('click', function(event){
      	$('body').toggleClass('menuOpen');
 	});	
//forms input
	
//preload animation
	

//credits
console.log("ღ Reason ღ \n Dev con Amor por wampy para Reason");