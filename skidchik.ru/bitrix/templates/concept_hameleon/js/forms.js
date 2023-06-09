
function formAttentionScroll(dist, parent){
    $(parent).animate({
        scrollTop: dist
    }, 700);
    
}
$(document).ready(
    function(){


        if($(".form-block form").is(".send"))
        {
            $("form input[name='url']").val(location.href);
            $.datetimepicker.setLocale('ru');
            $('form.form .date').datetimepicker({
                timepicker: false,
                format: 'd/m/Y',
                scrollMonth: false,
                scrollInput: false,
                dayOfWeekStart: 1
            });
        }
        
    }
);

$(document).on('change', ".form.send input[type='file']",
    function(){

    	var inp = $(this);
        var file_list_name = "";

    	$(inp[0].files).each(
            function(key){
                file_list_name += "<span>"+inp[0].files[key].name+"</span><br/>";
            }
        );


        if(!file_list_name.length)
            return;

        inp.parents('form.send').addClass('file-download');
        inp.parents('label').find('.area-files-name').html(file_list_name);
        inp.parents('label').removeClass("area-file");
        inp.closest('.load-file').removeClass("has-error");

    }
);

$(document).on("click", "form.form input[type='checkbox']",
    function(){
        $(this).parents("div.wrap-agree").removeClass("has-error");
        
    }
);
/*send form*/

