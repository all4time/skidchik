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
<pre><?print_r($arParams)?></pre>
<div class="catalog-sb-area"><?
if ($arResult["FB_USE"])
{
	?> <div class="catalog-sb-item fb"><div id="fb-root"></div><script type="text/javascript">
		(function(d, s, id)
		{
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/<?=(strtolower(LANGUAGE_ID)."_".strtoupper(LANGUAGE_ID))?>/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script><div class="fb-like" data-href="<?=$arResult["URL_TO_LIKE"]?>" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false" style="float:left;"></div></div><?
}
if ($arResult["TW_USE"])
{
	?> <div class="catalog-sb-item tw"><a href="https://twitter.com/share" class="twitter-share-button" data-lang="<?= LANGUAGE_ID ?>" data-url="<?= $arResult["URL_TO_LIKE"] ?>"<?
	if ($arResult["TITLE"] != '')
		echo ' data-text="'.$arResult["TITLE"].'"';
	if ($arResult["TW_VIA"] != '')
		echo ' data-via="'.$arResult["TW_VIA"].'"';
	if ($arResult["TW_HASHTAGS"] != '')
		echo ' data-hashtags="'.$arResult["TW_HASHTAGS"].'"';
	if ($arResult["TW_RELATED"] != '')
		echo ' data-related="'.$arResult["TW_RELATED"].'"';
	?>><?= GetMessage("CATALOG_SB_TW_MAKE") ?></a>
	<script type="text/javascript">
		!function (d, s, id)
		{
			var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
			if (!d.getElementById(id))
			{
				js = d.createElement(s);
				js.id = id;
				js.src = p + '://platform.twitter.com/widgets.js';
				fjs.parentNode.insertBefore(js, fjs);
			}
		}(document, 'script', 'twitter-wjs');
	</script></div><?
}

if ($arResult["VK_USE"])
{
	$APPLICATION->AddHeadString('<script type="text/javascript" src="https://vk.com/js/api/share.js?93" charset="windows-1251"></script>');
	?> <div class="catalog-sb-item vk" id="vk-shared-button-<?$this->randString()?>"></div><script type="text/javascript">
	(function() {
		var div = document.getElementById("vk-shared-button-<?$this->randString()?>");
		var button = VK.Share.button({
				url: "<?=$arResult["URL_TO_LIKE"]?>"<?
				if(strlen($arResult["TITLE"]) > 0 )
					echo ','.PHP_EOL.'title: "'.$arResult["TITLE"].'"';

				if(strlen($arResult["IMAGE"]) > 0 )
					echo ','.PHP_EOL.'image: "'.$arResult["IMAGE"].'"';?>
			},
			{
				type: "round",
				text: "<?=GetMessage("CATALOG_SB_VK_SAVE")?>"
			});

		if (div)
		{
			div.innerHTML = button;
		}
		else if (document.addEventListener)
		{
			document.addEventListener("DOMContentLoaded", function() {
				div.innerHTML = button;
			});
		}
	})();
</script><?
}

if ($arResult["GP_USE"])
{
	?> <div class="catalog-sb-item gp"><div class="g-plusone" data-size="medium" data-href="<?= $arResult["URL_TO_LIKE"] ?>"></div><script type="text/javascript">
	window.___gcfg = {lang: '<?=$arResult["GP_LANG"]?>'};
	(function ()
	{
		var po = document.createElement('script');
		po.type = 'text/javascript';
		po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(po, s);
	})();
	</script></div><?
}

?></div>