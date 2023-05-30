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
global $arThemeValues;
?>
<?
if($arThemeValues['GOOGLE_MAPS'] == "N"):
	$APPLICATION->AddHeadString('<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>',true);
endif;
?>
<div class="offices">
	<div id="map" class="filial map">
	<?if($arThemeValues['GOOGLE_MAPS'] == "Y"):
		$APPLICATION->IncludeFile(SITE_DIR."include/google-maps-filial.php", array(), array(
			"MODE" => "html",
			"NAME" => "Google Maps",
			)
		);
		endif;?>
	</div>
	<div class="items clearfix">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="place">
				<span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
				<span class="name"><?=$arItem["NAME"]?></span>
				<p><?=$arItem["PROPERTIES"]["ADRESS"]["VALUE"]?></p>
			</div>

			<span class="time"><?=$arItem["PROPERTIES"]["WORKS"]["NAME"]?>:
				<span><?=$arItem["PROPERTIES"]["WORKS"]["VALUE"]?></span>
			</span>
			<span class="phone"><?=$arItem["PROPERTIES"]["TELEPHONE"]["VALUE"]?></span>
			<a href="mailto:<?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?>" class="mail"><?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?></a>
		</div>
		<?endforeach;?>
	</div>                                                                           
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<?
if($arThemeValues['GOOGLE_MAPS'] == "N"):
?>
<script>
	ymaps.ready(init);

	function init() {
		var myMap = new ymaps.Map("map", {
			center: [55.76, 37.64],
			zoom: 10,
			controls: ['zoomControl', 'typeSelector',  'fullscreenControl', 'routeButtonControl']
		}, {
			searchControlProvider: 'yandex#search'
		}),


		myGeoObject = new ymaps.GeoObject({
			geometry: {
				type: "Point",
				coordinates: [55.8, 37.8]
			},
		}, {
			draggable: false,
		}),
		myPieChart = new ymaps.Placemark([
			55.847, 37.6
			]);
		clusterer = new ymaps.Clusterer();
		<?foreach ($arResult["ITEMS"] as $arItem) {?>
			placemark = new ymaps.Placemark([<?=$arItem['PROPERTIES']['MAPS']['VALUE']?>]);
			clusterer.add(placemark);
		<? } ?>
		myMap.geoObjects
		<?foreach ($arResult["ITEMS"] as $arItem) {?>
			.add(new ymaps.Placemark([<?=$arItem['PROPERTIES']['MAPS']['VALUE']?>], {
				balloonContentBody: [
				'<strong><?=$arItem["NAME"]?></strong>',
				'<br/>',
				'<i><?=$arItem["PROPERTIES"]["ADRESS"]["NAME"]?>:</i> <?=$arItem["PROPERTIES"]["ADRESS"]["VALUE"]?>',
				'<br/>',
				'<i><?=$arItem["PROPERTIES"]["TELEPHONE"]["NAME"]?>:</i> <?=$arItem["PROPERTIES"]["TELEPHONE"]["VALUE"]?>',
				'<br/>',
				'<i><?=$arItem["PROPERTIES"]["WORKS"]["NAME"]?>:</i> <?=$arItem["PROPERTIES"]["WORKS"]["VALUE"]?>',
				].join('')

			}, {
				iconLayout: 'default#image',
                iconImageHref:"<?=SITE_TEMPLATE_PATH?>/img/ballun.png", //new ballun
                iconImageSize: [30, 42], // new size ballun
            }))
		<? } ?>
                myMap.setBounds(clusterer.getBounds()); // auto center
                myMap.setBounds(clusterer.getBounds(), { //auto zoom
                	checkZoomRange: true
                });
            }
        </script>
<?endif;?>