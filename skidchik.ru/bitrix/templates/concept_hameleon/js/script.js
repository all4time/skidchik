var site_id = "";
var cur_pos = 0;
var btn_type = "";
var sect = "";
var ib = "";
var customEvent = false;


var lazyController = false,
    parentContainerSlide = {},
    parent = {},
    flagSlider = 0,
    arImagesLazyload = {};

var paramsLazy = {
    scrollDirection: 'vertical',
    threshold: 500,
    visibleOnly: true,
    effect: 'fadeIn',
};


function addGoal(action){

    if(typeof globalGoalsHam !== "undefined")
    {
        if(globalGoalsHam[action])
            $('body').append(globalGoalsHam[action]);
    }
}
function showProcessLoad()
{
    $('.google-spin-wrapper').addClass('active');
}
function closeProcessLoad()
{
    $('.google-spin-wrapper').removeClass('active');
}

function startBlurWrapperContainer()
{
    $('body').addClass('modal-open');
    $('.wrapper').addClass('blur');
}
function stopBlurWrapperContainer()
{
    $('body').removeClass('modal-open');
    $('.wrapper').removeClass('blur');
}

function generateMaps(container){
    var mapBlock = $(".iframe-map-area", container);

    if(mapBlock.length>0)
    {
        mapBlock.each(
            function(index, element)
            {
                $(element).after($(element).attr("data-src"));
                $(element).remove();
            }
        ); 
    }
}
function generateVideos(container){

    var videoBlock = $(".iframe-video-area", container);

    if(videoBlock.length>0)
    {
        videoBlock.each(
            function(index, element)
            {
                $(element).after($(element).attr("data-src"));
                $(element).remove();
            }
        ); 
    }
}

function updateLazyLoad(){
    $('.lazyload').Lazy(
        {
            scrollDirection: 'vertical',
            threshold: 500,
            visibleOnly: true,
            effect: 'fadeIn',
            afterLoad: function(element)
            {

                parent = $(element).parent();
                parentContainerSlide = parent.find('.parent-slider-item-js');

                if($(element).hasClass("slider-start"))
                {

                    if(typeof arImagesLazyload["id"+$(element).attr("data-id")] === "undefined") 
                        arImagesLazyload["id"+$(element).attr("data-id")] = {"s": 0, "f": 0, "type": null};

                    arImagesLazyload["id"+$(element).attr("data-id")].s = 1;

          
                    arImagesLazyload["id"+$(element).attr("data-id")].type = parentContainerSlide;

                }


                if($(element).hasClass('slider-finish'))
                {

                    if(typeof arImagesLazyload["id"+$(element).attr("data-id")] === "undefined") 
                        arImagesLazyload["id"+$(element).attr("data-id")] = {"s": 0, "f": 0, "type": null};
                    
                    arImagesLazyload["id"+$(element).attr("data-id")].f = 1;
                    arImagesLazyload["id"+$(element).attr("data-id")].type = parentContainerSlide;

                }

                if($(element).hasClass('slider-finish') || $(element).hasClass("slider-start"))
                {
                    for (key in arImagesLazyload){
                        
                        if(arImagesLazyload[key].s == 1 && arImagesLazyload[key].f == 1)
                        {
                            /*if( arImagesLazyload[key].type.hasClass('first-slider') && !arImagesLazyload[key].type.hasClass('slider-init'))
                                initFSlider(arImagesLazyload[key].type);*/

                            controllerSliders(arImagesLazyload[key].type);

                            delete arImagesLazyload[key];
                        }
                    }
                }
                
                

                if($(element).parents(".parent-video-bg").find(".videoBG").length>0)
                    correctSizeVideoBg($(element).parents(".parent-video-bg").find(".videoBG"));
                
                if($(element).hasClass('map-start'))
                    generateMaps($(element).parents("div.block"));

                if($(element).hasClass('video-start'))
                    generateVideos($(element).parents("div.block"));

                if($(element).hasClass('videoBG-start'))
                    generateVideoBG($(element).parents("div.block"));

                if($(element).hasClass('videoBG-start-fb'))
                    generateVideoBG($(element).parents("div.first-block"));
            }
        }
    );
}

function scrollToBlock(dist){
    var moreDist = 30;


    if ($('header').hasClass("slide"))
        moreDist = 70;



    var destinationhref = parseInt($(dist).offset().top - moreDist);

    $("html:not(:animated),body:not(:animated)").animate({
        scrollTop: destinationhref
    }, 1000, "linear", function() {

        setTimeout(
            function(){

                if( 100 < Math.abs(parseInt($(dist).offset().top - moreDist) - destinationhref) )
                {
                    $("html:not(:animated),body:not(:animated)").animate({
                        scrollTop: parseInt($(dist).offset().top)
                    }, 300, "linear");       
                }
         }, 300
        ); 
      }
    );

}


function parseCount(newVal, step, minVal){


    var ost = newVal % step;
    var step_ = step - ost;

    newVal = newVal - minVal;
    newVal -= (newVal % step);

    if(step_ >= ost)
    {
        newVal += minVal;
    }

    else
    {
        newVal += minVal + step;
    }


    if (newVal <= minVal || isNaN(newVal))
        newVal = minVal;

    return newVal;
}

function formatNum(val){
    val = String(val).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ');
    return val;
}

function openBox(from_mod_cat){

    if (from_mod_cat != "Y"){
        $('body').addClass('modal-open');
        $('.wrapper').addClass('blur');
    }

    if (from_mod_cat == "Y")
        $(".wrap-modal.open").addClass('blur');

    $('.no-click-block').addClass('double');
    $('div.box-parent').addClass('open');

    var cartOut = setTimeout(
        function(){
            $('div.box-parent').addClass('on');
            clearTimeout(cartOut);
        }, 200
    ); 

    $('.lazyload', 'div.box-parent').each(
        function(index, element)
        {
            $(element).attr("src", $(element).attr("data-src"));
            $(element).removeAttr('data-src');
        }
    );
}

