<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('vebfabrika.incorp2');
$id = (isset($_REQUEST["id"]) ? $_REQUEST["id"] : false);
$arFrontParametrs = CIncorp2::GetFrontParametrsValues(SITE_ID);
$captcha = (in_array($arFrontParametrs['USE_CAPTCHA_FORM'], array('HIDDEN', 'IMAGE')) ? $arFrontParametrs['USE_CAPTCHA_FORM'] : 'NONE');
if(($arFrontParametrs['USE_GOOGLE_RECAPTCHA'] == "Y") && $arFrontParametrs['USE_CAPTCHA_FORM'] == "IMAGE"){
	$captcha = 'RECAPTCHA';
}
$captchacolor = $arFrontParametrs['GOOGLE_RECAPTCHA_COLOR'];
$captchasize = $arFrontParametrs['GOOGLE_RECAPTCHA_SIZE'];
$processing = ($arFrontParametrs['DISPLAY_PROCESSING_NOTE'] === 'Y' ? 'Y' : 'N');
$processing_checked = ($arFrontParametrs['PROCESSING_NOTE_CHECKED'] === 'Y' ? 'Y' : 'N');
$isCallBack = $id == CCache::$arIBlocks[SITE_ID]["vbf_incorp2_forms"]["vbf_incorp2_callback"][0];
$isSale = $id == CCache::$arIBlocks[SITE_ID]["vbf_incorp2_forms"]["vbf_incorp2_sale"][0];
$successMessage = ($isCallBack ? "<p>Мы перезвоним вам в ближайшее время.<br/>Спасибо за ваше обращение!</p>" : "<p>Ваша заявка принята, мы свяжемся с Вами в самое ближайшее время.</p>");
$successMessage = ($isSale ? "<p>Мы свяжемся с Вами в ближайшее время.</p>" : "<p>Ваша заявка принята, мы свяжемся с Вами в самое ближайшее время.</p>");

?>
<span class="jqmClose top-close fa fa-close"></span>
<?if($id):?>
	<?$APPLICATION->IncludeComponent(
		"vebfabrika:forms.incorp2", "popup",
		Array(
			"IBLOCK_TYPE" => "vbf_incorp2_forms",
			"IBLOCK_ID" => $id,
			"USE_CAPTCHA" => $captcha,
			"RECAPTCHA_COLOR" => $captchacolor,
			"RECAPTCHA_SIZE" => $captchasize,
			"DISPLAY_PROCESSING_NOTE" => $processing,
			"PROCESSING_NOTE_CHECKED" => $processing_checked,
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "100000",
			"AJAX_OPTION_ADDITIONAL" => "",
			"SUCCESS_MESSAGE" => $successMessage,
			"SEND_BUTTON_NAME" => "Отправить",
			"SEND_BUTTON_CLASS" => "btn color send",
			"DISPLAY_CLOSE_BUTTON" => "Y",
			"POPUP" => "Y",
			"CLOSE_BUTTON_NAME" => "Закрыть",
			"CLOSE_BUTTON_CLASS" => "jqmClose btn btn-default bottom-close"
		)
	);?>
<?endif;?>