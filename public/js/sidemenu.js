$(function(){

    $('#slide-submenu').on('click',function() {                 
        $(this).closest('.list-group').fadeOut('slide',function(){
            $('.mini-submenu').fadeIn();    
        });
        
      });

    $('.mini-submenu').on('click',function(){       
        $(this).next('.list-group').toggle('slide');
        $('.mini-submenu').hide();
    })

    // $(window).resize(function(){
    //   if ($(window).width() >= 480){  
    //     $('.mini-submenu').hide();
    //   }
    //   if ($(window).width() <= 480){  
        
    //     $('.mini-submenu').fadeIn(); 
    //   }
    // });

})