function updateBox(button, countBox, idboxEl, action, other_complect, redirect){

    var from_mod_cat = "N";

    site_id = $("input.site_id").val();
    sect = $("input.sect").val();
    

    if ($(".wrap-modal").hasClass('open'))
        from_mod_cat = "Y";

    $.ajax({
        method: 'POST',
        url: '/bitrix/templates/concept_hameleon/ajax/cart/cart.php',
        dataType: 'json',
        data:{
            idboxEl: idboxEl,
            countBox: countBox,
            sect: sect,
            site_id: site_id,
            action: action,
            other_complect: other_complect
        },
        success: function(json){

            callToBox("products", "N", action, button);
            callToBox("info_table", "N", action, button);
            callToBox("mini_cart", from_mod_cat, action);
            callToBox("mini_cart_mob", "N", action);


            if (action == "add"){

                if (button.hasClass('added') || button.parents(".catalog-block").hasClass('first-click-box')){

                    var addOut = setTimeout(
                        function(){

                            openBox(from_mod_cat);

                            if (button.parents(".catalog-block").hasClass('first-click-box'))
                                $(".catalog-block").removeClass('first-click-box');

                            clearTimeout(addOut);

                        }, 350);
                }

                $(".click_box[data-box-id=" + idboxEl + "]").addClass('added');

            }


            if (action == "delete")
                $(".click_box.added[data-box-id='" + button.attr("data-box-id") + "']").removeClass('added');

            if (action == "clear")
            {
                $(".click_box.added").removeClass('added');
                if(device.ios()){
                    $("body").removeClass("modal-ios");
                    window.scrollTo(0, cur_pos);
                }
            }


            if (json.EMPTY == "Y"){

                if (!$(".wrap-modal.open").hasClass('blur')){
                    $('body').removeClass('modal-open');
                    $('.wrapper').removeClass('blur');
                }

                if ($(".wrap-modal.open").hasClass('blur'))
                    $(".wrap-modal.open").removeClass('blur');

                $('div.box-parent').removeClass('on');
                $('.no-click-block').removeClass('double');
                $('.first-click-box-on').addClass('first-click-box');

                var addOut2 = setTimeout(
                    function(){
                        $('div.box-parent').removeClass('open');
                        clearTimeout(addOut2);
                    }, 700
                );

            }

            if(redirect.length > 0)
            {
                location.href = redirect;
            }


        }
    });

    
}

function callToBox(templ, modal_mode, action, button){

    var preload = false;
    site_id = $("input.site_id").val();
    sect = $("input.sect").val();
    
    if (typeof(button) != "undefined" && typeof(action) != "undefined" && (action == "update" || action == "delete"))
    {
        $(".total-parent-preload-circleG").addClass('active');
        preload = true;

        if(action == "update")
            button.parents(".parent-preload-circleG-wrap").find(".parent-preload-circleG").addClass('active');       
    }

    $.post('/bitrix/components/concept/hameleon_cart/ajax.php',{
            templ: templ,
            sect: sect,
            site_id: site_id,
            modal_mode: modal_mode,
            link_empty_box: link_empty_box
        },

        function(html){

            if(preload)
            {
                var ctbOut = setTimeout(
                    function(){
                        $(".area_for_" + templ).html(html);
                        $('.lazyload').Lazy(paramsLazy);
                        clearTimeout(ctbOut);
                    }, 800);
            }
            else
            {
                $(".area_for_" + templ).html(html);
                $('.lazyload').Lazy(paramsLazy);
            }
        }
    );

    
}

function getChar(evt){

    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 46 || charCode > 57)) {
        return null;
    }
    return true;
}

function timerCookie(form){
    var timeout = true;
    var timer = form.find('input.timerVal').val();
    var forCookieTime = parseFloat(form.find('input.forCookieTime').val());
    var totalTime = 0;
    var mainTime = new Date().getTime();
    var idElem = form.find('input#element').val();
    var idSect = form.find('input.idSect').val();
    var firstEnter = BX.getCookie('_hamelFirstEnter' + idSect + idElem);
    var firstEnterVal = BX.getCookie('_hamelFirstEnterVal' + idSect + idElem);

    var cookieOut = setTimeout(
        function(){
            form.css('min-height', form.outerHeight());
            clearTimeout(cookieOut);
        }, 100);

    form.find('.hameltimer').addClass('active');

    if(forCookieTime <= 0)
        forCookieTime = 1;


    if (typeof(firstEnter) == "undefined" || firstEnterVal != timer){
        BX.setCookie('_hamelFirstEnter' + idSect + idElem, mainTime,{
            expires: forCookieTime * 60 * 60
        });
        BX.setCookie('_hamelFirstEnterVal' + idSect + idElem, timer,{
            expires: forCookieTime * 60 * 60
        });
        firstEnter = BX.getCookie('_hamelFirstEnter' + idSect + idElem);
        firstEnterVal = BX.getCookie('_hamelFirstEnterVal' + idSect + idElem);
    }

    totalTime = ((mainTime - firstEnter) / 1000).toFixed();

    if (totalTime < timer * 60)
        timer = timer * 60 - totalTime;

    else{
        timeout = false;
    }



    if (timeout)
        form.find('.hameltimer').countdown({
            until: timer,
            format: 'HMS',
            onExpiry: liftOff,
            layout: form.find('.hameltimer').html()
        }, $.countdown.regionalOptions['ru']);

    else{
        form.find('.questions').removeClass('active');
        form.find('.timeout_text').addClass('active');
    }


    function liftOff(){
        form.find('.questions').removeClass('active');
        form.find('.timeout_text').addClass('active');
    }

    
}


Share = {
    vkontakte: function(purl, ptitle, pimg, text){
        url = 'http://vkontakte.ru/share.php?';
        url += 'url=' + encodeURIComponent(purl);
        url += '&title=' + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&image=' + encodeURIComponent(pimg);
        url += '&noparse=false';
        Share.popup(url);
    },
    facebook: function(purl, ptitle, pimg, text){
        url = 'https://www.facebook.com/sharer/sharer.php?';
        url += '&title=' + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&u=' + encodeURIComponent(purl);
        url += '&picture=' + encodeURIComponent(pimg);
        Share.popup(url);
    },
    twitter: function(purl, ptitle){
        url = 'http://twitter.com/share?';
        url += 'text=' + encodeURIComponent(ptitle);
        url += '&url=' + encodeURIComponent(purl);
        url += '&counturl=' + encodeURIComponent(purl);
        Share.popup(url);
    },


    popup: function(url){
        window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
    }
};



var link_empty_box = $("input.link_empty_box").val();



function controllerSliders(obj)
{
    if(obj)
    {
        if(!obj.hasClass('slider-init'))
        {
            if( obj.hasClass('advantages-big-slide'))
                initAdvantagesBigSlider(obj);

            if( obj.hasClass('advantages-small-slide'))
                initAdvantagesSmallSlider(obj);

            if( obj.hasClass('slider-gallery'))
                initGallerySlider(obj);

            if( obj.hasClass('slider-services'))
                initServiceSlider(obj);

            if( obj.hasClass('opinion-slider'))
                initOpSlider(obj);

            if( obj.hasClass('tariff-flat'))
                initTariffsElements(obj);
        }
    }
}

function setChangerBlocks() {
    $("div.changer-blocks").each(
        function()
        {
            var block = $(this);
            
            $("div.changer-link-js", block).each(
                function(index, value)
                {
                    var arIds = $(this).attr("data-id").split(",");

                    if(arIds)
                    {
                        for (var i = 0; i < arIds.length; i++) {

                            if($(this).hasClass("active"))
                            {
                                $("div#block"+arIds[i]).removeClass("hidden");
                                $('.lazyload').Lazy(paramsLazy);

                                var obj = $("div#block"+arIds[i]).find(".parent-slider-item-js");

                                controllerSliders(obj);
                            }
                            
                        }
                    }
                    
                }
            );
        }
    );
    
    
    $("div.changer-link-js").click(
        function()
        {
            var block = $(this).parents("div.changer-blocks");
            
            $("div.changer-link-js", block).removeClass("active");
            $(this).addClass("active");
            
             $("div.changer-link-js", block).each(
                function(index, value)
                {
                    var arIds = $(this).attr("data-id").split(",");

                    if(arIds)
                    {
                        for (var i = 0; i < arIds.length; i++) {
                            $("div#block"+arIds[i]).addClass("hidden");
                        }
                    }
                    
                }
            );

            var arIds = $(this).attr("data-id").split(",");

            if(arIds)
            {
                for (var i = 0; i < arIds.length; i++) {
                    $("div#block"+arIds[i]).removeClass("hidden");
                    $('.lazyload').Lazy(paramsLazy);
                    var obj = $("div#block"+arIds[i]).find(".parent-slider-item-js");
                    controllerSliders(obj);
                }
            }
            
            

            
        }
    );
}

