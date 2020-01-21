<!-- DOCTYPE -->
<!DOCTYPE html>
<html lang="id-ID">
  <head>
  <?php include "joinc/seo.php"; ?>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.min.css">
	<link rel="stylesheet" href="assets/css/style.css?v=1">
	<link rel="icon" href="assets/images/icon.png">
	<link href="https://fonts.googleapis.com/css?family=Gochi+Hand&display=swap" rel="stylesheet"> 
	<script src="assets/js/jquery-3.4.1.min.js"></script>
  </head>
  <body>

  <?php include "joinc/header.php"; ?>
	<?php include "joinc/mainContents.php"; ?>
	<?php include "joinc/footer.php"; ?>

  <script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	<script  src="assets/js/magnific-popup.min.js"></script>
	<script  src="assets/js/jquery.ticker.js"></script>
	<script  src="assets/js/jquery.easing.min.js"></script>
	<script type="text/javascript">	
		function zoomImage(){
      jQuery('.zoom-image').magnificPopup({
        delegate: '.lightbox-img',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
          enabled: true,
          navigateByImgClick: true,
          preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
          tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
        }
     });
		}

		function zoomVideo(){	
			jQuery('.lightbox-video').magnificPopup({
				type: 'iframe',
			});
		}

		function validNumber(){
			$('.valid-number').keypress(function(event) {
		    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		      event.preventDefault();
		    }
		  });
		}
		
		$(window).on("scroll", function() {
	        var window_top = $(window).scrollTop() + 1;
	        var winWidht = $(window).width();
	        if (window_top > 300) {
	        	if ( winWidht > 991) {
			        var SidebarHeight = $('.sidebar-sticky').height();
			        var pageHeight = $('.page-result').height();
			        
			        if (SidebarHeight < pageHeight) {
			          $('.sidebar-sticky').addClass('open');
			        }
			      }
	    		}
	  	});
	  	var runtxt = $('.run-sticky').offset().top;
	  	var navh = $('.header-top .container').height();
        var lebar = $(window).width();

            $(window).scroll(function () {
                if ($(window).scrollTop() > runtxt) {
                	if (lebar> 991) {
	                    $('#run-sticky').css({
	                        position: 'fixed',
	                        zIndex:'999',
	                        // background:'#fff',
	                        left:'0',
	                        right:'0',
	                        top: 2*navh+'px' //70
	                    });                		
                	}
                	else{
                		$('#run-sticky').css({
	                        position: 'fixed',
	                        zIndex:'999',
	                        // background:'#fff',
	                        top: navh+'px' //70
	                    }); 
                	}
                } else {
                    $('#run-sticky').css({
                        position: 'static',
                        top: '0px'
                    });
                }
            });
		$(function(){
			zoomImage();
			zoomVideo();
			validNumber();
			$("#search-form-nav").on("submit", function(event) { 
		    event.preventDefault();
		    var key = $('input[name="keyword"]').val();
		    var keyword = key.replace(/\s/g , "-");
		    window.location.assign('souvenir?keyword='+keyword);
			});

			$('.location-not-souvenir').on('change', function(event) {
			  event.preventDefault();
			  var value = $(this).val();
		    window.location.assign('souvenir?location='+value);
			});
	
		 	$('.show-more-button').on('click', function (e) {
  			e.preventDefault();
  			$('.show-more').toggleClass('visible');
  		});

		})

		
		$(function(){
			var sync1 = $(".slider");
			var sync2 = $(".navigation-thumbs");

			var thumbnailItemClass = '.owl-item';

			var slides = sync1.owlCarousel({
				video:true,
			  items:1,
			  loop:false,
			  margin:0,
			  autoplay:false,
			  autoplayTimeout:6000,
			  autoplayHoverPause:false,
			  nav: true,
			  dots: false,
			  lazyLoad: true,
			  navText: [
		      '<i class="mdi mdi-chevron-left"></i>',
		      '<i class="mdi mdi-chevron-right"></i>'
		    ],
		    onInitialized  : counter, 
  			onTranslated : counter
			}).on('changed.owl.carousel', syncPosition);

			function counter(event) {
			  var element   = event.target;         
			  var items     = event.item.count;     
			  var item      = event.item.index + 1;    
			  if(item > items) {
			    item = item - items
			  }
			  jQuery(element).parent().find('#counter-item-slide').html(item + " / " + items);
			}

			function syncPosition(el) {
			  $owl_slider = $(this).data('owl.carousel');
			  var loop = $owl_slider.options.loop;

			  if(loop){
			    var count = el.item.count-1;
			    var current = Math.round(el.item.index - (el.item.count/2) - .5);
			    if(current < 0) {
			        current = count;
			    }
			    if(current > count) {
			        current = 0;
			    }
			  }else{
			    var current = el.item.index;
			  }

			  var owl_thumbnail = sync2.data('owl.carousel');
			  var itemClass = "." + owl_thumbnail.options.itemClass;


			  var thumbnailCurrentItem = sync2
			  .find(itemClass)
			  .removeClass("synced")
			  .eq(current);

			  thumbnailCurrentItem.addClass('synced');

			  if (!thumbnailCurrentItem.hasClass('active')) {
			    var duration = 300;
			    sync2.trigger('to.owl.carousel',[current, duration, true]);
			  }   
			}
			var thumbs = sync2.owlCarousel({
			  items:4,
			  loop:false,
			  margin:10,
			  autoplay:false,
			  nav: true,
			  dots: false,
			  navText: [
		      '<i class="mdi mdi-chevron-left"></i>',
		      '<i class="mdi mdi-chevron-right"></i>'
		    ],
			  responsive:{
			     0:{items:4},
			     479:{items:4},
			     768:{items:6},
			     979:{items:8},
			     1199:{items:8},
			   },
			  onInitialized: function (e) {
			    var thumbnailCurrentItem =  $(e.target).find(thumbnailItemClass).eq(this._current);
			    thumbnailCurrentItem.addClass('synced');
			  },
			})
			.on('click', thumbnailItemClass, function(e) {
			    e.preventDefault();
			    var duration = 300;
			    var itemIndex =  $(e.target).parents(thumbnailItemClass).index();
			    sync1.trigger('to.owl.carousel',[itemIndex, duration, true]);
			}).on("changed.owl.carousel");

			$('#owl-souvenir').owlCarousel({
	      pagination : true,
	      paginationNumbers: false,
	      autoplay: true,
	      loop:true,
	      margin:10,
	      nav:true,
	      dots:false,
	      navText: [
		      '<i class="mdi mdi-chevron-left"></i>',
		      '<i class="mdi mdi-chevron-right"></i>'
		    ],
	      responsive:{
	        0:{
              items:1
          },
          400:{
              items:2
          },
          600:{
              items:3
          },
          800:{
              items:4
          },
          1000:{
              items:4

	        }
	      }
	    })
		});
	
	$('.runing').ticker({
	});
	</script>

	
</body>
</html>