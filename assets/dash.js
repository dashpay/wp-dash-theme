var $ = jQuery.noConflict();

var Layout = {
	isMobile: function(){
		if ( $(window).width()<=991 ){
			return true;
		}
		return false;
	},
	init: function(){
		Layout.initNav();

      $('select.select-custom').selectric();

      $('.lang-current').each(function(){
      	$(this).text($('.wpml-ls-current-language').first().text())

      })

      //generic fade-ins
		window.sr = ScrollReveal({ reset: true });
		if ( !Layout.isMobile() ){
			sr.reveal('.fade-in-left', { duration: 1000, origin: 'left', scale: 1, distance: '50px' });
			sr.reveal('.fade-in-right', { duration: 1000, origin: 'right', scale: 1, distance: '50px' });
		}
		sr.reveal('.fade-in', { duration: 1000, scale: 1 });
	

	},
	initNav: function(){
		// desktop dropdown shape
		var wait = 200;
		var $bg = $('#navbar-main .bg');
		$('#navbar-main .navbar-item').mouseenter(function(){
			if ( !Layout.isMobile()){
				$(this).addClass('mouseover');
				if ( $(this).find('.dropdown').length==0 ){
					// no dropdown on this item - close the bg shape
					Layout.closeNavDrop();
				}
				else {
					// have a dropdown - shift the bg and resize
					var width = $(this).find('.dropdown').outerWidth();
					var height = $(this).find('.dropdown').outerHeight();
					var top = $(this).find('.dropdown').offset().top-$('#navbar-main').offset().top;
					var left = $(this).find('.dropdown').offset().left - $('#navbar-main').offset().left;
					$bg.css('left',left+"px").css('width',width+"px").css('height',height+"px").css('top',top+"px").addClass('show')

					setTimeout(function(){ //did it mess up with a quick mouseleave? open it again.
						if (!$bg.hasClass('show')){
							$bg.css('left',left+"px").css('width',width+"px").css('height',height+"px").css('top',top+"px").addClass('show')
						}
					}, wait+10)
				}
			}
		}).mouseleave(function(){
			if ( !Layout.isMobile()){
				$(this).removeClass('mouseover'); //deactive the current

				setTimeout(function(){ //if mouse outside nav long enough, close it
					if ( !$('#navbar-main .mouseover').length ){
						Layout.closeNavDrop();
					}
				}, wait);
			}
		});
		// mobile dropdowns
		var defaultheight = 55; //default header height

		// Main Menu
		$('.menu-toggle').on('click',function(e){
			e.preventDefault();
			if ( $('.lang-mobile').hasClass('is-open') ){
				$('.lang-mobile a').trigger('click')
			}
			if ( !$('header').hasClass('is-open')){
				$('header').addClass('is-open');
				$('#navbar-main').fadeIn();
			}
			else {
				$('header').removeClass('is-open');
				$('#navbar-main').fadeOut();
			}



			// if ( $('.lang-mobile').hasClass('is-open') ){ //close language dropdown if open
			// 	$('.lang-mobile a').trigger('click')
			// }
			// if ( !$('header').hasClass('is-open')){
			// 	// opening: fade in bg then fade in items
			// }
			// else {
			// 	// closing: fade out items then bg
			// 	$('#navbar-main .navbar-container').fadeOut(500,function(){
			// 		$('header').removeClass('is-open');
			// 	});
			// }
		})
		// Languages
		$('.lang-mobile a').first().on('click',function(e){
			e.preventDefault();
			if ( $('header').hasClass('is-open') ){ //close large dropdown if open
				$('.menu-toggle').trigger('click')
			}

			$('.lang-mobile').toggleClass('is-open');
			// $('body').toggleClass('noscroll');

			$('.lang-mobile .dropdown').fadeToggle();
		})
		
		// Subnav
		// $('#navbar-main .navbar-item > .link a').on('click',function(e){ //submenus
			// var $parent = $(this).parent().parent();
			// if ( $('header').hasClass('is-open') && $parent.find('.dropdown').length ){
				// e.preventDefault();
				// if ( $parent.find('.dropdown:visible').length==0 ){
				// 	// close any and open this one
				// 	 $('header .dropdown').slideUp();
				// 	$parent.find('.dropdown').slideToggle();
				// }
				// else {
				// 	// close all
				// 	$('header .dropdown').slideUp();
				// }
			// }
		// })


		// WAYPOINTS - just show if we have scrolled past. effect depends on block type.
		if ( $('.block').length ){
			$('.block').each(function(i,v){
				var $c = $(this);
				var inview = new Waypoint.Inview({
					element: $c[0],
				  	enter: function(direction) {
				  		Content.viewed($c);
				  	}
				})
			})
		}


		// textarea 'copy to clipboard' buttons
		$('.copy-trigger').on('click',function(e){
			e.preventDefault();
			var $target = $( $(this).data('target') );
			if ( $target.length ){
				$target.select().addClass('is-copied');

    			document.execCommand('copy');

				setTimeout(function(){
					$target.removeClass('is-copied')
				}, 600);

			}
		})
		
	},
	closeNavDrop: function(){
		var $bg = $('#navbar-main .bg');
		$bg.css('height',0+"px") //close the dropdown bg
		setTimeout(function() {
		    $bg.removeClass('show')
		}, 200);
	},
	resize: function(){

		if ( Layout.isMobile()){ //make the menu fullscreen in mobile
			$('.navbar-container').height( $(window).height() - 100);
		}
		else {
			$('.navbar-container').height('');
		}
	},

}