function sendForm(arParams)
{
    var error = 0,
        formSendAll = new FormData(),
        actionGoals = "CALLBACK";

    if(arParams.form_block.hasClass('order'))
        actionGoals = "ORDER";
    else if(arParams.form_block.hasClass('fast-order'))
        actionGoals = "FAST_ORDER";


    formSendAll.append("send", "Y");
    formSendAll.append("tmpl_path", $("input.tmpl_path").val());
    formSendAll.append("section_iblock_id", $("input.iblock-landing").val());

    for (var i = 1; i <= 10; i++) {
        if($("input#custom-input-"+i).val().length>0)
            formSendAll.append("custom-input-"+i, $("input#custom-input-"+i).val());
    }


    if(typeof(arParams.agreecheck.val()) != "undefined"){
        if(!arParams.agreecheck.prop("checked")){
            arParams.agreecheck.parents("div.wrap-agree").addClass("has-error");
            error = 1;
        }
    }




    $("input[type='text'], input[type='email'], input[type='password'], textarea", arParams.form_block).each(
        function(key, value){

            if($(this).hasClass("email") && $(this).val().length > 0){
                if(!(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test($(this).val())){
                    $(this).parent("div.input").addClass("has-error");
                    error = 1;
                }
            }
            if($(this).hasClass("require")){
                if($(this).val().trim().length <= 0){
                    $(this).val("");
                    $(this).parent("div.input").addClass("has-error");
                    error = 1;
                }
            }
        }
    );
    $("input[type='file']", arParams.form_block).each(
        function(key, value){
            if($(this).hasClass("require")){
                if($(this).closest('.load-file').find('.area-file').length>0){
                    $(this).closest('.load-file').addClass("has-error");
                    error = 1;
                }
            }
        }
    );
    if(!$('.ham-modal').hasClass('form-modal')){
        var otherHeight = 0;
        if($('header').hasClass('slide'))
            otherHeight = $('header .header-block').outerHeight(true);
    }
    if(error == 1){
        if($('.ham-modal').hasClass('form-modal'))
            formAttentionScroll(arParams.form_block.find('.has-error:first').offset().top - arParams.form_block.parents('.ham-modal-dialog').offset().top, ".ham-modal");

        else if(arParams.form_block.hasClass('form-box'))
            formAttentionScroll(arParams.form_block.find('.has-error:first').offset().top - arParams.form_block.parents(".body").offset().top, ".box-parent");

        else{
            formAttentionScroll(arParams.form_block.find('.has-error:first').offset().top - otherHeight, "html:not(:animated),body:not(:animated)");
        }
    }



    if(error == 0){
        arParams.form_block.css({
            "height": arParams.form_block.outerHeight() + "px"
        });


        form_arr = arParams.form_block.find(':input,select,textarea').serializeArray();

        for (var i = 0; i < form_arr.length; i++)
        {
            formSendAll.append(form_arr[i].name, form_arr[i].value);
        };

        if (arParams.form_block.hasClass('file-download'))
        {
            arParams.form_block.find('input[type=file]').each(function(key)
            {

                var inp = $(this);
                var file_list_name = "";

                $(inp[0].files).each(
                    function(k){
                        formSendAll.append(inp.attr('name'), inp[0].files[k], inp[0].files[k].name);
                    }
                );

            });
        }

        if(arParams.captchaToken.length>0)
            formSendAll.append("captchaToken", arParams.captchaToken);
        
       
        arParams.button.removeClass("active");
        arParams.load.addClass("active"); 
        var timeOut = setTimeout(
            function(){
                $.ajax({
                    url: arParams.path,
                    method: 'POST',
                    contentType: false,
                    processData: false,
                    data: formSendAll,
                    dataType: 'json',
                    success: function(json){

                        /*console.log(json);

                        $("body").prepend(json);*/

                        if(json.OK == "N"){
                            arParams.button.addClass("active");
                            arParams.load.removeClass("active");
                        }
                        if(json.OK == "Y")
                        {

                            arParams.questions.removeClass("active");
                            arParams.thank.addClass("active");

                            $.ajax({
                                url: "/",
                                method: 'POST',
                                success: function(json){}

                            });

                            if(actionGoals == "CALLBACK")
                                addGoal(actionGoals);

                           

                            setTimeout(
                                function()
                                {

                                    if($('.ham-modal').hasClass('form-modal'))
                                        formAttentionScroll(arParams.form_block.find('.thank').offset().top - arParams.form_block.parents('.ham-modal-dialog').offset().top, ".ham-modal");

                                    else if(arParams.form_block.hasClass('form-box'))
                                        formAttentionScroll(arParams.form_block.find('.thank').offset().top - arParams.form_block.parents(".body").offset().top, ".box-parent");

                                    else{
                                        formAttentionScroll(arParams.form_block.find('.thank').offset().top - otherHeight, "html:not(:animated),body:not(:animated)");
                                    }

                                }, 300);


                            if(arParams.form_block.hasClass('form-box'))
                            {
                                setTimeout(
                                    function(){
                                        
                                        arParams.form_block.find(".areabox-form").children().remove();
                                        arParams.form_block.find(".box-back").removeClass('active');
                                        arParams.form_block.find(".areabox-form").removeClass('active');
                                        arParams.form_block.find(".info-table").addClass('active');

                                        var redirect = "";
                                        if(typeof(json.PAYMENT_REDIRECT) != "undefined")
                                        {
                                            if(json.PAYMENT_REDIRECT.length > 0)
                                                redirect = json.PAYMENT_REDIRECT;
                                        }

                                        updateBox("","","","clear","", redirect);

                                    }, 2000);
                            }

                            if(typeof(arParams.linkHREF) != "undefined")
                            {

                                setTimeout(
                                    function()
                                    {
                                        location.href = arParams.linkHREF;

                                    }, 3000);
                            }

                            if(json.SCRIPTS.length > 0)
                                $('body').append("<script>"+json.SCRIPTS+"</script>");
                        }                         
                    }
                });
                clearTimeout(timeOut);
            }, 1000);
    }

}

$(document).on("click", "button.btn-submit", function()
{

    var form = $(this).parents("form.send");
    var path = "/bitrix/templates/concept_hameleon/ajax/forms.php";

    if(form.hasClass('form-box'))
        path = "/bitrix/components/concept/hameleon_cart/order.php";


    paramsForm = {
        form_block: form,
        path: path,
        button: $(this),
        linkHREF: $(this).attr("data-link"),
        header: $("input[name='header']", form),
        agreecheck: $("input[name='checkboxAgree']", form),
        questions: $("div.questions", form),
        load: $("div.load", form),
        thank: $("div.thank", form),
        captchaToken: ""

    };

    if($("input.captcha-site-key").length>0)
    {
        grecaptcha.execute($("input.captcha-site-key").val(), {action: 'homepage'}).then(function(token) {
            paramsForm.captchaToken = token;
            sendForm(paramsForm);
        });
    }
    else{
        sendForm(paramsForm);
    } 

});
$(document).on("click", "a.form-close",
    function(){
        $("div.click-for-reset.on").removeClass("on");
        $('div.wrapper').removeClass('blur');
        $('body').removeClass("modal-open");
        $('.wrap-modal.open').removeClass('blur');

        if(device.ios()){
            $("body").removeClass("modal-ios");
            window.scrollTo(0, cur_pos);
        }
    }
);

$(document).on('click', '.call-modal',
    function(){
        if(!$("body").hasClass("modal-ios"))
            cur_pos = $(document).scrollTop();

            var path = '',
                area = '',
                value = $(this).attr("data-call-modal"),
                header = $(this).attr("data-header"),
                from = $(this).attr("data-from-open-modal"),
                element_id = "",
                element_type = "",
                other_complect = "";

            site_id = $("input.site_id").val();
            ib = $("input.ib").val();
            sect = $("input.sect").val();
            btn_type = $("input.btn_type").val();
            

            if($(this).hasClass("more-modal-info")){
                element_id = $(this).attr("data-element-id");
                element_type = $(this).attr("data-element-type");

                if($(this).hasClass('from-modal'))
                    other_complect = $(this).parents(".tabs-content").find("input[name='other_complect']:checked").val();
            }

            var type = "";
            var box_form = "";

            var th = $(this);

            $('div.wrapper').addClass('blur');

            if($(this).hasClass('box-form'))
            {
                area = 'areabox-form';
                path = 'form_box.php';
                value = value.replace("form", "");

                if($(this).hasClass('main-click'))
                    box_form = "Y";
            }

            if($(this).hasClass('callform')){
                area = 'modalAreaForm';
                path = 'formmodal.php';
                value = value.replace("form", "");
            }


            if($(this).hasClass('callvideo')){
                area = 'modalAreaVideo';
                path = 'videomodal.php';
            }

            if($(this).hasClass('callmodal')){
                area = 'modalAreaWindow';
                path = 'windowmodal.php';
                value = value.replace("modal", "");
            }

            if($(this).hasClass('callagreement')){
                area = 'modalAreaAgreement';
                path = 'agreemodal.php';
                value = value.replace("agreement", "");
            }


            $('.google-spin-wrapper').addClass('active');

            $.post("/bitrix/templates/concept_hameleon/ajax/" + path,{
                    resVal: value,
                    site_id: site_id,
                    type: type,
                    btn_type: btn_type,
                    section: sect,
                    ib: ib,
                    element_id: element_id,
                    element_type: element_type,
                    other_complect: other_complect,
                    box_form: box_form

                },

                function(html){

                    $("body").addClass("modal-open");

                    if(device.ios() && !th.hasClass('box-form')){
                        $("body").addClass("modal-ios");
                    }

                    $('div.' + area).html(html);
                    $('.google-spin-wrapper').removeClass('active');

                    if(from == 'open-menu'){
                        $('div.open-menu').addClass('blur');
                        $('div.' + area).find('.close-modal').addClass('open-menu');
                    }

                    var timeOut = setTimeout(
                        function(){
                            $('div.' + area).find('.ham-modal').addClass('active');
                            clearTimeout(timeOut);
                        }, 300);


                    if(area == 'modalAreaForm'){
                        var timeOut2 = setTimeout(
                            function(){

                                $('div.modalAreaForm').find("form input[name='url']").val(decodeURIComponent(location.href));

                                $('div.modalAreaForm').addClass('z-index-99999');

                                if(typeof(comment) != "undefined"){
                                    if(comment.length > 0)
                                        $("div.modalAreaForm").find("div.add_text").html(comment);

                                }

                                if(typeof(formTitle) != "undefined"){
                                    if(formTitle.length > 0)
                                        $('div.modalAreaForm').find("form input[name='comment']").val(formTitle);
                                }

                                if(typeof(header) != "undefined"){
                                    if(header.length > 0)
                                        $('div.modalAreaForm').find("form input[name='header']").val(header);
                                }
                                $.datetimepicker.setLocale('ru');
                                $('div.modalAreaForm form.form .date').datetimepicker({
                                    timepicker: false,
                                    format: 'd/m/Y',
                                    scrollMonth: false,
                                    scrollInput: false,
                                    dayOfWeekStart: 1
                                });
                                clearTimeout(timeOut2);
                            }, 100
                        );
                    }

                    if(area == 'modalAreaVideo'){
                        var timeOut2 = setTimeout(
                            function(){
                                var win_height = $('div.video-modal').height();
                                var modal = 590;
                                if($(window).width() > 767){
                                    if(win_height > modal)
                                        $("div.video-modal div.ham-modal-dialog").addClass('pos-absolute');
                                    else{
                                        $("div.video-modal div.ham-modal-dialog").removeClass('pos-absolute');
                                    }
                                }
                                else{
                                    $("div.video-modal div.ham-modal-dialog").addClass('pos-absolute');
                                }

                                clearTimeout(timeOut2);
                            }, 100
                        );
                    }


                    if(th.hasClass('from-modalform')){
                        $('div.modalAreaForm').addClass('z-index-99999');
                        $('div.modalAreaAgreement').find('.close-modal').addClass('from-modal');
                        $('div.modalAreaAgreement').find('.close-modal').addClass('from-modalform');
                        $('div.form-modal').addClass('blur');
                    }

                    if(th.hasClass('from-openmenu')){
                        $('div.modalAreaForm').find('.close-modal').addClass('from-modal');
                        $('div.modalAreaAgreement').find('.close-modal').addClass('from-modal');
                        $('div.modalAreaAgreement').find('.close-modal').addClass('from-openmenu');
                        $('div.modalAreaForm').find('.close-modal').addClass('from-openmenu');
                        $('div.open-menu').addClass('blur');
                        $('div.modalAreaWindow').find('.close-modal').addClass('from-modal');
                        $('div.modalAreaWindow').find('.close-modal').addClass('from-openmenu');
                    }

                    if(th.hasClass('from-set')){
                        $('div.modalAreaForm').find('.close-modal').addClass('from-modal');
                        $('div.modalAreaWindow').find('.close-modal').addClass('from-modal');
                    }

                    if(th.hasClass('from-tariff')){
                        $('div.wrap-modal').addClass('blur');
                        $('div.modalAreaAgreement').find('.close-modal').addClass('from-tariff');
                        $('div.modalAreaForm').find('.close-modal').addClass('from-tariff');
                        $('div.modalAreaWindow').find('.close-modal').addClass('from-tariff');
                    }

                    if(area == 'areabox-form')
                    {                    
                        th.parents(".wrapper-mbox").find(".info-table").removeClass('active');
                        th.parents(".wrapper-mbox").find(".box-back").addClass('active');
                        th.parents(".wrapper-mbox").find(".areabox-form").addClass('active');
                        th.parents(".wrapper-mbox").find("form input[name='url']").val(decodeURIComponent(location.href));
                        $.datetimepicker.setLocale('ru');
                        $('.wrapper-mbox form.form .date').datetimepicker({
                            timepicker: false,
                            format: 'd/m/Y',
                            scrollMonth: false,
                            scrollInput: false,
                            dayOfWeekStart: 1
                        });
                    }

                    $('.lazyload').Lazy();

                }
            );
        
        

    }
);
$(document).on('click', '.close-modal',
    function(){
        $('div.modalAreaForm form.form .date').datetimepicker('destroy');
        $(this).parents("div.modalArea.z-index-99999").removeClass('z-index-99999');
        if(!($(this).hasClass('from-modal')) && !($(this).hasClass('from-tariff'))){
            $('div.wrapper').removeClass('blur');
            $("body").removeClass("modal-open");

            if(device.ios()){
                $("body").removeClass("modal-ios");
                window.scrollTo(0, cur_pos);
            }
        }
        if($(this).hasClass('from-modalform'))
            $('div.form-modal').removeClass('blur');

        if($(this).hasClass('from-openmenu'))
            $('div.open-menu').removeClass('blur');

        if($(this).hasClass('from-tariff'))
            $('div.wrap-modal').removeClass('blur');

        if($(this).hasClass('wind-close'))
            $(this).parents("div.shadow-modal-wind-contact").removeClass('on');

        else{
            $(this).parents("div.modalArea").children().remove();
        }

        
    }
);
$(document).on("click", ".box-back",
    function(e){
        $(this).removeClass('active');
        $(this).parents(".wrapper-mbox").find(".areabox-form").removeClass('active');
        $(this).parents(".wrapper-mbox").find(".info-table").addClass('active');

        
    }
);
$(document).on('click', '.open_modal_contacts',
    function(){
        $('div.shadow-modal-wind-contact').addClass('on');
        $('div.wrapper').addClass('blur');
        $("body").addClass("modal-open");

        if(device.ios()){
            cur_pos = $(document).scrollTop();
            $("body").addClass("modal-ios");
        }

        
    }
);
$(document).on("click", ".btn-modal-open",
    function(){
        cur_pos = $(document).scrollTop();

        var added = "N";
        if($(this).parents(".element").find(".click_box").hasClass('added'))
            added = "Y";


        $('div.google-spin-wrapper').addClass('active');

        $.post("/bitrix/templates/concept_hameleon/ajax/modal.php",{
            element_id: $(this).attr('data-element-id'),
            name: $(this).attr('data-detail'),
            all_id: $(this).attr('data-all-id'),
            site_id: $("input.site_id").val(),
            land_id: $("input.sect").val(),
            land_iblock_id: $("input.ib").val(),
            block_header: $(this).attr('data-header'),
            added: added,
            catalog_id: $(this).attr('data-main-catalog-id')

            },

            function(html){

                $('div.wrap-modal').addClass('open');
                $('div.wrapper').addClass('blur');
                $('body').addClass('modal-open');
                $('.shadow-detail').addClass('active');
                $("div.modal-container").html(html);

            


                $(".wrap-modal-inner").addClass('open');
                $('div.no-click-block').addClass('on');

                $('div.google-spin-wrapper').removeClass('active');
                $(".area_for_mini_box").addClass('mod_cat_opened');
            }
        );

        
    }
);
/*for close detail-modal*/
$(document).on("click", "a.wrap-modal-close",
    function(){
        $('div.wrap-modal').removeClass('open');
        $('.shadow-detail').removeClass('active');
        $('body').removeClass('modal-open');
        $('div.wrapper').removeClass('blur');
        $('div.no-click-block').removeClass('on');

        if($(".area_for_mini_box").hasClass("mod_cat_opened"))
            $(".area_for_mini_box").removeClass('mod_cat_opened');

        if(device.ios()){
            window.scrollTo(0, cur_pos);
            $("body").removeClass("modal-ios");
        }

        
    }
);
/*hide and show placeholder*/
$(document).on("focus", "form input[type='text'], input[type='email'], form textarea",
    function(){
        $(this).parent("div.input").removeClass("has-error");
        
    }
);
$(document).on("blur", "form input[type='text'], input[type='email'], form textarea",
    function(){
        $(this).parent("div.input").removeClass("has-error");
        
    }
);
$(document).on('click', '.select-list-choose',
    function(){
        $(this).parents('.form-select').addClass('open');
        
    }
);
$(document).on('click', '.ar-down',
    function(){
        if($(this).parents('.form-select').hasClass('open'))
            $(this).parents('.form-select').removeClass('open');
        else{
            $(this).parents('.form-select').addClass('open');
        }
        
    }
);
$(document).on('click', '.form-select .name',
    function(){
        $(this).parents('.form-select').find('.select-list-choose').removeClass('first').find(".list-area").text($(this).text());
        $(this).parents('.form-select').removeClass('open');
    }
);

$(document).mouseup(function (e){
    var div = $(".form-select");
    if (!div.is(e.target)
        && div.has(e.target).length === 0) {
        div.removeClass('open');
    }
    
});



$(document).on('change', ".box-choose-select",
    function(){
        $(this).parents(".parent-choose-select").find(".inp-show-js").removeClass('active');
        $(this).parents(".parent-choose-select").find(".inp-show-js[data-choose-select='"+$(this).attr("data-choose-select")+"']").addClass('active');
        
});
$(document).on("focus", "input.focus-anim",
    function(){
        if($(this).val() == "")
            $(this).parent().addClass('in-focus');

        
    }
);
$(document).on("blur", "input.focus-anim",
    function(){
        if($(this).val() == "")
            $(this).parent().removeClass('in-focus');

        
    }
);
/**/
$(document).on("keypress", ".only-num",
    function(e){
        e = e || event;
        if(e.ctrlKey || e.altKey || e.metaKey) return;
        var chr = getChar(e);
        if(chr == null) return;
        if(chr < '0' || chr > '9'){
            return false;
        }
    }
);
/*focus input*/
$(document).on("focus", "input.focus-anim, textarea.focus-anim",
    function(){
        if($(this).val() == "")
            $(this).parent().addClass('in-focus');

        
    }
);
$(document).on("blur", "input.focus-anim, textarea.focus-anim",
    function(){
        element = $(this);
        var timeOut = setTimeout(
            function(){
                if(element.val() == "")
                    element.parent().removeClass('in-focus');

                clearTimeout(timeOut);
            }, 200
        );

        
    }
);

$(document).on('click', '.inp-show-js-padding',
    function(){

        var str = $(this).find(".inp-show-js-length").text().length;

        if(str >= 48)
            $(this).find("textarea").addClass('two-rows');

        if(str >= 78)
            $(this).find("textarea").addClass('three-rows');
  
    }
);

