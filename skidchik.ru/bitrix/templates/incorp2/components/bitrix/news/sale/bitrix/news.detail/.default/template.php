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
<div class="news_detail">
	<?echo $arResult["PREVIEW_TEXT"];?>
	<?if($arResult["DETAIL_PICTURE"]["SRC"]):?>
		<div class="pic_main">
			<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>"/>
		</div>   
	<?endif;?>
	<?echo $arResult["DETAIL_TEXT"];?>
</div>


<?if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
{
	?>
	<div class="widget">
		<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
		<script src="https://yastatic.net/share2/share.js"></script>
		<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,viber,whatsapp,skype,telegram"></div>
	</div>
	<?
}
?>

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
