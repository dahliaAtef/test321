$(document).ready(function() {
			$('#fullpage').fullpage({
				sectionsColor: ['#fff', '#fff', '#fff', '#fff', '#fff'],
				anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', 'lastPage'],
				menu: '#menu',
				scrollingSpeed: 1000
			});
  
			$('li.sub-menu a').each(function(){
                $(this).click(function(e){
                    $('.sub-menu ul').toggleClass("open");
                     e.stopPropagation();
                })
                $(document).on('click', function(e){
                     if( !$(e.target).closest(".sub-menu-ul").length > 0 ) {
                           if ($('.sub-menu ul').hasClass("open")){
                                $('.sub-menu ul').removeClass("open");
                            }
                        }
                      
                    
                })
            })
		});
			


 $(window).bind('mousewheel touchmove', function(e) {
            if(e.originalEvent.wheelDelta / 120 > 0) {
                 $('.section-icon ,.section-info ,.indicator-line ').removeClass("active");
                 find_section_Active();
            } else {
                find_section_Active();
                $('.section-icon ,.section-info ,.indicator-line ').removeClass("active");
            }
            function find_section_Active (){
                $('.section').each(function(){
                    var this_section = $(this);
                    var rotate_degree ;
                    var this_item_gocricle ;


                    if (this_section.hasClass("active")) {
                        this_item_gocricle = $(this).attr("gocircle");
                        //console.log(this_item_gocricle);
                        $("#symbolsContainer").find("[id='" + this_item_gocricle + "']").attr('clicked', 'true').siblings().attr('clicked', 'false');

                        var section_id = this_section.attr("id");
                        if (section_id == "section1") {
                            rotate_degree = 32;                     
                        }
                        else if (section_id == "section2") {
                            rotate_degree = 104;                
                        }
                        else if (section_id == "section3") {
                            rotate_degree = 176;                
                        }
                        else if (section_id == "section4") {
                            rotate_degree = 248;                
                        }
                        else {
                            rotate_degree = 320;                
                        }

                        var rotate_css = "rotate(" + rotate_degree + "deg)";
                        $("svg#menu").css({
                          "-webkit-transform" : rotate_css,
                          "transform" : rotate_css,
                          "-webkit-transform-origin" : "50% 50%",
                          "transform-origin" : "50% 50%"
                        }); // to rotate menu on SCROLL

                        setTimeout(function() {  
                            var item_position = $("#itemsContainer").find("[gocircle='" + this_item_gocricle + "']");
                          
                          	var use_item = item_position[0].getElementsByTagName('use');
                          	var offsets = use_item[0].getBoundingClientRect();
                            var use_position_top = offsets.top;
                            var use_position_left = offsets.left;			
                            //console.log(use_position_top);
                            //console.log(use_position_left);
                            //var use_position_top = $('use', item_position).offset().top;
                            //var use_position_left = $('use', item_position).offset().left;
                          
                            $('.section-icon ,.section-info ,.indicator-line ').removeClass("active");
                          
                            $('.indicator-line',this_section).addClass("active").css({"top":use_position_top + 5 + "px","left":use_position_left + 8 + "px"});
                            $('.section-icon',this_section).addClass("active").css({"top":use_position_top - 15 + "px","left":use_position_left+ 28 + "px"});
                            $('.section-info',this_section).addClass("active").css({"top":use_position_top - 15 + "px","left":use_position_left+ 70 + "px"});
                            
                           
                        }, 1500);// to display content on SCROLL


                    }; 

                })
            }
        });
        // scroll



