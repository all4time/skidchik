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
global $arTheme;
$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y'); 
$basketURL = (isset($arTheme['URL_BASKET_SECTION']) && strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? $arTheme['URL_BASKET_SECTION']['VALUE'] : SITE_DIR.'cart/');
$dataItem = ($bOrderViewBasket ? CIncorp2::getDataItem($arResult) : false);
$resImagePrev = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], Array("width" => 300, "height" => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
$resImagePrevMin = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], Array("width" => 100, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
if($arTheme['MONEY_FRACTIONS']['VALUE'] == 'Y'){
	$decimals = 2;
}else{
	$decimals = 0;
}
?>
<div class="good" data-id="<?=$arResult['ID']?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?> itemscope itemtype="http://schema.org/Product">
	<meta itemprop="name" content="<?=$arResult['NAME']?>">
	<link itemprop="url" href="<?=$arResult['DETAIL_PAGE_URL']?>">
	<div class="good_top clearfix">
		<div class="left">
			<div class="slider_good"> 
				<div class="slider_good_top detail_photo">     
					<div class="top">
						<?if($arResult['PROPERTIES']['PLASHKA']['VALUE']):?>
						<?foreach ($arResult['PROPERTIES']['PLASHKA']['VALUE'] as $plKey => $plValue)
						{?>
							<span class="shild <?=$arResult['PROPERTIES']['PLASHKA']['VALUE_XML_ID'][$plKey]?>"><?=$plValue?></span><?
						}?>
						<?endif;?> 
					</div>                             
					<ul class="bxslider_2">                                                         
						<li><a class="fancybox" data-fancybox="gallery" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"><img src="<?=$resImagePrev["src"]?>" alt="<?=$arResult['NAME']?>" itemprop="image"/></a></li>
						<?foreach ($arResult['PROPERTIES']['PHOTO']['VALUE'] as $key => $photoID) {
							$photoSRC = CFile::GetPath($photoID);
							$resImage = CFile::ResizeImageGet($photoID, Array("width" => 300, "height" => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
							?> 
							<li><a class="fancybox" data-fancybox="gallery" href="<?=$photoSRC?>"><img src="<?=$resImage["src"]?>" alt="<?=$arResult['NAME']?>" itemprop="image" /></a></li>
							<?
						}?>
					</ul>
				</div>               
				<?if($arResult['PROPERTIES']['PHOTO']['VALUE']):?>              
				<ul class="slider_good_bottom bxslider_2_1" id="bx-pager">
					<a data-slide-index="0" href="<?=$resImagePrevMin["src"]?>"><img src="<?=$resImagePrevMin["src"]?>" alt="<?=$arResult['NAME']?>" /></a>
					<?foreach ($arResult['PROPERTIES']['PHOTO']['VALUE'] as $key => $photoID) {
						$resImage = CFile::ResizeImageGet($photoID, Array("width" => 100, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
						?> 
						<a data-slide-index="<?=$key+1?>" href="<?=$resImage["src"]?>"><img src="<?=$resImage["src"]?>" alt="<?=$arResult['NAME']?>" /></a>
						<?
					}?>
				</ul>
				<?endif;?>
			</div>
		</div>

		<div class="right" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="price" content="<?=number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 0, ',', '');?>">
			<meta itemprop="priceCurrency" content="RUB">
			<?if($arResult['PROPERTIES']['STATUS']['VALUE_XML_ID'] == 'presence'):?><link itemprop="availability" href="http://schema.org/InStock"><?endif;?>
			<span class="availability <?=$arResult['PROPERTIES']['STATUS']['VALUE_XML_ID']?>"><?=$arResult['PROPERTIES']['STATUS']['VALUE']?> <?if($arResult['PROPERTIES']['ARTICLE']['VALUE']):?>/ <?=$arResult['PROPERTIES']['ARTICLE']['NAME']?>: <?=$arResult['PROPERTIES']['ARTICLE']['VALUE']?><?endif;?></span> 

			<?if($arResult['PROPERTIES']['PRICE']['VALUE']):?>
			<span class="price"><?=number_format($arResult['PROPERTIES']['PRICE']['VALUE'], $decimals, '.', ' ');?> <?=CIncorp2::getCurrency();?><?=($arResult['PROPERTIES']['UNIT']['VALUE'] ? '/'.$arResult['PROPERTIES']['UNIT']['VALUE'] : '')?> 
			<?if($arResult['PROPERTIES']['OLD_PRICE']['VALUE']):?><span class="old_price"><?=number_format($arResult['PROPERTIES']['OLD_PRICE']['VALUE'], $decimals, '.', ' ');?> <?=CIncorp2::getCurrency();?></span><?endif;?>
		</span>
		<?endif;?>
		<div class="description">
			<?echo $arResult["PREVIEW_TEXT"];?>
		</div>
		<?
		$frame = $this->createFrame()->begin();
		$frame->setAnimation(true);
		?>
		<div class="btn_container buy_block">
			<?if(($arTheme['ORDER_VIEW']['VALUE'] == 'Y') && (!$arResult['PROPERTIES']['PRICE_NO']['VALUE_XML_ID'] == 'Y')):?>
			<?if($arResult['PROPERTIES']['FORM_ORDER']['VALUE']):?>
			<div>
				<div class="amount counter">
					<button class="act minus ctrl bgtransition"><i class="fa fa-minus" aria-hidden="true"></i></button>
					<div class="input"><input type="text" value="1" class="count" maxlength="5"></div>
					<button class="act plus ctrl bgtransition"><i class="fa fa-plus" aria-hidden="true"></i></button>
					<input type="hidden" name="PRICE" value="<?=$arResult['PROPERTIES']['PRICE']['VALUE']?>">
				</div>                                                
			</div>
			<div>
				<div>
					<button class="btn btn_main to_cart" data-quantity="1"><?=($arParams['DETAIL_FORM_ORDER_TEXT'] ? $arParams['DETAIL_FORM_ORDER_TEXT'] : GetMessage('BUTTON_TEXT_CART'))?></button>
					<a href="<?=$basketURL?>" class="btn btn_main in_cart"><span><?=GetMessage('IN_CART')?></span></a>
				</div>
			</div>
			<?endif;?>
			<?else:?>
			<?if($arResult['PROPERTIES']['FORM_ORDER']['VALUE']):?>
			<a class="btn btn_main order" data-event="jqm" data-param-id="<?=CIncorp2::getFormID("vbf_incorp2_order_product");?>" data-autoload-need_product="<?=CIncorp2::formatJsName($arResult['NAME'])?>" data-name="order_product"><?=($arParams['DETAIL_FORM_QUESTION_TEXT'] ? $arParams['DETAIL_FORM_QUESTION_TEXT'] : GetMessage('BUTTON_TEXT_1'))?></a>
			<?endif;?>
			<?endif;?>
			<?if($arResult['PROPERTIES']['FORM_QUESTION']['VALUE']):?>
			<a class="btn btn_white" data-event="jqm" data-param-id="<?=CIncorp2::getFormID("vbf_incorp2_question");?>" data-autoload-need_product="<?=CIncorp2::formatJsName($arResult['NAME'])?>" data-name="question"><?=($arParams['DETAIL_FORM_QUESTION_TEXT'] ? $arParams['DETAIL_FORM_QUESTION_TEXT'] : GetMessage('BUTTON_TEXT_2'))?></a>
			<?endif;?>
		</div>
		<?$frame->end();?>
		<?if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
		{
			?>
			<div class="widget">
				<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
				<script src="//yastatic.net/share2/share.js"></script>
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
			<?if($arResult["DISPLAY_PROPERTIES"]):?>
			<li><?=GetMessage('TAB_2')?></li>
			<?endif;?>
			<?if($arResult['PROPERTIES']['FAQ']['VALUE']):?>
			<li><?=GetMessage('TAB_3')?></li>
			<?endif;?>
			<?if($arResult['PROPERTIES']['TAB_NAME']['VALUE']):?>
			<li><?=$arResult['PROPERTIES']['TAB_NAME']['VALUE']?></li>
			<?endif;?>
		</ul>

		<div class="tabs_content active">
			<div class="detail" itemprop="description">
				<?$APPLICATION->IncludeComponent(
					"sprint.editor:blocks",
					".default",
					Array(
						"ELEMENT_ID" => $arResult["ID"],
						"IBLOCK_ID" => $arResult["IBLOCK_ID"],
						"PROPERTY_CODE" => "EDITOR",
					),
					$component,
					Array(
						"HIDE_ICONS" => "Y"
					)
				);?>	
				<?echo $arResult["DETAIL_TEXT"];?>
			</div>
		</div>

		<?if($arResult["DISPLAY_PROPERTIES"]):?>
		<div class="tabs_content">
			<div class="characteristic">
				<span><?=GetMessage('PROPERTIES')?></span>
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
		<?endif;?>

		<?if($arResult['PROPERTIES']['FAQ']['VALUE']):?>
		<div class="tabs_content">
			<?
			foreach ($arResult['PROPERTIES']['FAQ']['VALUE'] as $key => $elementID)
			{
				$res = CIBlockElement::GetByID($elementID);
				if($arElement = $res->GetNext())
					?>
				<h3><?=$arElement['NAME']?></h3>
				<p><?=$arElement['PREVIEW_TEXT']?></p>
				<?
			}
			?>
		</div>
		<?endif;?>

		<?if($arResult['PROPERTIES']['TAB_VALUE']['VALUE']):?>
		<div class="tabs_content">
			<div class="description">
				<?=$arResult['PROPERTIES']['TAB_VALUE']['~VALUE']['TEXT']?>
			</div>
		</div>
		<?endif;?>
	</div>    

	<?if($arResult['PROPERTIES']['DOCUMENTS']['VALUE']):?>
	<h2><?=$arResult['PROPERTIES']['DOCUMENTS']['NAME']?></h2>
	<div class="docs">

		<?foreach($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $docID):?>
		<?$arItem = CIncorp2::get_file_info($docID);
		$fileName = substr($arItem['ORIGINAL_NAME'], 0, strrpos($arItem['ORIGINAL_NAME'], '.'));
		$fileTitle = (strlen($arItem['DESCRIPTION']) ? $arItem['DESCRIPTION'] : $fileName);
		?>                               
		<div class="item">
			<div class="doc <?=$arItem["TYPE"];?>">
				<a href="<?=$arItem['SRC']?>"><?=$fileTitle?></a>
				<span><?=GetMessage('SIZE')?>: <?=CIncorp2::filesize_format($arItem['FILE_SIZE']);?></span>
			</div>
		</div>
		<?endforeach;?>  
	</div>
	<?endif;?>
	
</div>

<?
if($arResult['PROPERTIES']['SERVICES']['VALUE']):
	?>
	<div class="services services_in detail_list">
		<h2><?=$arResult['PROPERTIES']['SERVICES']['NAME']?></h2>
		<div class="items clearfix">
			<?foreach ($arResult['PROPERTIES']['SERVICES']['VALUE'] as $key => $projectID) 
			{
				$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "IBLOCK_SECTION_ID", "DETAIL_PAGE_URL",  "PROPERTY_*");
				$arFilter = Array( "IBLOCK_ID"=>CIBlockElement::GetIBlockByID($projectID), "ID"=> $projectID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
				while($ob = $res->GetNextElement())
				{
					$arFields = $ob->GetFields();
					$arProps = $ob->GetProperties();
				}
				?>
				<div class="item"  >
					<a href="<?=$arFields['DETAIL_PAGE_URL']?>"><div class="pic" style="background-image: url(<?=CFile::GetPath($arFields['PREVIEW_PICTURE'])?>);"></div></a>
					<div class="description">
						<a href="<?=$arFields['DETAIL_PAGE_URL']?>"><span class="name"><?=$arFields['NAME']?></span></a>
						<p><?=$arFields['PREVIEW_TEXT']?></p>
					</div>       
				</div>
				<?
			}
			?>
		</div>
	</div>
	<?
endif;
?>

<?
if($arResult['PROPERTIES']['LINK_ELEMENT']['VALUE']):
	?>
	<div class="picking">
		<span class="title_block"><?=$arResult['PROPERTIES']['LINK_ELEMENT']['NAME']?></span>
		<div class="catalog_items slider_catalog">
			<?foreach ($arResult['PROPERTIES']['LINK_ELEMENT']['VALUE'] as $key => $projectID) 
			{
				$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "IBLOCK_SECTION_ID", "DETAIL_PAGE_URL",  "PROPERTY_*");
				$arFilter = Array( "IBLOCK_ID"=>CIBlockElement::GetIBlockByID($projectID), "ID"=> $projectID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
				while($ob = $res->GetNextElement())
				{
					$arFields = $ob->GetFields();
					$arProps = $ob->GetProperties();
				}
				?>
				<div class="item">
					<div>                                    
						<div class="pic">   
							<a href="<?=$arFields['DETAIL_PAGE_URL']?>"><img src="<?=CFile::GetPath($arFields['PREVIEW_PICTURE'])?>" alt="<?=$arFields['NAME']?>"/></a>
						</div>
						<div class="description">
							<span class="name"><a href="<?=$arFields['DETAIL_PAGE_URL']?>"><?=$arFields['NAME']?></a></span>
							<span class="availability <?=$arProps['STATUS']['VALUE_XML_ID']?>"><?=$arProps['STATUS']['VALUE']?></span>
							<?if($arProps['PRICE']['VALUE']):?>
							<span class="price"><?=number_format($arProps['PRICE']['VALUE'], 0, ',', ' ');?> <?=CIncorp2::getCurrency();?>
							<?if($arProps['OLD_PRICE']['VALUE']):?><span class="old_price"><?=number_format($arProps['OLD_PRICE']['VALUE'], 0, ',', ' ');?> <?=CIncorp2::getCurrency();?></span><?endif;?>
						</span>
						<?endif;?>
					</div>
				</div>
			</div>
			<?
		}
		?>
	</div>
</div>
<?
endif;
?>