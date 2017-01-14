$(document).ready(function(){
    
    $("div[class^='span']").find(".row-form:first").css('border-top', '0px');
    $("div[class^='span']").find(".row-form:last").css('border-bottom', '0px');            
    
    // collapsing widgets
    
        $(".toggle a").click(function(){
            
            var box = $(this).parents('[class^=head]').parent('div[class^=span]').find('div[class^=block]');
            
            if(box.length == 1){
                
                if(box.is(':visible')){        
                    
                    if(box.attr('data-cookie'))                    
                        $.cookies.set(box.attr('data-cookie'),'hidden');
                                        
                    $(this).parent('li').addClass('active');
                    box.slideUp(100);
                    
                }else{
                    
                    if(box.attr('data-cookie'))                    
                        $.cookies.set(box.attr('data-cookie'),'visible');
                                        
                    $(this).parent('li').removeClass('active');
                    box.slideDown(200);
                    
                }
            }
            
            return false;
        });
    
    // collapsing widgets
    
    // setting for list with button <<more>>
        
    var cList = 5; // count list items
    
    
    $(".withList").each(function(){

        if($(this).find('.list li').length > cList){
        
            $(this).find('.list li').hide().filter(':lt('+cList+')').show();
        
            $(this).append('<div class="footer"><button type="button" class="btn btn-small more">show more...</button></div>');
                        
        }
        
        if($(this).hasClass('scrollBox'))
                $(this).find('.scroll').mCustomScrollbar("update");
    });
    
    
    $(".more").live('click',function(){
        
        if(!$(this).hasClass('disabled')){
        
            cList = cList+5;

            var wl = $(this).parents('.withList');
            var list = wl.find('.list li');

            list.filter(':lt('+cList+')').show();

            if(list.length < cList) $(this).addClass('disabled');


            if($(wl).hasClass('scrollBox'))
                $(wl).find('.scroll').mCustomScrollbar("update");

        }
    });    
    // eof setting for list with button <<more>>
    
    
    
    $(".header_menu .list_icon").click(function(){
        
        var menu = $("body .wrapper .menu");
            
        if(menu.is(":visible")){
            menu.fadeOut(200);
            $("body > .modal-backdrop").remove();
        }else{
            menu.fadeIn(300);
            $("body").append("<div class='modal-backdrop fade in'></div>");
        }
        
        return false;
    });
    
    if($(".adminControl").hasClass('active')){
        $('.admin').fadeIn(300);
    }
    
    
    $(".adminControl").click(function(){
        
        if($(this).hasClass('active')){
            
            $.cookies.set('b_Admin_visibility','hidden');
            
            $('.admin').fadeOut(200);
            
            $(this).removeClass('active');
            
        }else{
            
            $.cookies.set('b_Admin_visibility','visible');
            
            $('.admin').fadeIn(300);
            
            $(this).addClass('active');
        }
        
    });
    
    
    $(".navigation .openable > a").click(function(){
        var par = $(this).parent('.openable');
        var sub = par.find("ul");

        if(sub.is(':visible')){
            par.find('.popup').hide();
            par.removeClass('active');            
        }else{
            par.addClass('active');            
        }
        
        return false;
    });
    
    $(".jbtn").button();
    
    $(".alert").click(function(){
        $(this).fadeOut(300, function(){            
                $(this).remove();            
        });
    });
    
    $(".buttons li > a").click(function(){
        
        var parent   = $(this).parent();
        
        if(parent.find(".dd-list").length > 0){
        
            var dropdown = parent.find(".dd-list");

            if(dropdown.is(":visible")){
                dropdown.hide();
                parent.removeClass('active');
            }else{
                dropdown.show();
                parent.addClass('active');
            }

            return false;
            
        }
        
    });


    $("#menuDatepicker").datepicker();
    
    
    $(".link_navPopMessages").click(function(){
        if($("#navPopMessages").is(":visible")){
            $("#navPopMessages").fadeOut(200);
        }else{
            $("#navPopMessages").fadeIn(300);
        }
        return false;
    });
    
    $(".link_bcPopupList").click(function(){
        if($("#bcPopupList").is(":visible")){
            $("#bcPopupList").fadeOut(200);
        }else{
            $("#bcPopupList").fadeIn(300);
        }
        return false;
    });    
    
    $(".link_bcPopupSearch").click(function(){
        if($("#bcPopupSearch").is(":visible")){
            $("#bcPopupSearch").fadeOut(200);
        }else{
            $("#bcPopupSearch").fadeIn(300);
        }
        return false;
    });        
    
    $("input[name=checkall]").click(function(){
    
        if(!$(this).is(':checked'))
            $(this).parents('table').find('.checker span').removeClass('checked').find('input[type=checkbox]').attr('checked',false);
        else
            $(this).parents('table').find('.checker span').addClass('checked').find('input[type=checkbox]').attr('checked',true);
            
    });    
    
    
    $(".fancybox").fancybox();

});

$(window).load(function(){
    gallery();
    thumbs();
    headInfo();    
});
$(window).resize(function(){
    headInfo();    
    
    if($("body").width() > 980){        
        $("body .wrapper .menu").show();            
        $("body > .modal-backdrop").remove();
    }else{
        $("body .wrapper .menu").hide();
        $("body > .modal-backdrop").remove();
    }    
    
});


$('.wrapper').resize(function(){
    
    if($("body > .content").css('margin-left') == '220px'){
        if($("body > .menu").is(':hidden'))
            $("body > .menu").show();
    }
    
    gallery();
    thumbs();
    headInfo();
});

function headInfo(){
    var block = $(".headInfo .input-append");
    var input = block.find("input[type=text]");
    var button = block.find("button");
    
    input.width(block.width()-button.width()-44);
    
}

function thumbs(){
    
    $(".thumbs").each(function(){        
        
        var maxImgHeight = 0;
        var maxTextHeight = 0;    
        
        $(this).find(".thumbnail").each(function(){
            var imgHeight = $(this).find('a > img').height();
            var textHeight = $(this).find('.caption').height();
            
            maxImgHeight = maxImgHeight < imgHeight ? imgHeight : maxImgHeight;
            maxTextHeight = maxTextHeight < textHeight ? textHeight : maxTextHeight;
        });
        
        $(this).find('.thumbnail > a').height(maxImgHeight);
        $(this).find('.thumbnail .caption').height(maxTextHeight);
    });
    

    
    var w_block = $(".thumbs").width()-20;
    var w_item  = $(".thumbs .thumbnail").width()+10;
    
    var c_items = Math.floor(w_block/w_item);
    
    var m_items = Math.floor( (w_block-w_item*c_items)/(c_items*2) );
    
    $(".thumbs .thumbnail").css('margin',m_items);

}

function gallery(){   

    var w_block = $(".gallery").width()-20;
    var w_item  = $(".gallery a").width();
    
    var c_items = Math.floor(w_block/w_item);
    
    var m_items = Math.round( (w_block-w_item*c_items)/(c_items*2) );    
    
    $(".gallery a").css('margin',m_items);
}

function loginBlock(block){
    
    $(".loginBlock:visible").animate({
        top: '200px',
        opacity: 0
    },'200','linear',function(){
        $(this).css('top','0px').css('display','none');
    });    
    $(block).css({opacity: 0, display: 'block',top: '0px'});    
    $(block).find('.checker').show();
    $(block).animate({opacity: 1, top: '100px'},'200');
}