$(document).ready(function(){
            $(".item").each(function(){
                var this_item_gocricle ;
                
                $(this).hover(function(){
                    this_item_gocricle = $(this).attr("gocircle");
                    $("#symbolsContainer").find("[id='" + this_item_gocricle + "']").attr('hovered', 'true').siblings().attr('hovered', 'false');

                    var item_position = $("#itemsContainer").find("[gocircle='" + this_item_gocricle + "']");
                    var this_hovered_content =$("#hovered-sections").find("[gocircle='" + this_item_gocricle + "']");
                    var use_position_top = $('use', item_position).offset().top;
                    var use_position_left = $('use', item_position).offset().left;
                    $('.hovered-content').removeClass("active");
                    this_hovered_content.addClass("active").css({"top":use_position_top+ "px","left":use_position_left+ "px"});


                },function(){
                    this_item_gocricle = $(this).attr("gocircle");
                    $("#symbolsContainer").find("[id='" + this_item_gocricle + "']").attr('hovered', 'false');

                    $('.hovered-content').removeClass("active");
                }); // hovering

                $(this).click(function(){
                    $('.section-icon ,.section-info ,.indicator-line ').removeClass("active");
                    var this_item = $(this).attr("tabindex");
                    this_item_gocricle = $(this).attr("gocircle");
                    $("#symbolsContainer").find("[id='" + this_item_gocricle + "']").attr('clicked', 'true').siblings().attr('clicked', 'false');
                    var rotate_clicked ;
                    if (this_item == "1") {
                        rotate_clicked = 32;                    
                    }
                    else if (this_item == "2") {
                        rotate_clicked = 104;               
                    }
                    else if (this_item == "3") {
                        rotate_clicked = 176;               
                    }
                    else if (this_item == "4") {
                        rotate_clicked = 248;               
                    }
                    else {
                        rotate_clicked = 320;               
                    }

                    var rotate_css_clicked = "rotate(" + rotate_clicked + "deg)";
                    $("svg#menu").css({
                      "-webkit-transform" : rotate_css_clicked,
                      "transform" : rotate_css_clicked,
                      "-webkit-transform-origin" : "50% 50%",
                      "transform-origin" : "50% 50%"
                    });     // to rotate menu on CLICK      
                    
                    setTimeout(function() {  
                                var item_position = $("#itemsContainer").find("[gocircle='" + this_item_gocricle + "']");
                                var this_section =$("#fullpage").find("[gocircle='" + this_item_gocricle + "']");
                      
                      			var use_item = item_position[0].getElementsByTagName('use');
                                var offsets = use_item[0].getBoundingClientRect();
                                var use_position_top = offsets.top;
                                var use_position_left = offsets.left;	
                      				
                      			//var offsets =  $('use', item_position).getBoundingClientRect();
                                //var use_position_top = offsets.top;
                                //var use_position_left = offsets.left;			
                      
                                //var use_position_top = $('use', item_position).offset().top;
                                //var use_position_left = $('use', item_position).offset().left;

                                $('.section-icon ,.section-info ,.indicator-line ').removeClass("active");
                                $('.indicator-line',this_section).addClass("active").css({"top":use_position_top + 5 + "px","left":use_position_left + 8 + "px"});
                                $('.section-icon',this_section).addClass("active").css({"top":use_position_top - 15 + "px","left":use_position_left+ 28 + "px"});
                                $('.section-info',this_section).addClass("active").css({"top":use_position_top - 15 + "px","left":use_position_left+ 70 + "px"});

                            }, 1500);// to display content on CLICK
                    
                }); 


            })
            
        });


        $(window).on('load', function () {
          
          var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
          var svgHeight = $('svg#menu').outerHeight();
          var svgImgHeight = $('#svg-img').outerHeight();
          $('svg#menu').css({"top" :  ((h-svgHeight)/2) +"px"});
          $('#svg-img').css({"top" :  ((h-svgImgHeight)/2) +"px"});
          
          $('#page-wrap').css("visibility","visible");
          $('#load').addClass("animated fadeOut").css("display","none");
          $('#loadx').addClass("animated zoomOut");
          $("#menu").addClass('start');
          
            setTimeout(function() {  
                $("#menu").addClass('startRotate');
                $('#icon-1').attr('clicked', 'true');
                setTimeout(function() { 
                  var offsets = document.getElementById('nav-1').getBoundingClientRect();
                  var first_use_position_top = offsets.top;
                  var first_use_position_left = offsets.left;
                  
                    //var first_use_position_top = $('#nav-1').offset().top;
                    //var first_use_position_left = $('#nav-1').offset().left;
					//console.log(first_use_position_top);
                    //console.log(first_use_position_left);
                    $('#section1 .indicator-line').addClass("active").css({"top":first_use_position_top + 5 + "px","left":first_use_position_left + 8 + "px"});
                    $('#section1 .section-icon').addClass("active").css({"top":first_use_position_top - 15 + "px","left":first_use_position_left+ 28 + "px"});
                    $('#section1 .section-info').addClass("active").css({"top":first_use_position_top - 15 + "px","left":first_use_position_left+ 70 + "px"});

                    $("header").addClass('active');
                    $("footer").addClass('active');
                }, 1800);
            }, 1700); // for first slide 
          
          
  			if($(window).width() < 700){
              $('body').addClass('mobile-view');
              $('#section1 .section-icon , #section1 .section-info').addClass("active");
            };
          
         });
function toggleMenu() {
    $('ul.menu-list ,  header.mobile').toggleClass("responsive");
};

$( window ).resize(function() {
  
});
      