$(document).ready(
    function(){

        if ( $(window).width() >= 991 )
            $(".slide-hidden-lg").remove();
        
        else
        {
            $(".slide-hidden-xs").remove();
        }

        /*if ( $(window).width() >= 768)
            $('div.wrap-first-slider.visible-xs').remove();
        

        if ( $(window).width() < 768)
            $('div.wrap-first-slider.hidden-xs').remove();*/



        if(device.ios())
            $('div.block.parallax-attachment').removeClass('parallax-attachment');
        
        

        link_empty_box = $("input.link_empty_box").val();
        cur_pos = $(document).scrollTop();

        if ($(window).width() < 767)
        {
            var anim_callmob_in = setTimeout(
            function(){
                $(".callphone-desc").show().addClass('active');
                clearTimeout(anim_callmob_in);
            }, 5000);

            var anim_callmob_out = setTimeout(
            function(){
                $(".callphone-desc").removeClass('active');
           
                clearTimeout(anim_callmob_out);
            }, 12000);

            var anim_callmob_out2 = setTimeout(
            function(){
                $(".callphone-desc").hide();
           
                clearTimeout(anim_callmob_out2);
            }, 12500);
        }
        
        if ($(window).width() > 767){
            new WOW().init();
            $(window).enllax();

            var wow = new WOW({
                boxClass: 'parent-animate',
                animateClass: 'animated',
                offset: 0,
                mobile: true,
                live: true,
                callback: function(box){
                    var sec = 0;

                    $("div.child-animate", box).each(
                        function(){
                            var elem = $(this);

                            var wowOut = setTimeout(
                                function(){
                                    elem.removeClass("opacity-zero").addClass("animated fadeIn");
                                    clearTimeout(wowOut);

                                }, sec);

                            sec += 500;

                        }
                    );
                },
                scrollContainer: null
            });
            wow.init();
        }

        $('[data-toggle="tooltip"]').tooltip({
                    html:true,
                    container: "body"
                }); 

        if ($(window).width() > 767){
            var scrllOut = setTimeout(
                function(){
                    $('div.down-scroll').addClass('active');
                    clearTimeout(scrllOut);
                }, 2500);
        }

        

        updateLazyLoad();


        $('.slider-news').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: false,
            infinite: false,
            centerPadding: 0,
            centerMode: false,
            adaptiveHeight: false,
            focusOnSelect: false,
            responsive: [{

                    breakpoint: 1200,
                    settings:{
                        slidesToShow: 3,
                        infinite: true,
                    }

                },{

                    breakpoint: 991,
                    settings:{
                        slidesToShow: 2
                    }

                },
               {

                    breakpoint: 767,
                    settings:{
                        slidesToShow: 1

                    }

                },
               {

                    breakpoint: 0,
                    settings: "unslick" 

                }]
        });


        if ($(window).width() > 1200){

            $('.elem-hover').hover(

                function(){
                    var total = parseInt($(this).find('.elem-hover-height-more').css('margin-bottom')) + $(this).find('.elem-hover-height').outerHeight(true);
                    $(this).css({
                        'height': total + 'px'
                    });
                    $(this).find('div.elem-hover-show').slideDown(150);
                },

                function(){
                    $(this).find('div.elem-hover-show').slideUp(100);
                }

            );

        }

        $("form.timer_form").each(
            function(){
                timerCookie($(this));
            }
        );
        /* open contacts on hover*/
        if ($(window).width() >= 1200){
            $('header .main-phone div.element.phone').hover(
                function(){
                    var itThis = $(this);

                    $.data(this, 'timer', setTimeout($.proxy(function(){

                        $(itThis).parents(".main-phone").find('.list-contacts').stop(true, true).addClass('open');

                    }, this), 300));


                },
                function(){
                    clearTimeout($.data(this, 'timer'));
                });


            $('header .main-phone div.ic-open-list-contact.open-list-contact').hover(
                function(){

                    var itThis = $(this);

                    $.data(this, 'timer', setTimeout($.proxy(function(){

                        $(itThis).parents(".main-phone").find('.list-contacts').stop(true, true).addClass('open');

                    }, this), 300));


                },
                function(){

                    clearTimeout($.data(this, 'timer'));

                });


            $('header .list-contacts').hover(
                function(){},
                function(){
                    $(this).removeClass('open');
                });

        }
        else{

            $('header .main-phone div.element.phone').click(
                function(){
                    var itThis = $(this);
                    $(itThis).parents(".main-phone").find('.list-contacts').stop(true, true).addClass('open');
                }
            );


            $('header .main-phone div.ic-open-list-contact.open-list-contact').hover(
                function(){
                    var itThis = $(this);
                    $(itThis).parents(".main-phone").find('.list-contacts').stop(true, true).addClass('open');

                }
            );


            $(document).mouseup(
                function(e){
                    var div = $("header .list-contacts");

                    if (!div.is(e.target) && div.has(e.target).length === 0 && div.hasClass("open")){
                        div.removeClass('open');

                    }
                }
            );

        }


        if ($(window).width() > 1024){


            $('.services').find('.service-item').hover(

                function(){
                    var element_height = $(this).find('.service-element').height();
                    var element_bot_height = $(this).find('.bot-wrap').height();
                    var need_height = element_height - element_bot_height;
                    $(this).css({
                        'height': need_height + 'px'
                    });
                },

                function(){
                    $(this).css({
                        'height': 'auto'
                    });
                }

            );

        }
        else{
            $('.services').find('.service-item').hover(
                function(){
                    $(this).css({
                        'height': 'auto'
                    });
                }
            );
        }


        /* slider*/

        if($("div").is(".slider-services"))
        {

            function slide_animation_out(slider){

                var animOut = setTimeout(function(){
                    slider.find('.slick-current .image-wrap img').addClass('animated zoomOutRight');
                    clearTimeout(animOut);
                }, 500);

                var animOut2 = setTimeout(function(){
                    slider.find('.image-wrap img').removeClass('show-on');
                    slider.find('.image-wrap img').removeClass('animated zoomOutRight');
                    clearTimeout(animOut2);
                }, 1500);

                var animOut3 = setTimeout(function(){
                    slider.find('.images-animate .slick-current img').addClass('animated fadeOutLeft');
                    clearTimeout(animOut3);
                }, 500);

                var animOut4 = setTimeout(function(){
                    slider.find('.images-animate img').removeClass('show-on');
                    slider.find('.images-animate img').removeClass('animated fadeOutLeft');
                    clearTimeout(animOut4);
                }, 1500);


                slider.find('.slick-current .text-wrap').addClass('animated fadeOut');


                var animOut5 = setTimeout(function(){
                    slider.find('.text-wrap').removeClass('show-on');
                    slider.find('.text-wrap').removeClass('animated fadeOut');
                    clearTimeout(animOut5);
                }, 1500);
            }

            function slide_animation_in(slider){

                slider.find('.slick-current .image-wrap img').addClass('animated fadeInLeft');
                slider.find('.slick-current .image-wrap img').addClass('show-on');

                var animIn = setTimeout(function(){
                    slider.find('.image-wrap img').removeClass('animated fadeInLeft');
                    clearTimeout(animIn);

                }, 1000);

                slider.find('.images-animate .slick-current img').addClass('animated fadeInRight');
                slider.find('.images-animate .slick-current img').addClass('show-on');

                var animIn1 = setTimeout(function(){
                    slider.find('.images-animate img').removeClass('animated fadeInRight');
                    clearTimeout(animIn1);
                }, 1000);


                slider.find('.text-wrap').removeClass('animated fadeIn');

                var animIn2 = setTimeout(function(){
                    slider.find('.slick-current .text-wrap').addClass('show-on');
                    slider.find('.slick-current .text-wrap').addClass('animated fadeIn');
                    clearTimeout(animIn2);
                }, 1000);
            }

            $('.slider-services-wrap button.slick-prev').click(

                function()
                {
                    var slider = $(this).closest('.block');

                    if ($(window).width() > 767){
                        slide_animation_out(slider);

                        var servOut = setTimeout(function(){
                            slider.find('.slider-services').slick("slickPrev");
                            slider.find('.slider-services-images').slick("slickPrev");

                            slide_animation_in(slider);

                            clearTimeout(servOut);

                        }, 1500);
                    }

                    else{
                        slider.find('.slider-services').slick("slickPrev");

                    }




                }

            );

            $('.slider-services-wrap button.slick-next').click(
                function()

               {
                    var slider = $(this).closest('.block');

                    if ($(window).width() > 767){

                        slide_animation_out(slider);

                        var servOut = setTimeout(function(){
                            slider.find('.slider-services').slick("slickNext");
                            slider.find('.slider-services-images').slick("slickNext");

                            slide_animation_in(slider);

                            clearTimeout(servOut);

                        }, 1500);

                    }

                    else{
                        slider.find('.slider-services').slick("slickNext");

                    }


                }

            );
        }
        /* ^slider*/


        /* expired*/
        $("div.expired-page").height($(document).height());
        $("div.error-404").height($(document).height());
        /*expired*/

   
        
       
        
    }

);

