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

<div class="worker">
	<div class="clearfix">
		<div class="items">
			<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<ul class="soc"> 
					<?if($arItem["PROPERTIES"]["VK"]["VALUE"]):?>
					<li><a href="<?=$arItem["PROPERTIES"]["VK"]["VALUE"]?>"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
					<?endif;?>
					<?if($arItem["PROPERTIES"]["FB"]["VALUE"]):?>
					<li><a href="<?=$arItem["PROPERTIES"]["FB"]["VALUE"]?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>  
					<?endif;?>                           
				</ul>
				<?if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
				<div class="photo"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"></div>
				<?endif;?>
				<span class="name"><?=$arItem["NAME"]?></span>
				<?if($arItem["PROPERTIES"]["POST"]["VALUE"]):?>
				<span class="post"><?=$arItem["PROPERTIES"]["POST"]["VALUE"]?></span>
				<?endif;?>
				<?if($arItem["PREVIEW_TEXT"]):?>
				<p><?=$arItem["PREVIEW_TEXT"];?></p>
				<?endif;?>
				<?if($arItem["PROPERTIES"]["PHONE"]["VALUE"]):?>
				<span class="phone"><?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?></span>
				<?endif;?>
				<?if($arItem["PROPERTIES"]["EMAIL"]["VALUE"]):?>
				<a href="mailto:<?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?>" class="mail"><?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?></a>
				<?endif;?>
			</div>
			<?endforeach;?>
		</div>
	</div>           
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>                             
</div>