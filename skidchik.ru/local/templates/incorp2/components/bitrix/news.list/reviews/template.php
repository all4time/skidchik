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
<div class="reviews reviews_in reviews_nonslider">
	<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="reviews_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="top clearfix">
			<div class="photo">
				<?if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>"/>
				<?else:?>
				<img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.jpg" alt="<?echo $arItem["NAME"]?>"/>
				<?endif;?>
			</div>
			<div class="right"> 
				<span class="name"><?echo $arItem["NAME"]?></span>
				<span class="post"><?=$arItem['PROPERTIES']['AUTHOR']['VALUE']?></span>
			</div>
			<ul class="soc"> 
				<?if($arItem['PROPERTIES']['VK_LINK']['VALUE']):?><li><a href="<?=$arItem['PROPERTIES']['VK_LINK']['VALUE']?>" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a></li><?endif;?>
				<?if($arItem['PROPERTIES']['FB_LINK']['VALUE']):?><li><a href="<?=$arItem['PROPERTIES']['FB_LINK']['VALUE']?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?endif;?>
			</ul>
		</div>
		<div class="bottom">
			<span class="quote"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
			<p><?echo $arItem["PREVIEW_TEXT"];?></p>
			<?if($arItem['PROPERTIES']['DOCUMENTS']['VALUE']):?>
			<div class="docs">
				<?foreach($arItem['PROPERTIES']['DOCUMENTS']['VALUE'] as $docID):?>
				<?$arDoc = CIncorp2::get_file_info($docID);
				$fileName = substr($arDoc['ORIGINAL_NAME'], 0, strrpos($arDoc['ORIGINAL_NAME'], '.'));
				$fileTitle = (strlen($arDoc['DESCRIPTION']) ? $arDoc['DESCRIPTION'] : $fileName);
				?>                               
				<div class="item">
					<div class="doc <?=$arDoc["TYPE"];?>">
						<a href="<?=$arDoc['SRC']?>"><?=$fileTitle?></a>
						<span><?=GetMessage('SIZE')?>: <?=CIncorp2::filesize_format($arDoc['FILE_SIZE']);?></span>
					</div>
				</div>
				<?endforeach;?>                           
			</div>
			<?endif;?>
		</div>
	</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>