(function($) {

	const primaryMenu = $("#menu-primary");

	primaryMenu.on("mouseenter", ".menu-item-has-children", function () {
	  console.log($(this).children("ul.sub-menu"));
	  $(this).children("ul.sub-menu").addClass("active");
	  $(this).addClass("active");
	});

	primaryMenu.on("mouseleave", ".menu-item-has-children", function (e) {
	  const subMenu = $(this).children("ul.sub-menu");
	  subMenu.removeClass("active");
	  $(this).removeClass("active");
	});

	//header languages
	$('.header-lang').on('mouseenter', function() {
		$(this).find('ul').addClass('active')
	})
	$('.header-lang').on('mouseleave', function() {
	  $(this).find('ul').removeClass('active')
  })

    //mobile bars
	$(".mobile-menu-bars").on("click", function () {
		$(this).toggleClass("active");
		$(".mobile-menu-items").toggleClass("active");
		$("body").toggleClass("hiddenbody");
	  });

	 $('.menu-item-has-children > a', $('#menu-mobile-primary')).on('click', function(e) {
		 e.preventDefault();
		 $(this).addClass('active');
		 // $(this) is a, $(this).parent() is li
		 $(this).parent().find('ul.sub-menu').slideDown();
		 $(this).off();
	 }) 

})(jQuery)