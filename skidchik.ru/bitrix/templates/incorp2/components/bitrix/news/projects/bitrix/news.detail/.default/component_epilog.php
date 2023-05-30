<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?if($arResult['PROPERTIES']['LINK_REVIEWS']['VALUE']):?>
<div class="reviews reviews_in project">
	<span class="title"><?=$arResult['PROPERTIES']['LINK_REVIEWS']['NAME']?></span>
	<?
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "PROPERTY_*");
	$arFilter = Array( "IBLOCK_ID"=>CIBlockElement::GetIBlockByID($arResult['PROPERTIES']['LINK_REVIEWS']['VALUE']), "ID"=> $arResult['PROPERTIES']['LINK_REVIEWS']['VALUE'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$arProps = $ob->GetProperties();
	}
	$photo = CFile::GetPath($arFields['PREVIEW_PICTURE']);
	?>
	<div class="item">
		<div class="reviews_item">
			<div class="top clearfix">
				<div class="photo">
					<?if($photo):?>
					<img src="<?=$photo?>" alt="<?=$arFields['NAME']?>"/>
					<?else:?>
					<img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.jpg" alt="<?=$arFields['NAME']?>"/>
					<?endif;?>
				</div>
				<div class="right"> 
					<span class="name"><?=$arFields['NAME']?></span>
					<span class="post"><?=$arProps['AUTHOR']['VALUE']?></span>
				</div>
			</div>
			<div class="bottom">
				<span class="quote"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
				<p><?=$arFields['PREVIEW_TEXT']?></p>
			</div>
		</div>
	</div>
</div>
<?endif;?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"project_section", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => $arResult['IBLOCK_ID'],
		"IBLOCK_TYPE" => "vbf_incorp2_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PARENT_SECTION" => $arResult['IBLOCK_SECTION_ID'],
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "PROJECT_S",
			1 => "",
		),
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "project_section"
	),
	false
);?>

<?
if($arResult['PROPERTIES']['GOODS']['VALUE']):
	?>
	<div class="picking">
		<span class="title_block_small"><?=Loc::getMessage("GOODS")?></span>
		<?$GLOBALS['arrSaleFilter'] = array('ID' => $arResult['PROPERTIES']['GOODS']['VALUE']); ?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"catalog_item",
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"FILTER_NAME" => "arrSaleFilter",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_catalog"]["vbf_incorp2_catalog"][0],
				"IBLOCK_TYPE" => "vbf_incorp2_catalog",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "10",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "PRICE",
					1 => "TEG",
					2 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"COMPONENT_TEMPLATE" => "catalog_item"
			),
			false
		);?>
	</div>
	<?
endif;
?>