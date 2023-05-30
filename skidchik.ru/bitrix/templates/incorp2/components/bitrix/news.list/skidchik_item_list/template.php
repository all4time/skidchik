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
global $arTheme;
$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y'); 
$basketURL = (isset($arTheme['URL_BASKET_SECTION']) && strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? $arTheme['URL_BASKET_SECTION']['VALUE'] : SITE_DIR.'cart/');
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
<?=$arResult["NAV_STRING"]?><br/>
<?endif;?>

<?//printr($arResult['ITEMS']);?>

<div class="catalog_items">
	<div class="tile tile_in clearfix">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		$dataItem = ($bOrderViewBasket ? CIncorp2::getDataItem($arItem) : false);
		if($arTheme['MONEY_FRACTIONS']['VALUE'] == 'Y'){
			$decimals = 2;
		}else{
			$decimals = 0;
		}
		?>
		<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" data-id="<?=$arItem['ID']?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?>>
			<div>
				<div class="top">
					<?if($arItem['PROPERTIES']['PLASHKA']['VALUE']):?>
					<?foreach ($arItem['PROPERTIES']['PLASHKA']['VALUE'] as $plKey => $plValue)
					{?>
						<span class="shild <?=$arItem['PROPERTIES']['PLASHKA']['VALUE_XML_ID'][$plKey]?>"><?=$plValue?></span><?
					}?>
					<?endif;?> 
				</div>
				<div class="pic">   
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>" /></a>
				</div>
				<div class="description">
					<span class="name"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></span>
					<span class="availability <?=$arItem['PROPERTIES']['STATUS']['VALUE_XML_ID']?>"><?=$arItem['PROPERTIES']['STATUS']['VALUE']?></span>
					<?if($arItem['PROPERTIES']['PRICE_NO']['VALUE']):?>
					<span class="price"><?=GetMessage('PRICE_NO')?></span>
					<?else:?>
					<span class="price"><?if($arItem['PROPERTIES']['PRICE']['VALUE']):?><?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'], $decimals, '.', ' ');?> <?=CIncorp2::getCurrency();?><?=($arItem['PROPERTIES']['UNIT']['VALUE'] ? '/'.$arItem['PROPERTIES']['UNIT']['VALUE'] : '')?><?endif;?> <?if($arItem['PROPERTIES']['OLD_PRICE']['VALUE']):?><span class="old_price"><?=number_format($arItem['PROPERTIES']['OLD_PRICE']['VALUE'], $decimals, '.', ' ');?> <?=CIncorp2::getCurrency();?></span><?endif;?></span>
					<?endif;?>
					<?if($arItem['PROPERTIES']['STATUS']['VALUE_XML_ID'] == "presence"):?>
					<div class="btn_container buy_block bottom clearfix">
						<?if(($arTheme['ORDER_VIEW']['VALUE'] == 'Y') && (!$arResult['PROPERTIES']['PRICE_NO']['VALUE_XML_ID'] == 'Y')):?>
						<?if($arItem['PROPERTIES']['FORM_ORDER']['VALUE']):?>
						<div>
							<div class="amount counter">
								<button class="act minus ctrl bgtransition"><i class="fa fa-minus" aria-hidden="true"></i></button>
								<div class="input"><input type="text" value="1" class="count" maxlength="5"></div>
								<button class="act plus ctrl bgtransition"><i class="fa fa-plus" aria-hidden="true"></i></button>
								<input type="hidden" name="PRICE" value="<?=$arResult['PROPERTIES']['PRICE']['VALUE']?>">
							</div>                                                
						</div>
						<div>
							<div>
								<button class="btn btn_main to_cart" data-quantity="1"><?=($arParams['DETAIL_FORM_ORDER_TEXT'] ? $arParams['DETAIL_FORM_ORDER_TEXT'] : GetMessage('ADD_TO_CART'))?></button>
								<a href="<?=$basketURL?>" class="btn btn_main in_cart"><span><?=GetMessage('IN_CART')?></span></a>
							</div>
						</div>
						<?endif;?>
						<?else:?>
						<?if($arItem['PROPERTIES']['FORM_ORDER']['VALUE']):?>
						<a class="btn btn_main order" data-event="jqm" data-param-id="<?=CIncorp2::getFormID("vbf_incorp2_order_product");?>" data-autoload-need_product="<?=$arItem['NAME']?>" data-name="order_product"><?=($arParams['DETAIL_FORM_QUESTION_TEXT'] ? $arParams['DETAIL_FORM_QUESTION_TEXT'] : GetMessage('BUTTON_ORDER'))?></a>
						<?endif;?>
						<?endif;?>
					</div>
					<?endif;?>
				</div>
			</div>
		</div>
		<?endforeach;?>
	</div>
</div>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<?=$arSection["DESCRIPTION"]?>