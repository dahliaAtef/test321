$(document).ready(function () {
			var wrap = $("#page-wrap");
			$(document).on("scroll", function(e) {
			  if ($(document).scrollTop() > $('header').scrollTop()) {
			    wrap.addClass("fix-header");
			  } else {
			    wrap.removeClass("fix-header");
			  }
			});

			$('.news-list-desc').each(function () {
				var txt = $(this).text();
				if(txt.length > 400){
			    	$(this).text(txt.substring(0,320) + '.....');
				}
			});
			// slide menu collapse
			$(".sideMenu .sub-menu a").click(function () {
    			$('.sideMenu .sub-menu ul').slideToggle();
    		});
    		$('.qtyplus').each(function () {
		    	$(this).click(function(e){
			        e.preventDefault();
			        fieldName = $(this).attr('field');
			        var currentVal = parseInt($('input[name='+fieldName+']').val());
			        if (!isNaN(currentVal)) {
			            // Increment
			            $('input[name='+fieldName+']').val(currentVal + 1);
			        } else {
			            // Otherwise put a 0 there
			            $('input[name='+fieldName+']').val(0);
			        }
			    });	
		    })
		    $(".qtyminus").click(function(e) {
		        e.preventDefault();
		        fieldName = $(this).attr('field');
		        var currentVal = parseInt($('input[name='+fieldName+']').val());
		        if (!isNaN(currentVal) && currentVal > 0) {
		            // Decrement one
		            $('input[name='+fieldName+']').val(currentVal - 1);
		        } else {
		            // Otherwise put a 0 there
		            $('input[name='+fieldName+']').val(0);
		        }
		    });

		    if ($("body").hasClass("ltr")) {
		    	$(".sideMenu").addClass("right");
		    }else{
		    	$(".sideMenu").addClass("left")
		    }
		    $(".mobile-menu").click(function () {
		    	if ($("body").hasClass("ltr")) {
			    	$("#page-wrap").toggleClass("goLeft");
			    }else{
			    	$("#page-wrap").toggleClass("goRight");
		    	}
		    })
		})
		// $(function() {
		//   $('a[href*="#"]:not([href="#"])').click(function() {
		//     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		//       var target = $(this.hash);
		//       target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		//       if (target.length) {
		//         $('html, body').animate({
		//           scrollTop: target.offset().top - 80
		//         }, 500);
		//         return false;
		//       }
		//     }
		//   });
		// });