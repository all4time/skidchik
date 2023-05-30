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

<?if($arResult['ITEMS']):?>
<div class="catalog_list line">
	<div class="inner work clearfix">
		<div class="clearfix">
			<?if($arParams['TITLE']):?><h2 class="title_block"><?=$arParams['TITLE']?></h2><?endif;?>
			<?if($arParams['ALL_LINK']):?><a class="more" href="<?=$arParams['ALL_LINK']?>"><span><?=$arParams['LINK_NAME']?></span></a><?endif;?>
		</div>
		<div class="items clearfix">
			<?foreach($arResult['ITEMS'] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
       // preview picture
				$imageSrc = ($arItem['PREVIEW_PICTURE']['SRC'] ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH.'/images/noimage_sections.png');
			?>
			<div class="item" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
				<div class="clearfix">
					<div class="top">
						<div class="pic">
							<div><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=SITE_TEMPLATE_PATH?>/img/loader_lazy.svg" data-src="<?=$imageSrc?>" class="b-lazy" alt="<?=$arItem['NAME']?>"/></a></div>
						</div>
					</div>
					<div class="bottom">
						<span class="title"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></span>                               
					</div>
				</div>
			</div>
			<?endforeach;?>
		</div>
	</div>
</div>
<?endif;?>