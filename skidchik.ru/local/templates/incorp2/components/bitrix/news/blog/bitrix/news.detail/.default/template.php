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
<div class="paper">
	<div class="detail_text">
		<?=$arResult["PREVIEW_TEXT"];?>
	</div>
	<?if($arResult["DETAIL_PICTURE"]["SRC"]):?>
		<div class="pic_main">
			<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>"/>
		</div>
	<?endif;?>
	<?if($arResult['TAGS']):?>
		<ul class="reference">
			<?$arTags = explode(",", $arResult['TAGS']);?>
			<?foreach($arTags as $text):?>
				<li><a href="<?=SITE_DIR;?>search/index.php?tags=<?=htmlspecialcharsex($text);?>" rel="nofollow"><?=$text;?></a></li>
			<?endforeach;?>
		</ul>
	<?endif;?>
	<div class="detail_text">
		<?=$arResult["DETAIL_TEXT"];?>
	</div>
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
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
	<span class="published"><?=GetMessage("DATE")?>: <?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
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
</div>