$(document).ready(function() 
{
    if($('div.first-slider.slider-lg').length>0)
        initFSlider($('div.first-slider.slider-lg'), "lg");

    if($('div.first-slider.slider-xs').length>0)
        initFSlider($('div.first-slider.slider-xs'), "xs");


    setChangerBlocks();
});

function initFSlider(obj, size){
    var adaptiveMob = ($(window).width() < 768 && $(".wrap-first-slider").attr("data-mobile-height") == "Y") ? false : true,
        sizeSlides = $('div.first-slider div.first-block').length,
        params = {};


    if(size == "lg")
    {
        params = {
            dots: false,
            infinite: true,
            adaptiveHeight: false,
            speed: 500,
            pauseOnFocus: false,
            pauseOnHover: false
        };
    }
    else if(size == "xs")
    {
        params = {
            dots: false,
            infinite: true,
            adaptiveHeight: false,
            speed: 500,
            pauseOnFocus: false,
            pauseOnHover: false,
            responsive: [
                {

                    breakpoint: 767,
                    settings:{
                        adaptiveHeight: adaptiveMob,

                    }

                },
                {

                        breakpoint: 0,
                        settings: "unslick" 

                }]
        };
    }

    obj.on('init', function(event, slick){
        obj.find(".first-block").removeClass('noactive-slide-lazyload');
        obj.addClass("slider-init");
        if(obj.parents(".parent-video-bg").find(".videoBG").length>0){
            correctSizeVideoBg(obj.parents(".parent-video-bg").find(".videoBG"));
        }
    });

    obj.on('beforeChange', function(event, slick, currentSlide, nextSlide)
        {
            $(".lazyload").Lazy();
        }
    );

    if($(".wrap-first-slider").attr("data-autoslide") == "Y")
    {
        params["autoplaySpeed"] = $(".wrap-first-slider").attr("data-autoslide-time");
        params["autoplay"] = true;
    }
    
    obj.slick(params);

    

    if ( $(window).width() >= 768 || ($(window).width() < 768 && $(".wrap-first-slider").attr("data-mobile-height") == "Y"))
    {

        var height1 = 0;
        var height2 = 0;


        $('div.first-slider div.first-block').each(
            function(index){

                
                if ($(this).outerHeight() > height2){
                    height1 = $(this).height();
                    height2 = $(this).outerHeight();
                }
                

                if(sizeSlides == index+1)
                {

                    $('div.first-slider div.first-block-container').css("height", height1);

                    if ( $(".wrap-first-slider").attr("data-desktop-height") == "Y")
                    {
                        if ($(window).height() > $(".wrap-first-slider").height())
                            $(".wrap-first-slider").find(".slick-track").css("height", $(window).height() +
                            "px");
                    }

                    if ( ($(window).width() < 768 && $(".wrap-first-slider").attr("data-mobile-height") == "Y") )
                    {
                        if ($(window).height() > $(".wrap-first-slider").height())
                            $(".wrap-first-slider").find(".slick-track").css("height", $(window).height() +
                            "px");
                    }

                    if(obj.find(".videoBG").length>0)
                    {
                        $(obj.find(".videoBG")).each(
                            function(index)
                            {
                                correctSizeVideoBg($(this));
                            }
                        );
                    }
                    
                }

            }
        );

        
    }


    if( $(window).width() < 768 )
    {
        if ( $(".wrap-first-slider").attr("data-mobile-height") == "Y")
        {
            if ($(window).height() > $(".wrap-first-slider").height())
                $(".wrap-first-slider").find(".slick-track").css("height", $(window).height() +
                "px");

            console.log();
        }
    }

}

function initAdvantagesBigSlider(obj){
    obj.on('init', function(event, slick){
        obj.find(".slick-slide").removeClass('noactive-slide-lazyload');
        obj.addClass("slider-init");
        
        if(obj.parents(".parent-video-bg").find(".videoBG").length>0){
            correctSizeVideoBg(obj.parents(".parent-video-bg").find(".videoBG"));
        }
    });


    obj.slick({
        dots: true,
        adaptiveHeight: false
    });
}

function initAdvantagesSmallSlider(obj){
    obj.on('init', function(event, slick){
        obj.find(".slick-slide").removeClass('noactive-slide-lazyload');
        obj.addClass("slider-init");
        if(obj.parents(".parent-video-bg").find(".videoBG").length>0){
            correctSizeVideoBg(obj.parents(".parent-video-bg").find(".videoBG"));
        }
    });



    obj.slick({
        dots: true,
        slidesToShow: 2,
        adaptiveHeight: false,
        slidesToScroll: 2,
        responsive: [{
            breakpoint: 767,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 0,
            settings: "unslick"
        }]
    });
}

