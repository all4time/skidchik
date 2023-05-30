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

if($arParams["SHOW_CHAIN"] != "N" && !empty($arResult["TAGS_CHAIN"])):
?>
<noindex>
	<ul class="reference"><?
		foreach ($arResult["TAGS_CHAIN"] as $tags):
			?>

<li><a href="<?=$tags["TAG_PATH"]?>"><?=$tags["TAG_NAME"]?></a></li>
  <?
		endforeach;?>
	</ul>
</noindex>
<?
endif;

if(is_array($arResult["SEARCH"]) && !empty($arResult["SEARCH"])):
?>
<noindex>
	<ul class="reference"><?
		foreach ($arResult["SEARCH"] as $key => $res)
		{
		?><li><a href="<?=$res["URL"]?>" rel="nofollow"><?=$res["NAME"]?></a></li> <?
		}
	?></ul>
</noindex>
<?
endif;
?>