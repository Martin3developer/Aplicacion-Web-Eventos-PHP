$(function(){
	

	var header = document.getElementById('header');
	
	// construct an instance of Headroom, passing the element
	var headroom  = new Headroom(header);
	// initialise
	
	headroom.init(); 
	


//----------------------------------------------------
	var ancho = $(window).width(),
		enlaces = $('#enlaces'),
	    btnMenu = $('#btn-menu '),
	    icono = $('#btn-menu .icono');
		
		if (ancho < 931) {
			enlaces.hide(); 
			icono.addClass('fa-bars');
		}

		btnMenu.on('click', function(e){
			enlaces.slideToggle();
			icono.toggleClass('fa-bars');
			icono.toggleClass('fa-times');
		});

		$(window).on('resize', function(){
			if ($(this).width() > 931) {
				enlaces.show();
				icono.removeClass('fa-bars');
				icono.addClass('fa-times');


			}
		});
});

