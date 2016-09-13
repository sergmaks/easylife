/****   Custom JQuery  *****/
        
        var footerShowed = false;
        
        // Select right size of background images in slider
        function chooseSize(){
            var folder; // folder for choosing images
            var slidesCount = $('.back').size(); // number of carousel slides
            
            if ( $(window).width() < 1200 )
                folder = 'middle';
            else if ( $(window).width() < 1600 )
                folder = 'large';
            else if ( $(window).width() < 2000 )
                folder = 'x-large';
            else folder = 'xx-large';
            
            //alert(folder);
        }
        
        // Set the carousel height to the user screen height without header
        function setCarouselHeight(){
            $('.back').css({
                height: ($(document).height() - 
                         $('#top-bar').outerHeight() - 
                         $('#nav-bar').outerHeight()) + "px"
                           })
        }
        
        // Show info footer by scrolling down to the end of the page
        function showFooter(){
            $('#footer').slideDown();
            $('html, body').animate( { scrollTop: $(window).height() }, 2000 );
            $('#button-up').show();
            footerShowed = true;
        }
        
        function hideFooter(){
            $('#footer').slideUp(1000);
            $('#button-down').show();
            footerShowed = false;
        }
        
        // Enable Bootstrap tooltips and Set initial carousel height
        $(document).ready(
            function(){
                //$("#attention").remove(); // Delete JS warning
                $('[data-toggle="tooltip"]').tooltip(); 
                setCarouselHeight();
            });
        
        
        // Window events: 
        // Set carousel height when the window is resized

        $(window).resize(
            function(){
                if ( $(window).height() > 600 ) {
                    $('.back').css({
                        height: ( $(window).height() - 
                                  $('#top-bar').outerHeight() - 
                                  $('#nav-bar').outerHeight()) + "px"
                                  })
                    }
                    });
        
        // Hide footer when the window is scrolled to the top
        $(window).scroll(function(){
            if ( ($(window).scrollTop() == 0) 
                && (footerShowed == true) )  
                                            hideFooter();
         });
        
        // Buttons Down and Up events:
        $('#button-down').click(function (){
            $(this).hide();
            showFooter();
        });
        
         $('#button-up').click(function(){
             $(this).hide();
             hideFooter();
         });