var Content = {
	viewed: function( el ){
		// when you scroll past a block, activate any animation
		if ( !$(el).hasClass('is-viewed') ){
			$(el).addClass('is-viewed')

			Content.countUp(el)
		}

	},
	countUp: function(el){
		// count-up animation for stat-item blocks
		$(el).find('[data-countup]').each(function(){
			$(this).text('');
			var count = $(this).data('countup');
			var options = { separator: ',', decimal: '.' };
			switch ($('html').attr('lang').substring(0,2)) {
				case 'de': 
				case 'es':
				case 'nl':
				case 'pt':
				case 'vi':
				case 'it':
				case 'tr':
					options.separator = '.'; options.decimal = ','; break;
				case 'fr':
				case 'pl':
				case 'ru':
					options.separator = ' '; options.decimal = ','; break;
			}
			var decimals = 0;
			if (Math.floor(count) != count) {
				decimals = count.toString().split('.')[1].length || 0;
			}
			var numAnim = new CountUp($(this)[0], 0, count, decimals, 1.5, options);
			numAnim.start();
		})
	},
	downloadModal:function(){
		// open download infomodal w content for this class 

		$('.download-modal-trigger').on('click',function(e){
			e.preventDefault();

			$('#download-modal').modal('show');
			$('.download-modal-item').hide();

			if ( $( $(this).data('target') ).length ){
				$( $(this).data('target') ).show();
			}
		})
	}
}

var News = {
	init: function(){
		// carousel
		if ( $('.halfbanner .carousel .slide').length>1 ){
			var $cont = $('.halfbanner');
			$('.halfbanner .carousel').slick({
				dots:true,
				prevArrow:$cont.find('.carousel-prev'),
				nextArrow:$cont.find('.carousel-next')
			})
		}
		
	}
}

$(document).ready(function(){
	Layout.init();
	News.init();

	if ( $('.download-modal-trigger').length ){
		Content.downloadModal();
	}
})

$(window).load(function(){
	$('body').addClass('loaded');
	$(window).trigger('scroll').trigger('resize')
})


$(window).resize(function(){
	Layout.resize();
})

// Close menu when out of div 
if ($(window).width() < 990 || $(window).height() < 1000) {
$(document).mouseup(function(e){
   var header = $ (".header, .lang-mobile");
   var menu = $(".navbar, .dropdown");
   if (!menu.is(e.target) // The target of the click isn't the container.
   && menu.has(e.target).length === 0) // Nor a child element of the container
   {
      header.removeClass('is-open');
	  menu.hide(); 
   }
});
}
//Links for Tab
jQuery(function($){
  var hash = window.location.hash;
  hash && $('.nav.nav-tabs a[href="' + hash + '"]').tab('show'); 
  $('.nav.nav-tabs a').click(function (e) {
     $(this).tab('show');
     $('body').scrollTop();
     window.location.hash = this.hash;
  });
});

/* NEWSLETTER FORM SCRIPT SENDGRID */
const myForm = document.getElementById('dash-nl');
	const alertContainer = document.getElementById('warningDiv')
	const successContainer = document.getElementById('successDiv')
	const API_KEY = process.env.SENDGRID_API_KEY;
	
	myForm.addEventListener('submit', async function(e) {
		
		e.preventDefault();

		const formData = new FormData(this)

		function handleResponse(response) {
			if (!response.ok) {
				throw Error(alertContainer.innerHTML = response.statusText + " - " + response.status)
			} else {
				successContainer.style.display = 'block'
				alertContainer.style.display = 'none'
				
			}
			return response.json()
		}
		async function handleFetch(data) {
			const request = {
				method: 'PUT',
				headers: {
					'Content-Type': 'application/json',
					'Authorization': `Bearer ${API_KEY}`,
				},
				body: JSON.stringify(data)
			}
			await fetch("https://api.sendgrid.com/v3/marketing/contacts", request)
				.then(handleResponse)
				.then(result => console.log(result, "result"))
				.catch(error => console.log(error, "error"))
		}
		function handleSubmit() {
			const inputValues = Object.fromEntries(formData.entries());
			const data = {
				"list_ids": inputValues.list_ids = formData.getAll("list_ids"),
				"contacts": [{
					"email": inputValues.contacts = formData.get("contacts")
				}]
			}
			
			if (data.list_ids.length == 0) {
				alertContainer.innerHTML = "please choose a subscription type";
			} else {
				handleFetch(data)
				myForm.reset()
			}
		}
	await handleSubmit()
	});
