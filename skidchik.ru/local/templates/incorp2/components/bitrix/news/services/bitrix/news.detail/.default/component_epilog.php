<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?
if($arResult['PROPERTIES']['LINK_TIZERS']['VALUE']):?>
	<div class="advantages advantages_in clearfix">
		<?
		foreach ($arResult['PROPERTIES']['LINK_TIZERS']['VALUE'] as $key => $elementID)
		{
			$res = CIBlockElement::GetByID($elementID);
			if($arElement = $res->GetNext())
				if($arElement['PREVIEW_PICTURE']):
					$arElement['PHOTO_SRC'] = CFile::GetPath($arElement['PREVIEW_PICTURE']);
				endif;
				?>
				<div class="item">
					<div>
						<div>
							<div class="icon">
								<img src="<?=$arElement['PHOTO_SRC']?>" alt="<?=$arElement['NAME']?>" />                    
							</div>
							<span><?=$arElement['NAME']?></span>
						</div>
					</div>
				</div>
				<?
			}
			?>

		</div>
		<?
	endif;
	?>

<div class="tabs">
	<ul class="tabs_caption">
		<li class="active"><?=Loc::getMessage("DESCRIPTION");?></li>
		<?if($arResult['PROPERTIES']['FAQ']['VALUE']):?>
		<li><?=Loc::getMessage("FAQ")?></li>                       
		<?endif;?>  
	</ul>

	<div class="tabs_content active">
		<?=$arResult['DETAIL_TEXT']?>
	</div>
	<?if($arResult['PROPERTIES']['FAQ']['VALUE']):?>
	<div class="tabs_content">

		<?foreach ($arResult['PROPERTIES']['FAQ']['VALUE'] as $key => $arElement) 
		{
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT");
			$arFilter = Array( "IBLOCK_ID"=>CIBlockElement::GetIBlockByID($arElement), "ID"=> $arElement, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
			while($ob = $res->GetNextElement())
			{
				$arFaq = $ob->GetFields();
			}
			?>
			<h3><?=$arFaq['NAME']?></h3>
			<p><?=$arFaq['PREVIEW_TEXT']?></p>
			<?
		}
		?>

	</div>
	<?endif;?>
</div>

<?if($arResult['PROPERTIES']['DOCUMENTS']['VALUE']):?>
<div class="docs">
	<span class="title"><?=$arResult['PROPERTIES']['DOCUMENTS']['NAME']?></span>
	<?foreach($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $docID):?>
	<?$arItem = CIncorp2::get_file_info($docID);
	$fileName = substr($arItem['ORIGINAL_NAME'], 0, strrpos($arItem['ORIGINAL_NAME'], '.'));
	$fileTitle = (strlen($arItem['DESCRIPTION']) ? $arItem['DESCRIPTION'] : $fileName);
	?>                               
	<div class="item">
		<div class="doc <?=$arItem["TYPE"];?>">
			<a href="<?=$arItem['SRC']?>"><?=$fileTitle?></a>
			<span><?=Loc::getMessage("SIZE")?>: <?=CIncorp2::filesize_format($arItem['FILE_SIZE']);?></span>
		</div>
	</div>
	<?endforeach;?>  
</div>
<?endif;?>

<?if($arResult['PROPERTIES']['GALLERY']['VALUE']):?>
<div class="gallery">
	<span class="title"><?=$arResult['PROPERTIES']['GALLERY']['NAME']?></span>
	<div class="slider_gallery">
		<?
		foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $key => $slideID)
		{
			$imgSRC = CFile::GetPath($slideID);
			?>
			<div class="item">
				<a data-fancybox="gallery1" href="<?=$imgSRC?>">
					<div class="pic" style="background-image: url(<?=$imgSRC?>);"></div>
				</a>                            
			</div>
			<?
		}
		?>
	</div>
</div>
<?endif;?>

<?if($arResult['PROPERTIES']['LINK_REVIEWS']['VALUE']):?>
<div class="reviews reviews_in">
	<span class="title"><?=$arResult['PROPERTIES']['LINK_REVIEWS']['NAME']?></span>
	<div class="slider_reviews_in">
		<?foreach ($arResult['PROPERTIES']['LINK_REVIEWS']['VALUE'] as $key => $arElement) 
		{
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "PROPERTY_*");
			$arFilter = Array( "IBLOCK_ID"=>CIBlockElement::GetIBlockByID($arElement), "ID"=> $arElement, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
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
			<?
		}
		?>
	</div>
</div>
<?endif;?>


<?if($arResult['PROPERTIES']['GOODS']['VALUE']):?>
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
			"PAGER_TITLE" => "Новости",
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
<?endif;?>

<?if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
{
	?>
	<style>
		.ya-share2 {
			margin-top: 20px;
			float: right;
		}
	</style>
	<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
	<script src="//yastatic.net/share2/share.js"></script>
	<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,viber,whatsapp,skype,telegram"></div>
	<?
}
?>