function initGallerySlider(obj){
    var count = parseInt(obj.attr("data-slide-visible"));
    obj.on('init', function(event, slick){
        obj.find(".slick-slide").removeClass('noactive-slide-lazyload');
        obj.addClass("slider-init");
        if(obj.parents(".parent-video-bg").find(".videoBG").length>0){
            correctSizeVideoBg(obj.parents(".parent-video-bg").find(".videoBG"));
        }
    });


    obj.slick({
        dots: true,
        adaptiveHeight: true,
        slidesToScroll: count,
        slidesToShow: count,
        responsive: [{
            breakpoint: 767,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }, {
            breakpoint: 0,
            settings: "unslick"
        }]
    });
}


function tariffsHeightRound (obj)
{
                                   
    var cols = 0;
    var cur_row = 1;

    var heights = new Array();

    if($(window).width() >= 1200)
        cols = obj.attr("data-col-lg");

    if($(window).width() >= 992 && $(window).width() <= 1199)
        cols = obj.attr("data-col-md");

    if($(window).width() >= 768 && $(window).width() <= 991)
        cols = obj.attr("data-col-sm");

    var quantity = obj.find(".tarif-element-inner").length;
    var max_height = 0;

    obj.find(".tarif-element-inner").each(
        function(index){
            var cur_element = index + 1;


            if(max_height < $(this).height())
                max_height = $(this).height();


            if(cur_element % cols == 0 || cur_element == quantity)
            {

                heights[cur_row] = max_height;                    
                cur_row++;
                max_height = 0;
            }

        }
    );

    cur_row = 1;

    obj.find(".tarif-element-inner").each(
        function(index){
            var cur_element = index + 1;
            var top_height = $(this).find(".trff-top-part").height();

            $(this).height(heights[cur_row]);
            $(this).find(".trff-top-part").height(top_height + (heights[cur_row] - $(this).find(".trff-top-part").height() - $(this).find(".trff-bot-part").height()));

            if(cur_element % cols == 0)         
                cur_row++;
        }
    );
}

function initTariffsElements(obj){
    if ($(window).width() > 767)
    {
        if(obj.attr("data-round-height") == "Y")
        {
            if(typeof($('.lazyload', obj))!="undefined")
            {
                if($('.lazyload', obj).length > 0)
                {
                    var countItems = $('.lazyload', obj).length;
                    $('.lazyload', obj).each(
                        function(index, element)
                        {
                            $(element).attr("src", $(element).attr("data-src"));
                            $(element).removeAttr('data-src');

                            $(element).load(function()
                            {
                                if(index == countItems-1)
                                {
                                    tariffsHeightRound (obj);
                                }
                            });
                        }
                       
                    );

                }

                else
                {
                    tariffsHeightRound (obj);
                }

            }
            
            

        }


    }

}

function initOpSlider(obj){
    obj.on('init', function(event, slick){
        obj.find(".slick-slide").removeClass('noactive-slide-lazyload');
        obj.addClass("slider-init");
        

        $('.lazyload', obj).each(
            function(index, element)
            {
                $(element).attr("src", $(element).attr("data-src"));
                $(element).removeAttr('data-src');
            }
           
        );
        if(obj.parents(".parent-video-bg").find(".videoBG").length>0){
            correctSizeVideoBg(obj.parents(".parent-video-bg").find(".videoBG"));
        }
    });

    obj.on('beforeChange', function(event, slick, currentSlide, nextSlide){
         $('.lazyload', obj).each(
            function(index, element)
            {
                $(element).attr("src", $(element).attr("data-src"));
                $(element).removeAttr('data-src');
            }
           
        );
    });

    var count = obj.attr('data-count');

    if (count == 1)
    {
        $('.slider-for', obj).slick({
            slidesToShow: 1,
            arrows: false,
            asNavFor: obj.find('.slider-nav'),
            appendArrows: obj.find('.slider-nav-wrap')
        });
        $('.slider-nav', obj).slick({
            slidesToShow: 1,
            asNavFor: obj.find('.slider-for'),
            centerPadding: 0,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
        });
        obj.addClass("one-slide");
    }
    else if (count == 2)
    {
        $('.slider-for', obj).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 300,
            fade: true,
            adaptiveHeight: true,
            arrows: false,
            asNavFor: obj.find('.slider-nav'),
            appendArrows: obj.find('.slider-nav-wrap')
        });
        $('.slider-nav', obj).slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            speed: 300,
            asNavFor: obj.find('.slider-for'),
            centerPadding: 0,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    infinite: true,
                }
            }, {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1
                }
            }, {
                breakpoint: 0,
                settings: "unslick"
            }]
        });
    } 
    else
    {
        $('.slider-for', obj).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 300,
            fade: true,
            adaptiveHeight: true,
            arrows: false,
            asNavFor: obj.find('.slider-nav'),
            appendArrows: obj.find('.slider-nav-wrap')
        });
        $('.slider-nav', obj).slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            speed: 300,
            asNavFor: obj.find('.slider-for'),
            centerPadding: 0,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    infinite: true,
                }
            }, {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1
                }
            }, {
                breakpoint: 0,
                settings: "unslick"
            }]
        });
    }

}

function initServiceSlider(obj){

    obj.on('init', function(event, slick){

        var sliderHeightMax = 0;

        obj.find(".element-table").each(
            function(){
                if ($(this).height() > sliderHeightMax){
                    sliderHeightMax = $(this).height();
                }

            }
        );

        obj.find(".element-table").height(sliderHeightMax);
        obj.find(".slick-slide").removeClass('noactive-slide-lazyload');
        obj.addClass("slider-init");
        if(obj.parents(".parent-video-bg").find(".videoBG").length>0){
            correctSizeVideoBg(obj.parents(".parent-video-bg").find(".videoBG"));
        }
    });


    obj.parents("div.block").find('.slider-services-images').on('init', function(event, slick){
        obj.parents("div.block").find('.slider-services-images').find(".slick-slide").removeClass('noactive-slide-lazyload');
    });

    

    obj.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 0,
        fade: true,
        adaptiveHeight: false,
        arrows: false,
        swipe: false,
        touchMove: false,
        asNavFor: obj.parents("div.block").find('.slider-services-images')
    });

    obj.parents("div.block").find('.slider-services-images').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: obj.parents("div.block").find('.slider-services'),
        centerPadding: 0,
        arrows: false,
        speed: 0,
        fade: true,
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });
}

$(window).load(
    function()
    {
        var url = location.href;
        url = url.split("#");

        if (typeof(url[1]) != "undefined"){
         
            if(url[1].length<20)
            {
                if($("#"+url[1]).length>0)
                    scrollToBlock("#" + url[1], false);
            }
        }
    }
);



$(window).load(
    function()
    {
        if(customEvent)
            updateLazyLoad();
    }
);

