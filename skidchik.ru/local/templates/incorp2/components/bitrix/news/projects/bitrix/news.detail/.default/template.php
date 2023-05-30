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
$resImagePrev = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], Array("width" => 350, "height" => 350), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
$resImagePrevMin = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], Array("width" => 100, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
?>
<?if($arResult['PROPERTIES']['BANNER']['VALUE']):?>
<?$this->SetViewTarget("show_banner");?>
<?CIncorp2::ShowTopDetailBanner($arResult, $arParams);?>
<?$this->EndViewTarget();?>
<?endif;?>

<div class="good projects_good">
	<div class="good_top clearfix">
		<div class="left">
			<div class="slider_good"> 
				<div class="slider_good_top">     
					<ul class="bxslider_2">  
						<?if($arResult["DETAIL_PICTURE"]["SRC"]):?>                                                       
						<li><a class="fancybox" data-fancybox="gallery" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"><img src="<?=$resImagePrev["src"]?>" /></a></li>
						<?endif;?>
						<?foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $key => $photoID) {
							$photoSRC = CFile::GetPath($photoID);
							$resImage = CFile::ResizeImageGet($photoID, Array("width" => 350, "height" => 350), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
							?> 
							<li>
								<a class="fancybox" data-fancybox="gallery" href="<?=$photoSRC?>">
									<img src="<?=$resImage['src']?>" />
								</a>
							</li>
							<?
						}?>
					</ul>
				</div>               
				<?if($arResult['PROPERTIES']['PHOTOS']['VALUE']):?>              
				<ul class="slider_good_bottom bxslider_2_1" id="bx-pager">
					<?if($arResult["DETAIL_PICTURE"]["SRC"]):?>
					<a data-slide-index="0" href="<?=$resImagePrevMin["src"]?>"><img src="<?=$resImagePrevMin["src"]?>" /></a>
					<?endif;?>
					<?foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $key => $photoID) {
						$resImage = CFile::ResizeImageGet($photoID, Array("width" => 100, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
						?>  
						<a data-slide-index="<?=$key+1?>" href="<?=$resImage['src']?>"><img src="<?=$resImage['src']?>" /></a>
						<?
					}?>
				</ul>
				<?endif;?>
			</div>
		</div>
		<div class="right">
			<div>
				<?if($arResult['PROPERTIES']['PROJECT_S']['VALUE']):?><span class="quantity"><?=$arResult['PROPERTIES']['PROJECT_S']['VALUE']?></span><?endif;?>
				<?if($arResult['PROPERTIES']['PRICE']['VALUE']):?><span class="cost"><?=$arResult['PROPERTIES']['PRICE']['VALUE']?></span><?endif;?>
			</div>
			<div class="description">
				<?=$arResult['PREVIEW_TEXT']?>
			</div>
			<div class="btn_container">
				<div>
					<div>
						<a class="btn btn_main" data-event="jqm" data-param-id="<?=($arParams['DETAIL_FORM_ID'] ? $arParams['DETAIL_FORM_ID'] : CIncorp2::getFormID("vbf_incorp2_request"));?>" data-autoload-product="<?=CIncorp2::formatJsName($arResult['NAME'])?>" data-name="request"><?=$arParams['DETAIL_FORM_BUTTON']?></a>
					</div>                                             
				</div>
				<div>
					<div>
						<a class="btn btn_white" data-event="jqm" data-param-id="<?=CIncorp2::getFormID("vbf_incorp2_question");?>" data-autoload-need_product="<?=CIncorp2::formatJsName($arResult['NAME'])?>" data-name="question"><?=GetMessage('BUTTON_TEXT')?></a>
					</div>
				</div>

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
		</div>
	</div>

	<?
	if($arResult['PROPERTIES']['TIZER']['VALUE']):?>
		<div class="advantages advantages_in clearfix">
			<?
			foreach ($arResult['PROPERTIES']['TIZER']['VALUE'] as $key => $elementID)
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
				<li class="active"><?=GetMessage('TAB_1')?></li>
				<?if($arResult["DISPLAY_PROPERTIES"]):?><li><?=GetMessage('TAB_2')?></li><?endif;?>
				<?if($arResult['PROPERTIES']['DOCUMENTS']['VALUE']):?><li><?=GetMessage('TAB_3')?></li><?endif;?>
			</ul>

			<div class="tabs_content active">
				<div class="detail">
					<?=$arResult['DETAIL_TEXT']?>
				</div>
			</div>
			<?
			if($arResult["DISPLAY_PROPERTIES"]):
				?>
				<div class="tabs_content">
					<div class="characteristic">
						<ul>
							<?
							foreach($arResult["DISPLAY_PROPERTIES"] as $arProp):
								?>
								<li>
									<span><?=$arProp['NAME']?></span>
									<span><?=$arProp['VALUE']?></span>
								</li>
								<?
							endforeach;
							?>
						</ul>
					</div>
				</div>
				<?
			endif;
			?>
			<?if($arResult['PROPERTIES']['DOCUMENTS']['VALUE']):?>
			<div class="tabs_content">
				<div class="docs">
					<?
					foreach($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $docID):
						$arItem = CIncorp2::get_file_info($docID);
						$fileName = substr($arItem['ORIGINAL_NAME'], 0, strrpos($arItem['ORIGINAL_NAME'], '.'));
						$fileTitle = (strlen($arItem['DESCRIPTION']) ? $arItem['DESCRIPTION'] : $fileName);
						?>                               
						<div class="item">
							<div class="doc <?=$arItem["TYPE"];?>">
								<a href="<?=$arItem['SRC']?>"><?=$fileTitle?></a>
								<span><?=GetMessage('SIZE')?>: <?=CIncorp2::filesize_format($arItem['FILE_SIZE']);?></span>
							</div>
						</div>
						<?
					endforeach;
					?>  
				</div>
			</div>    
			<?
		endif;
		?>                    
	</div>
</div>
<div class="ques ques_in clearfix">
	<div class="left clearfix">
		<div class="sign"><span>?</span></div>
		<div class="description">
			<span class="title"><?=GetMessage('FORM_LINE_1_TEXT')?></span>
			<p><?=GetMessage('FORM_LINE_2_TEXT')?></p>
		</div>
	</div>
	<div class="right">
		<a class="btn btn_main" data-event="jqm" data-param-id="<?=CIncorp2::getFormID("vbf_incorp2_question");?>" data-autoload-need_product="<?=$arResult['NAME']?>" data-name="question"><?=GetMessage('BUTTON_TEXT')?></a>
	</div>
</div>