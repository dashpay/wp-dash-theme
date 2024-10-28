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

$(document).ready(function() {
    // Main Menu Toggle
    $('.menu-toggle').on('click', function(e) {
        e.preventDefault();
        
        if ($('header').hasClass('is-open')) {
            // Menu is open, so close it
            $('header').removeClass('is-open');
            $('#navbar-main').hide();
            // Ensure submenus are collapsed
            $('#navbar-main .navbar-item').removeClass('dropdown-open');
        } else {
            // Menu is closed, so open it
            $('header').addClass('is-open');
            $('#navbar-main').show();
        }
    });

    // Languages Toggle
    $('.lang-mobile .link').on('click', function(e) {
        e.preventDefault();

        var $langMobile = $(this).closest('.lang-mobile');

        // If the current dropdown is open, close it
        if ($langMobile.hasClass('is-open')) {
            $langMobile.removeClass('is-open');
            $langMobile.find('.dropdown').hide();
        } else {
            // Close any other open dropdowns
            $('#navbar-main .navbar-item').removeClass('dropdown-open');
            $('.lang-mobile').removeClass('is-open');
            $('.lang-mobile .dropdown').hide();

            // Open the clicked dropdown
            $langMobile.addClass('is-open');
            $langMobile.find('.dropdown').show();
        }
    });

    // Subnav Toggle
    $('#navbar-main .navbar-item > .link').on('click', function(e) {
        var $parent = $(this).closest('.navbar-item');
        
        if ($('header').hasClass('is-open') && $parent.find('.dropdown').length) {
            e.preventDefault();
            
            // Close other open submenus
            $('#navbar-main .navbar-item').not($parent).removeClass('dropdown-open');
            
            // Toggle the visibility of the current submenu
            if (!$parent.hasClass('dropdown-open')) {
                $parent.addClass('dropdown-open');
            } else {
                $parent.removeClass('dropdown-open');
            }
        }
    });
});

		


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
// Road Map
$(document).ready(function() {
    if ($('#road-map').length > 0) {
        $('html, body').animate({
            scrollTop: $('#update').offset().top
        }, 'slow'); 
    }
});
/* Slider */
jQuery(document).ready(function($){
    // Initialize first slider
	$('.slider-for').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		dots: false,
		arrows: false,
		fade: false,
		infinite: true,  
		autoplay: true,  
		autoplaySpeed: 0,  
		speed: 8000,  
		cssEase: 'linear', 
		responsive: [
			{
				breakpoint: 900,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					dots: false
				}
			}
		]
	});
    // Initialize second slider
    $('.slider-testimonial').slick({
        dots: false,
		arrows:false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
		responsive: [
			{
			  breakpoint: 600,
			  settings: {
				dots: true
			  }
			}
		]
    });
  });
/* NEWSLETTER FORM SCRIPT SENDGRID 
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
*/