function buildMenu()
{
    if($(".menu-type2").hasClass("active") || $(".menu-type3").hasClass("active")){
        var menu = $('.menu-type2').find('.main-menu-nav');
        var totalWidth = menu.parents('div.nav-wrap').width() - menu.parents('div.nav-wrap').find("div.burger").width();

        menu.parents('div.nav-wrap').find("div.burger").addClass("noactive");

        if ($(document).width() > 767){
            var visible = 0;
       
            
            var size = menu.find('li.lvl1').length;
            menu.find('li.lvl1').each(
                function(index){

                    if (visible == 3){
                        $(this).parent().addClass("full-area");
                    }
                    if (totalWidth > ($(this).width())){
                        totalWidth = totalWidth - $(this).width();
                        $(this).addClass('visible');
                        visible++;

                        if(size == (index+1))  
                            $(".menu-type2").addClass('ready');                      
                    }
                    else{

                        menu.parents('div.nav-wrap').find("div.burger").addClass("active").removeClass("noactive");
                        $(".menu-type2").addClass('ready');
                        return false;
                    }

                }
            );
        }
    }
}

$(document).ready(function() {
    buildMenu();
});


$(window).load(
    function(){


        if($(window).width()>767  && $("header").hasClass('menu-scroll-open'))
        {

			var menuSlide = $('.menu-slide').find('.main-menu-nav-slide');
			var totalWidthSlide = menuSlide.parents("div.wrapper-main-menu").width() - menuSlide.parents("div.menu-slide-wrap").find("div.burger-slide").width();
			var visibleSlide=0;

            menuSlide.parents("div.menu-slide-wrap").find("div.burger-slide").addClass("noactive");



			menuSlide.find('li.lvl1').each(
			function(index) 
			{

				if(totalWidthSlide > ($(this).width()))
				{
				    totalWidthSlide = totalWidthSlide - $(this).width();
				    $(this).addClass('visible');
			    	visibleSlide++;

				}
				else
				{
                    menuSlide.parents("div.menu-slide-wrap").find("div.burger-slide").addClass("active").removeClass("noactive");
				    return false;
				}

				

			}

			);
        }
        
        $("div.box-body-height").css("top", $("div.box-head-height").outerHeight()+"px");
        
    }
);

function correctSizeVideoBg(obj)
{
    var height = obj.parents('.parent-video-bg').outerHeight();
    var videoThis = obj.find(".video-bg-display");

    var width = $(window).width();

    var video_w = 0;
    var video_h = 0;

    var add = 4;

    if (width / height < 16 / 9){
        video_w = height * 16 / 9 + add;
        video_h = height + add;
    }

    else{
        video_w = width + add;
        video_h = width * 9 / 16 + add;
    }

    videoThis.width(video_w).height(video_h);
    videoThis.addClass('active');
}


function generateVideoBG(container)
{
    if($(window).width() >= 1200 || ($(window).width() >= 768 && $(window).width() < 1200 && !device.android() && !device.ios()) )
    {
        var videoBG = $(".videoBG", container),
            iframeType = videoBG.attr("data-type"),
            srcMP4 = videoBG.attr("data-srcMP4"),
            srcWEBM = videoBG.attr("data-srcWEBM"),
            srcOGG = videoBG.attr("data-srcOGG"),
            srcYB = videoBG.attr("data-srcYB"),
            html = "";



        if(iframeType == "file")
        {
            if(videoBG.children('video').length <= 0)
            {
                if( srcMP4 )
                    html += '<source src="'+srcMP4+'" type="video/mp4">';

                if( srcWEBM )
                    html += '<source src="'+srcWEBM+'" type="video/webm">';

                if( srcOGG )
                    html += '<source src="'+srcOGG+'" type="video/ogg">';


                html = '<video class="video-bg-display" autoplay="autoplay" loop="loop" preload="auto" muted="muted">'+html+'</video>';
            }
        }

        else if(iframeType == "iframe")
        {

            if(videoBG.children('iframe').length <= 0)
            {
                if( srcYB )
                    html += '<iframe src="'+srcYB+'" class="video-bg-display" allowfullscreen="" frameborder="0" height="100%" width="100%"></iframe>';
            }
        }

        if( html )
            videoBG.prepend(html);

        correctSizeVideoBg(videoBG);
                
    }
}

/*click-scroll*/
$(document).on("click", "a.scroll",
    function(){
        var elementClick = $(this).attr("href");

        if ($(this).hasClass('close-from-menu')){

            $('.slide-menu').removeClass('on');
            var mnuOut = setTimeout(
                function(){
                    $('.slide-menu').removeClass('open');
                    clearTimeout(mnuOut);

                }, 1000);
            $('body').removeClass('menu-open');
            $('.wrapper').removeClass('blur-menu');
            $('a.menu-slide-close').addClass('hidden').removeClass('on');
            $('div.no-click-block').removeClass('on');
        }

        if ($(this).hasClass('from-tariff')){
            $('body').removeClass('modal-open');
            $('.wrapper').removeClass('blur');
            $('div.no-click-block').removeClass('on');
            $(this).parents(".wrap-modal").removeClass("open");
        }


        

        
        scrollToBlock(elementClick);

        return false;

        
    }
);


/*catalog-modal tabs in detail cart*/
$(document).on('click', 'ul.tab-child li:not(.active)',
    function(){
        $(this).addClass('active').siblings().removeClass('active').closest('div.tab-parent').find('div.tab-content').removeClass('active').eq($(this).index()).addClass('active');
        
    }
);


/*catalog-modal-tabs-images in detail cart*/
$(document).on('click', 'div.image-dots div.image-wrap-dot:not(.active)',
    function(){
        $(this).addClass('active').siblings().removeClass('active').closest('div.images-content').find('div.image-child').removeClass('active').eq($(this).index()).addClass('active');
        
    }
);


/*for catalog completcs view radiobutton*/
$(document).on('click', 'div.catalog-body div.price-radio label:not(.active)',
    function(){
        $(this).addClass('active').siblings().removeClass('active');
        
    }
);


$(document).on('click', 'ul.switcher-tab li:not(.active)',
    function(){
        $(this).addClass('active').siblings().removeClass('active').closest('div.switcher').find('div.switcher-wrap').removeClass('active').eq($(this).index()).addClass('active');
        
    }
);

$(document).on('click', 'a[data-button="wind-modal"]',
    function(){
        $('div.wrapper').addClass('blur');
        $("div.click-for-reset").addClass("on");
        
    }
);


$(document).on('click', 'a[data-button="wind-in-modal"]',
    function(){
        $('div.wrapper').addClass('blur');
        $(this).closest('.wrap-modal.open').addClass('blur');
        $("div.click-for-reset").addClass("on");
        
    }
);


$(document).on('click', 'a.map-show',
    function(){
        $(this).parent().hide();
        $(this).parents('div.map-block').find(".map-height").show();
        
    }
);

/*for descriptive tabs*/
$(document).on("click", "ul.tabs li:not(.active)",
    function(){
        $(this).addClass('active').siblings().removeClass('active').closest('div.descriptive-tabs-wrap').find('div.image-content').removeClass('active').eq($(this).index()).addClass('active');
        $('.lazyload').Lazy(paramsLazy);
    }
);


