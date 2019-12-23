( function ($) { $.fn.serializeObject = function () { var o = {}; var a = this.serializeArray(); $.each( a, function () { if (o[this.name]) { if (!o[this.name].push) { o[this.name] = [o[this.name]]; } o[this.name].push(this.value || ''); } else { o[this.name] = this.value || ''; } }); return o; }; } )(jQuery);

function is_mobile() {
	if ($(window).width() <= 991) {
		$(".navbar-nav").addClass("is-mobile");
	} else {
		$(".navbar-nav").removeClass("is-mobile");
	}
}

$(document).ready(() => {
	is_mobile();

	$(window).resize((e) => {
		is_mobile();
	});

	$(".nav-item").click((e) => {
		if ($(".navbar-nav").hasClass("is-mobile")) {
			$(".hamburger").removeClass("is-active");
			$(".navbar-collapse").hide();
		}
	})

	// HEADER
	$(".hamburger").on('click', (e) => {
		$(e.currentTarget).toggleClass("is-active");
		$(".navbar-collapse").fadeToggle()
	});

	// FOOTER
	$(".scroller").on('click', (e) => {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});

	$('#slideshow .slider').slick({
		dots: false,
		arrows: true,
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'ease',
		prevArrow: $('#slideshow .prev'),
		nextArrow: $('#slideshow .next')
	});

	$('#os__homepage__about .slider').slick({
		dots: false,
		arrows: true,
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'ease',
		prevArrow: $('#os__homepage__about .prev'),
		nextArrow: $('#os__homepage__about .next')
	});

	$("#os__homepage__brands .slider").slick({
		dots: false,
		arrows: true,
		infinite: true,
		speed: 500,
		slidesToShow: 1,
		slidesToScroll: 1,
		fade: false,
		cssEase: 'ease',
		prevArrow: $('#os__homepage__brands .prev'),
		nextArrow: $('#os__homepage__brands .next')
	});

	$("#os__homepage__about .slide-counter").html('1/' + $("#os__homepage__about .slider .slide-item").length);

	$('#os__homepage__about .slider').on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
		var i = (currentSlide ? currentSlide : 0) + 1;
		
		$("#os__homepage__about .slide-counter").html(i + '/' + slick.slideCount);
	});

});
