<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"])):?>
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
    <div class="search_results__listing__block">
        <div class="search_results__listing__block_image"><img src="<?=$arItem["PHOTO"]?>"></div>
        <a class="search_results__listing__block_heading" href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
    </div>
			<?endforeach;?>
		<?endforeach;?>
<?endif;
?>