/*for descriptive show mob-tab*/
$(document).on("click", "div.mob-tab",
    function(){
        var block = $(this).parent("div.image-content");

        if (!$(this).hasClass("active")){

            if ($("img", block).attr("data-src"))
            {
                var _this = $(this);

                $("img", block).Lazy({
                    afterLoad: function (element) {
                        $("img", block).removeAttr('style');

                        _this.addClass("active");

                        $("div.mob-content", block).slideDown(200, function() {
                            $(this).removeClass("active");
                        });
                    }
                });
            } 
            else
            {
                $(this).addClass("active");
                $("div.mob-content", block).slideDown(200, function() {
                    $(this).removeClass("active");
                });
            }

        }

        else{
            $(this).removeClass("active");


            $("div.mob-content", block).slideUp(200,
                function(){
                    $(this).removeClass("active");
                }
            );
        }

        
    }
);




/*open slide-menu*/
$(document).on("click", "a.click-op-menu",
    function(){
        var button = $(this);
        $('.menu-slide-close').removeClass('hidden');
        $('.slide-menu').addClass('open');

        size_slide_menu();

        var mnuOut = setTimeout(
            function(){
                $('.slide-menu').addClass('on');
                clearTimeout(mnuOut);
            }, 100);

        $('body').addClass('menu-open');
        $('.wrapper').addClass('blur-menu');
        $('div.no-click-block').addClass('on');

        var mnuOut2 = setTimeout(
            function(){
                $('.menu-slide-close').addClass('on');
                clearTimeout(mnuOut2);
            }, 800);

        $('.lazyload').Lazy(paramsLazy);

        
    }
);


$(document).on("click", "a.click-cl-menu",
    function(){
        var button = $(this);

        $('.slide-menu').removeClass('on');
        var mnuOut = setTimeout(
            function(){
                $('.slide-menu').removeClass('on');
                clearTimeout(mnuOut);

            }, 1000);
        $('body').removeClass('menu-open');
        $('.wrapper').removeClass('blur-menu');
        button.addClass('hidden').removeClass('on');
        $('div.no-click-block').removeClass('on');
        
    }
);


/*key only numbers*/
$(document).on("keypress", "form.form div.count input",
    function(e){
        e = e || event;

        if (e.ctrlKey || e.altKey || e.metaKey) return;

        var chr = getChar(e);

        if (chr == null) return false;

    }
);


$(document).on("keyup", "form.form div.count input",
    function(e){
        var value = $(this).val().toString();

        var newVal = "";

        for (var i = 0; i < value.length; i++){
            if (value[i] == "0" || value[i] == "1" || value[i] == "2" || value[i] == "3" || value[i] == "4" || value[i] == "5" || value[i] == "6" || value[i] == "7" || value[i] == "8" || value[i] == "9")
                newVal += value[i];
        }

        if (newVal == 0)
            newVal = 1;

        $(this).val(newVal);

        if ($(this).val() == "")
            $(this).parent().addClass('in-focus');

        

    }
);

$(document).on("click", "form.form div.count span.plus",
    function(){
        var input = $(this).parent("div.count").find("input");

        input.parent().removeClass("has-error");

        var value = parseFloat(input.val());

        if (isNaN(value))
            value = 0;

        value += 1;

        input.val(value);

        if ($(this).val() == "")
            $(this).parent().addClass('in-focus');

        

    }
);

$(document).on("click", "form.form div.count span.minus",
    function(){
        var input = $(this).parent("div.count").find("input");
        input.parent().removeClass("has-error");

        var value = parseFloat(input.val());

        if (isNaN(value))
            value = 0;

        value -= 1;

        if (value < 0)
            value = '';
        if (value == 0)
            value = 1;

        input.val(value);

        

    }
);
/*key only numbers end*/

$(document).on("click", "div.down-scroll",
    function(){
        var s_b = $(this).parents('div.parent-scroll-down').next(),
            heightOut = 0;

        if ($('header').hasClass('slide'))
            heightOut = 70;
        else{
            heightOut = 0;
        }

        while (s_b.hasClass('hidden-lg')) {
            s_b = s_b.next();
        }

        var destination = $(s_b).offset().top - heightOut;
        jQuery("html:not(:animated),body:not(:animated)").animate({
            scrollTop: destination
        }, 700);

        

    }
);


/*scroll menu-header*/
var HeaderHeight = 500;
$(window).scroll(function(){
 

    if($(window).width() <= 767)
        HeaderHeight = 300;

    if ($(document).scrollTop() >= HeaderHeight){
        $('header').addClass('top');

        var upOut = setTimeout(
            function(){
                $('header').addClass('fixed');
                clearTimeout(upOut);
            }, 100);

        $('a.up').addClass('on');

    }
    else{
        $("header").removeClass('fixed');

        var upOut = setTimeout(
            function(){
                $('header').removeClass('fixed');
                clearTimeout(upOut);
            }, 100);

        $('header').removeClass('top');

        $('a.up').removeClass('on');

    }

    
});






/*catalog-tabs-new*/
$(document).on('click', 'div.tab-menu',
    function(){
        $(this).parents('.tab-control').find('.tab-menu').removeClass('active');
        $(this).parents('.tab-control').find('.tabb-content').removeClass('active');

        $(this).addClass('active');
        $('.tabb-content[data-tab="' + $(this).attr("data-tab") + '"]').addClass('active');

        
    }
);
$(document).on('click', '.show-hidden',
    function(){

        $(this).parents('.show-hidden-parent').find('.hidden').removeClass('hidden');
        $(this).parent().addClass('off');
        
    }
);


$(document).on("click", ".click-slide-show",
    function(){

        var block = $(this).parent(".parent-slide-show");

        if (!$(this).hasClass("active")){
            $(this).addClass("active");
            $(".content-slide-show", block).slideDown(200,
                function(){
                    $(this).addClass("active");
                }
            );

        }

        else{
            $(this).removeClass("active");
            $(".content-slide-show", block).slideUp(200,
                function(){
                    $(this).removeClass("active");
                }
            );
        }

        
    }
);


/* box*/

$(document).on("click", ".box-show",
    function(){
        if ($(this).hasClass('box-empty'))
            return false;

        var from_mod_cat = "N";

        if ($(this).parents(".area_for_mini_box").hasClass('mod_cat_opened'))
            from_mod_cat = "Y";

        openBox(from_mod_cat);
});



$(document).on("click", ".box-close",
    function(){

        if (!$(".wrap-modal.open").hasClass('blur')){
            $('.wrapper').removeClass('blur');
            $('body').removeClass('modal-open');
        }

        if ($(".wrap-modal.open").hasClass('blur'))
            $(".wrap-modal.open").removeClass('blur');


        $('div.box-parent').removeClass('on');
        $('.no-click-block').removeClass('double');

        var closeCartOut = setTimeout(
            function(){
                $('div.box-parent').removeClass('open');
                clearTimeout(closeCartOut);
            }, 700
        );
        
    }
);



