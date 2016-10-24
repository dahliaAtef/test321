/**

 * Frontend Class

 * @description Functions written by developers

 * @author Mahmoud Abdelnasser (des.mahmoud.abdelnasser@gmail.com)

 * @copyright (c) 2015 Digitree (http://digitreeinc.com), All Right Reserved.

 * @version 1.0.0

 */



/**

 * Global Namespace

 * @type {Object}

 */

var Frontend = Frontend || {};



/**

 * Runs when document is ready

 * @author Ahmed Sharaf (sharaf.developer@gmail.com)

 */

Frontend.onReady = function () {

    Frontend.mainInit();

    Frontend.tabsCustom();

    Frontend.globalEvents();

    //Frontend.formValdiation();
    Frontend.formValdiationSubscribe();


};



/**

 * Manages global application events.

 * @author Ahmed Sharaf (sharaf.developer@gmail.com)

 */

Frontend.globalEvents = function () {

    var self = this;

    

    

    self.contactFormSelector = function () {

        $(".contact-form form:not(#general-form)").hide();

        $('body').on('change', '#form-selector', function () {

            var selectedForm = $("#"+$(this).val());

            $(".contact-form form").hide();

            selectedForm.show();

        });

    };

    

    

    



    /* --------- 3ak el 3ak ----------*/



    self.aakKter = function() {

            // dropdown menu collapse
            $('li.sub-menu a').each(function(){
                $(this).click(function(e){
                    $('.sub-menu ul').toggleClass("open");
                     e.stopPropagation();
                })
                $(document).on('click', function(e){
                    //if(!$(e.target).hasClass("sub-menu-ul") )
                     // if (!$(e.target).is(".sub-menu-ul") || $(".sub-menu-ul").has(e.target).length ) 
                     if( !$(e.target).closest(".sub-menu-ul").length > 0 ) {
                           if ($('.sub-menu ul').hasClass("open")){
                                $('.sub-menu ul').removeClass("open");
                            }
                        }
                      
                    
                })
            })





    };





    



    self.aakKter();

    self.contactFormSelector();

    



}





/**

 * Re Initialize some components after ajax event.

 * @author Ahmed Sharaf (sharaf.developer@gmail.com)

 */

Frontend.reInit = function () {



};



/**

 * Initialize main components required to run the application

 * @author Ahmed Sharaf (sharaf.developer@gmail.com)

 */

Frontend.mainInit = function () {



    var self = this;



    self.gridScrollInit = function() {

        if($("#grid").length){

            new GridScrollFx( document.getElementById( 'grid' ), {

                viewportFactor : 0.4

            } );

        }

    };


    self.footerAdaptor = function() {
        var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
        var footerHieght = 58 ;
        var pageInsideHeight =  h - footerHieght ;   
        $('.page-content.inside , .page-content.outSide').css("min-height" , pageInsideHeight+"px" )
        

    };

    self.secTitleLine = function() {
        
        $(".title-box").each(function() {

           var titleBoxWidth = $(this).width();
           var secTitleWidth = $(".sec-title" , $(this)).width();
            $(".line-box", $(this)).width(titleBoxWidth - secTitleWidth -200);
        })
        


    };
    self.mobileHeader = function(){
        if($(window).width() < 700){
            $('body').addClass('mobile-view')
          }
    }
    

    self.gridScrollInit();
    self.footerAdaptor();
    self.secTitleLine();
    self.mobileHeader();

    //self.tabsAdapt();

};


    

Frontend.tabsCustom = function () {



    var self = this;



    self.tabsAdapt = function () {

        var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

        headerHeight = $('header.inside').height();

        $('.page-tabs').css("top" , headerHeight+"px" )

         tabsHeight = h - headerHeight;

         $('.tab-item').height(tabsHeight/7) ;

         tabItemHeight = tabsHeight/7 ;

        $('.tab-item i').each(function(){

             iconHeight = $(this).height();

             iconMargin = (tabItemHeight - iconHeight )/2;

            $(this).css("margin-top" , iconMargin +"px")

        });

        $('.page-tabs').removeClass("disappered");

    };

    

    

    self.tabsAdapt();

};



