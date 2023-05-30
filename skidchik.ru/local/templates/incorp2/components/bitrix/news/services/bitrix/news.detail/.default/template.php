<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if($arResult['PROPERTIES']['BANNER']['VALUE']):?>
<?$this->SetViewTarget("show_banner");?>
<?CIncorp2::ShowTopDetailBanner($arResult, $arParams);?>
<style>
	.content h1 { display: none; }
	.content_top .inner { padding-bottom: 0px; }
</style>
<?$this->EndViewTarget();?>
<?endif;?>

<?if(($arResult['DETAIL_PICTURE']['SRC']) || ($arResult['PREVIEW_TEXT']) || ($arResult['PROPERTIES']['FORM_REQUEST']['VALUE'] == "YES")):?>
<div class="service_detail">
	<?if($arResult['DETAIL_PICTURE']['SRC']):?>
	<div class="pic">
		<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>"/>
	</div>   
	<?endif;?>
	<div class="bottom">
		<?if(($arResult['PREVIEW_TEXT']) && (!$arResult['PROPERTIES']['BANNER']['VALUE'])):?>
		<div class="description">
			<span><?=$arResult['NAME']?></span>
			<p><?=$arResult['PREVIEW_TEXT']?></p>                            
		</div>
		<?endif;?>
		<?if($arResult['PROPERTIES']['FORM_REQUEST']['VALUE'] == "YES"):?>
		<div class="action clearfix">
			<div class="col">
				<div class="profit">
					<div class="circle"><span><i class="fa fa-check" aria-hidden="true"></i></span></div>
					<span><?=$arParams['DETAIL_FORM_TEXT']?></span>
					<div class="text_block">
						<?$APPLICATION->IncludeComponent(
							'bitrix:main.include',
							'',
							array(
								"AREA_FILE_SHOW" => "page",
								"AREA_FILE_SUFFIX" => "ask",
								"EDIT_TEMPLATE" => ""
							)
						);?>
					</div>
				</div>
			</div>
			<div class="col">
				<a class="btn btn_main" data-event="jqm" data-param-id="<?=($arParams['DETAIL_FORM_ID'] ? $arParams['DETAIL_FORM_ID'] : CIncorp2::getFormID("vbf_incorp2_request"));?>" data-name="request"><?=$arParams['DETAIL_FORM_BUTTON']?></a>
			</div>
		</div>
		<?endif;?>
	</div>
</div>
<?endif;?>