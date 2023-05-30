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

<div class="docs page">
	<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?$arItemFile = CIncorp2::get_file_info($arItem['PROPERTIES']['DOCS']['VALUE']);
	$fileName = substr($arItemFile['ORIGINAL_NAME'], 0, strrpos($arItemFile['ORIGINAL_NAME'], '.'));
	$fileTitle = (strlen($arItemFile['DESCRIPTION']) ? $arItemFile['DESCRIPTION'] : $fileName);
	?>                               
	<div class="item">
		<div class="doc <?=$arItemFile["TYPE"];?>">
			<a href="<?=$arItemFile['SRC']?>"><?=$arItem['NAME']?></a>
			<span><?=GetMessage('SIZE')?>: <?=CIncorp2::filesize_format($arItemFile['FILE_SIZE']);?></span>
		</div>
	</div>
	<?endforeach;?>  
</div>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>