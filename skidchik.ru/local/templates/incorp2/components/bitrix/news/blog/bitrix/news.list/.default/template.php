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
$curdir = $APPLICATION->GetCurDir();
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?$this->SetViewTarget('nav');?>
<ul class="tabs_caption">
	<li<?if($curdir == $arParams['IBLOCK_URL']):?> class="active"<?endif;?>><a href="<?=$arParams['IBLOCK_URL']?>"><?=GetMessage("ALL")?></a></li>
	<?foreach($arResult['SECTIONS'] as $arItemSect):?>
	<?
                // edit/add/delete buttons for edit mode
	$arSectionButtons = CIBlock::GetPanelButtons($arItemSect['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
	$this->AddEditAction($arItemSect['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItemSect['IBLOCK_ID'], 'SECTION_EDIT'));
	$this->AddDeleteAction($arItemSect['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItemSect['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        //if section = dir
	if($arItemSect['SECTION_PAGE_URL'] == $curdir): $dir = 'y'; endif;
	?>
	<li <?=($dir ? 'class="active"' : '')?> id="<?=$this->GetEditAreaId($arItemSect['ID'])?>"><a href="<?=$arItemSect['SECTION_PAGE_URL']?>"><?=$arItemSect['NAME']?></a></li>
	<?unset($dir);?>
	<?endforeach;?>
</ul>
<?$this->EndViewTarget();?> 

<div class="items clearfix">
	<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
	if($arSection = $res->GetNext());
	?>
	<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="pic" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"></a></div>
		<div class="description">
			<div class="clearfix">
				<span class="theme"><?=$arSection['NAME']?></span>
				<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
				<span class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
				<?endif;?>
			</div>
			<span class="title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></span>
		</div>
	</div>
	<?endforeach;?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>