Frontend.formValdiation = function(){

            $("form").each(function(){
                var this_form = $(this);
                $("button" , this_form ).on("click" , function(){
                    function error_check(){
                        this_form.each(function(){
                            if ( $(this).find(".has_err").length > 0) {
                                $("button" , this_form ).removeClass().addClass("submit-error");
                            }
                            else{
                                $("button" , this_form).removeClass().addClass("submit-success");
                            }
                        })
                        window.setTimeout(function(){
                            $("button" , this_form).removeClass().addClass("btn");
                        }, 2000) 
                   };
                   window.setTimeout( error_check, 500 );
                    })
            })
                

        };

// Frontend.formValdiationSubscribe = function(){

//                 $("#btn-subsc").on("click" , function(){
//                     function error_check(){
//                         if ($("input[type='hidden']").val() == "success") {
//                             $("#btn-subsc").removeClass().addClass("submit-success");
//                             $(".card").addClass("appear");
//                         }
//                         else{
//                             $("#btn-subsc").removeClass().addClass("submit-error");
//                         }
//                         window.setTimeout(function(){
//                             $("#btn-subsc").removeClass().addClass("btn");
//                         }, 2000) 
//                    };
//                    window.setTimeout( error_check, 500 );
//                     })
                

//         };
Frontend.formValdiationSubscribe = function(){

				if ($("input[type='hidden']").val() == "success") {
                    $("#btn-subsc").removeClass().addClass("submit-success");
                    $(".card").addClass("appear").delay(1500);
                }
                /*window.setTimeout(function(){
                    $("#btn-subsc").removeClass().addClass("btn");
                }, 2000)*/
			/*$('subsc-form').on('pjax:success', function(event, data, status, xhr, options) {
				  // run "custom_success" method passed to PJAX if it exists
				  if(typeof options.custom_success === 'function'){
					   $("button" , this_form).removeClass().addClass("submit-success");
                       $(".card").addClass("appear").delay(1500);
				  }
			 });*/
/*
            $("form").each(function(){
                var this_form = $(this);
                $("button" , this_form ).on("click" , function(){
                    function error_check(){
                        this_form.each(function(){
                            if ( $(this).find(".has-error").length == 0) {
                                //alert("a700");
                                $("button" , this_form).removeClass().addClass("submit-success");
                                $(".card").addClass("appear").delay(3000);
                            }
                            else{
                                $("button" , this_form ).removeClass().addClass("submit-error");
                            }
                        })
                        window.setTimeout(function(){
                            $("button" , this_form).removeClass().addClass("btn");
                        }, 2000) 
                   };
                   window.setTimeout( error_check, 500 );
                    })
            })
*/    

        };



$(document).ready(function () {

    Frontend.onReady();

                 $('inner-page').css("visibility","hidden");
        

});

             $(window).load(function() {              

                 $('inner-page').css("visibility","visible");

                     $('#loadx').fadeOut(50);
                     $('#loadWh').fadeOut(750);
             });



//ajaxSuccess event callback  

$(document).ajaxSuccess(function (event, xhr, options) {

    Frontend.reInit();

});



$( window ).resize(function(){

    Frontend.tabsCustom();
   // Frontend.secTitleLine();

});



function myFunction() {
    $('ul.menu-list').toggleClass("responsive");
}

$(document).ready(function() {
    $('.special-title').text(function(index, currentText) {
        return currentText.substr(0, 90)+ ' ...';
    });
})
$(window).on("load",function(){
    $('.internal-content div').each(function(){
        if ( $(this).children().length > 0 ) {
            $('.internal-content > div > div').addClass("a7p")
        }        
    });
});