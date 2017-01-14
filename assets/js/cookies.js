$(document).ready(function(){
    
   if( $.cookies.test() ){
              
       // ADMIN BLOCK       
       var bAdmin_v = $.cookies.get( 'b_Admin_visibility' );
       
       if(null == bAdmin_v){
           
           if($('.adminControl').hasClass('active'))
               $.cookies.set('b_Admin_visibility','visible');
           else
               $.cookies.set('b_Admin_visibility','hidden');
                      
       }else{
           
           if(bAdmin_v == 'visible')
               $('.adminControl').addClass('active');
           else
               $('.adminControl').removeClass('active');
           
       }
       
       // EOF ADMIN BLOCK
       
       // Collapsible widgets
       $("div[class^=block]").each(function(){
           
           if($(this).attr('data-cookie')){
               
               var c_val = $.cookies.get( $(this).attr('data-cookie'));
               
                if(null !=  c_val){
                    
                    if(c_val == 'visible'){
                        $(this).parent('div[class^=span]').find('.head > .buttons li.toogle').removeClass('active');
                        $(this).show();
                    }else{
                        $(this).parent('div[class^=span]').find('.head > .buttons li.toogle').addClass('active');
                        $(this).hide();                    
                    }
                    
                }               
           }
           
       });       
       
       // eof Collapsible widgets
       
       
   }

});