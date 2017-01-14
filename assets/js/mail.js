$(document).ready(function(){
    
    $(".sNavigation ul a").click(function(){
        
        var item = $(this).parent('li');
        var show = $(this).attr('href');
        
        if(!$(show).is(':visible')){
            $(".sNavigation ul li").removeClass('active');
            item.addClass('active');
            
            $("#mails > div[class^=block]").hide();
            $(show).find('.checker').show();
            $(show).slideDown(100);
            
        }
        return false;
    });
    
    $(document).on('click','.mails_show',function(){
        
        var mID = '#'+$(this).attr('data-show');
        
        if(mID == '#')return false;                
        
        $("#mail_from").html($(mID).find('.from').html());
        $("#mail_to").html($(mID).find('.to').html());
        $("#mail_attach").html($(mID).find('.attach').html());
        $("#mail_body").html($(mID).find('.body').html());
        
        $('#preview_mail').modal('show');
        
        return false;        
                
    });
    
    $('#preview_mail').on('hidden', function () {
        $("#mail_from").html(' ');
        $("#mail_to").html(' ');
        $("#mail_attach").html(' ');
        $("#mail_body").html(' ');        
    });    
    
});
    