$(document).on("keypress", "input.count-val",
    function(e){

        e = e || event;

        if (e.ctrlKey || e.altKey || e.metaKey) return;

        var chr = getChar(e);

        if (chr == null) return false;
    }
);


$(document).on("blur", "input.count-val",
    function(e){

        e = e || event;

        if (e.ctrlKey || e.altKey || e.metaKey) return;

        var chr = getChar(e);

        if (chr == null) return false;

        var newVal = $(this).val();        

        var step = $(this).parents(".parent-calcbox").find("input.count-val").attr("data-box-step");
        var minVal = $(this).parents(".parent-calcbox").find("input.count-val").attr("data-box-min");
        var idboxEl = parseFloat($(this).attr("data-box-id"));
        var action = $(this).attr("data-box-action");
        var button = $(this);

        var other_complect = $(this).parents(".parent-calcbox").find("input.other_complect_box").val();

        step = +step;
        minVal = +minVal;

        if (isNaN(minVal))
            minVal = 1;

        if (isNaN(step))
            step = 1;

        newVal = +newVal;
        newVal = parseCount(newVal, step, minVal);

        $(this).val(newVal);

        updateBox(button, newVal, idboxEl, action, other_complect, "");

        

    }
);


function parseMinVal(value, step, minVal)
{
    var tmpMin = step;

    if(step < minVal)
        tmpMin = minVal;

    if (value <= tmpMin || isNaN(value))
        value = minVal;

    return value;
}

$(document).on("click", ".count-plus",
    function(){
        var input = $(this).parents(".parent-calcbox").find("input.count-val");

        var value = +input.val();
        var step = $(this).parents(".parent-calcbox").find("input.count-val").attr("data-box-step");
        var minVal = $(this).parents(".parent-calcbox").find("input.count-val").attr("data-box-min");

        step = +step;
        minVal = +minVal;

        if (isNaN(minVal))
            minVal = 1;

        if (isNaN(step))
            step = 1;

        if (isNaN(value))
            value = 0;

        value += step;
        value = parseMinVal(value, step, minVal);

        input.val(value);

        
    }
);

$(document).on("click", ".count-minus",
    function(){
        var input = $(this).parents(".parent-calcbox").find("input.count-val");
        var value = parseFloat(input.val());
        var step = $(this).parents(".parent-calcbox").find("input.count-val").attr("data-box-step");
        var minVal = $(this).parents(".parent-calcbox").find("input.count-val").attr("data-box-min");

        step = +step;
        minVal = +minVal;

        if (isNaN(minVal))
            minVal = 1;

        if (isNaN(step))
            step = 1;

        if (isNaN(value))
            value = 0;

        value -= step;
        value = parseMinVal(value, step, minVal);

        input.val(value);

        
    }
);




$(document).on("click", ".click_box",
    function(){

        var countBox = parseFloat($(this).parents(".parent-calcbox").find("input.count-val").val());
        var idboxEl = parseFloat($(this).attr("data-box-id"));
        var action = $(this).attr("data-box-action");
        var button = $(this);

        if(device.ios()){
            cur_pos = $(document).scrollTop();
        }

        if ($(this).attr("data-box-action") == "add" && !$(this).hasClass('added') && !$(this).hasClass('from_modal_cat')){
            var obj_img = $("img[data-box-id-img = '" + idboxEl + "']");
            var mini_box = $(".open-box");

            if($(window).width() < 767)
                mini_box = $(".open-box-mob");
            
            var width_parent_img = $(this).parents(".element").find("td.parent_anim_img_area").width() / 2;
            var height_parent_img = $(this).parents(".element").find("td.parent_anim_img_area").height() / 2;

            obj_img.clone()

                .css({
                    'width': 70 + 'px',
                    'height': 70 + 'px',
                    'position': 'absolute',
                    'z-index': '9999',
                    'borderRadius': 50 + '%',
                    top: obj_img.offset().top + height_parent_img,
                    left: obj_img.offset().left + width_parent_img
                })

                .appendTo("body")
                .animate({
                    opacity: 0.05,
                    left: mini_box.offset()['left'],
                    top: mini_box.offset()['top'],
                    width: 20,
                    height: 20
                }, 700, function(){
                    $(this).remove();
                });



            addGoal('ADD2BASKET');


        }



        if (isNaN(countBox))
            countBox = parseFloat($(this).attr("data-box-step"));


        var other_complect = "";

        if ($(this).hasClass('from_modal_cat'))
            other_complect = $(this).parents(".tabs-content").find("input[name='other_complect']:checked").val();


        if (typeof(other_complect) != "undefined")
        {
            if (other_complect.length <= 0)
                other_complect = $(this).parents(".parent-calcbox").find("input.other_complect_box").val();
        }


        if (typeof(other_complect) == "undefined")
            other_complect = "";


        clearTimeout($.data(this, 'box_count'));

        $.data(this, 'box_count', setTimeout($.proxy(function(){

            updateBox(button, countBox, idboxEl, action, other_complect, "");


            
        }, this), 700));

      
        /* if(button.hasClass('added'))
             return false;*/

        
    }
);


/*alert*/
$(document).on("click", ".hameleon-alert-btn", 
    function()
    {
        $("div.alert-block div.hameleon-alert-btn").addClass("on");
        $("div.alert-block div.alert-block-content").addClass("on");
        
    }
);

$(document).on("click", "a.alert-close", 
    function()
    {
        $("div.alert-block div.hameleon-alert-btn").removeClass("on");
        $("div.alert-block div.alert-block-content").removeClass("on");
        
    }
);

$(document).on("click", "div.faq-block div.question", 
    function()
    {
        var block = $(this).parents("div.faq-element");

        if (!block.hasClass("active")){
            $("div.text", block).slideDown(200,
                function(){
                    block.addClass("active");
                }
            );
        }

        else{
            $("div.text", block).slideUp(200,
                function(){
                    block.removeClass("active");
                }
            );
        }

        

    }
);

$(document).on("click", "div.switcher-wrap div.switcher-title", 
    function()
    {
        var block = $(this).parents("div.switcher-wrap");

        if (!block.hasClass("active")){
            $("div.switcher-content", block).slideDown(200,
                function(){

                    block.addClass("active");
                }
            );
        }

        else{
            $("div.switcher-content", block).slideUp(200,
                function(){
                    block.removeClass("active");
                }
            );
        }
    }
);


$(window).on("load", function()
{

    if($(".hide-adv").length>0)
    {
        setTimeout(function()
        {
            $.post(
            "/bitrix/templates/concept_hameleon/ajax/hide_adv.php",
            {
                "check": "Y",
                "USER_ID": $(".hide-adv").attr("data-user")
            },
            function(data){
                if(data.OK == "Y")
                {
                    $("body").append('<script type="text/javascript"> (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(54591493, "init", { clickmap:false, trackLinks:false, accurateTrackBounce:false }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/54591493" style="position:absolute; left:-9999px;" alt="" /></div></noscript><script>ym(54591493, \'reachGoal\', \'hide_hameleon\');</script>');
                }
            },
            "json"
        ); 
            
        }, 13000); 
    }
});