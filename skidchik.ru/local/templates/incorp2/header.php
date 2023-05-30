<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<? IncludeTemplateLangFile(__FILE__); ?>
<? if (!CModule::IncludeModule('vebfabrika.incorp2')) : ?>
	<div class='alert alert-warning'><?= GetMessage('NO_MODULE') ?></div>
	<style>
		.alert.alert-warning {
			margin-left: 25px;
			margin-top: 25px;
			border: 1px solid red;
			display: inline-block;
			padding: 20px;
			font-size: 19px;
		}
	</style>
	<? die(); ?>
<? endif; ?>
<? if (CModule::IncludeModule("vebfabrika.incorp2"))
	$arThemeValues = CIncorp2::GetFrontParametrsValues(SITE_ID);
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">

<head>
	<title><? $APPLICATION->ShowTitle() ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<? $APPLICATION->ShowHead() ?>
	<?
	//site info
	global $arSite;
	$arSite = CSite::GetByID(SITE_ID)->Fetch();
	//load message, js and css
	use Bitrix\Main\Page\Asset;
	//load ui
	\Bitrix\Main\UI\Extension::load("ui.icons");
	//BX.message
	Asset::getInstance()->addString("<script>BX.message(" . CUtil::PhpToJSObject($MESS, false, $location) . ")</script>");
	//css
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/owl.carousel.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/font-awesome.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.fancybox.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/fonts.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/reset.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/animate.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/basket.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/media.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");

	//js
	Asset::getInstance()->addString("<script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.fancybox.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.uniform.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/owl.carousel.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.bxslider.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jqModal.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/on-off-switch.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/spectrum.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.cookie.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.actual.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.flexslider.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.inputmask.bundle.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.validate.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/blazy.min.js");
	Asset::getInstance()->addJs("/bitrix/js/vebfabrika.incorp2/sort/Sortable.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/common.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
	?>
	<meta property="og:title" content="<? $APPLICATION->ShowTitle() ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?= (CMain::IsHTTPS() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ?><?= CIncorp2::ShowLogoOg(); ?>" />
	<link rel="image_src" href="<?= (CMain::IsHTTPS() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ?><?= CIncorp2::ShowLogoOg(); ?>" />
	<meta property="og:url" content="<?= (CMain::IsHTTPS() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ?><?= $APPLICATION->GetCurDir() ?>" />
	<meta property="og:description" content="<? $APPLICATION->ShowProperty("description") ?>" />
</head>

<body class="<?= (($arThemeValues['H1_STYLE'] == "1") ? "bold" : '') ?> sidebar_<?= strtolower($arThemeValues['SIDE_MENU']) ?> <?= (($arThemeValues['BUTTON_ANIMATE'] == "Y") ? "btnscale" : '') ?> <?= (($arThemeValues['BUTTON_RADIUS'] == "Y") ? "btnradius" : '') ?> mmenu_<?= strtolower($arThemeValues['MOBILE_MENU']) ?>">
	<? $APPLICATION->ShowPanel();
	global $arTheme, $isMenu, $isIndex, $is404, $isContacts, $isPrices;
	CIncorp2::SetJSOptions();
	$is404 = defined("ERROR_404") && ERROR_404 === "Y";
	$isMenu = ($APPLICATION->GetProperty('MENU') == "Y" ? true : false);
	$isIndex = CSite::inDir(SITE_DIR . 'index.php');
	$isContacts = CSite::inDir(SITE_DIR . 'contacts/');
	$isCompany = CSite::inDir(SITE_DIR . 'company/');
	$arTheme = $APPLICATION->IncludeComponent("vebfabrika:theme.incorp2", "", array(), false); ?>
	<!-- HEADER
    ================================= -->
	<div class="header <?= ($arThemeValues["HEADER_FIXED"] == "Y" ? ' fixed' : '') ?>">
		<div class="inner work clearfix">
			<div class="logo <?= ($arThemeValues["COLORED_LOGO"] == "Y" ? ' color_logo' : '') ?>">
				<?= CIncorp2::ShowLogo(); ?>
			</div>
			<div class="bottom clearfix <?= strtolower($arThemeValues['MENU_COLOR']) ?>">
				<div class="work">
					<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "top",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
					<? if ($arThemeValues['MOBILE_MENU'] == "TYPE_2") : ?>
						<div class="mobile_menu_container color">
							<div class="mobile_menu_content">
								<? $APPLICATION->IncludeComponent(
									"bitrix:menu",
									"mobile",
									array(
										"ALLOW_MULTI_SELECT" => "N",
										"CHILD_MENU_TYPE" => "left",
										"DELAY" => "N",
										"MAX_LEVEL" => "3",
										"MENU_CACHE_GET_VARS" => array(
											0 => "",
										),
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"ROOT_MENU_TYPE" => "top",
										"USE_EXT" => "Y",
									),
									false
								); ?>
							</div>
							<div class="item">
								<?
								$APPLICATION->IncludeFile(
									SITE_DIR . "include/site-phone.php",
									array(),
									array(
										"MODE" => "php",
										"NAME" => "Phone",
									)
								);
								?>
							</div>
							<div class="item">
								<?
								$APPLICATION->IncludeFile(
									SITE_DIR . "include/contacts-site-email.php",
									array(),
									array(
										"MODE" => "html",
										"NAME" => "Email",
									)
								);
								?>
								<div class="adress">
									<?
									$APPLICATION->IncludeFile(
										SITE_DIR . "include/contacts-site-address.php",
										array(),
										array(
											"MODE" => "html",
											"NAME" => "Adress",
										)
									);
									?>
								</div>
							</div>

						</div>
						<div class="mobile_menu_overlay"></div>
					<? endif; ?>
					<div class="bottom_right">
						<? $APPLICATION->IncludeComponent(
							"bitrix:search.title",
							"head",
							array(
								"CATEGORY_0" => array(
									0 => "iblock_vbf_incorp2_catalog",
									1 => "iblock_vbf_incorp2_content",
								),
								"CATEGORY_0_TITLE" => "",
								"CHECK_DATES" => "N",
								"CONTAINER_ID" => "title-search-1",
								"INPUT_ID" => "title-search-input-1",
								"NUM_CATEGORIES" => "1",
								"ORDER" => "rank",
								"PAGE" => "/search/index.php",
								"SHOW_INPUT" => "Y",
								"SHOW_OTHERS" => "N",
								"TOP_COUNT" => "5",
								"USE_LANGUAGE_GUESS" => "Y",
								"COMPONENT_TEMPLATE" => "head",
								"CATEGORY_0_iblock_vbf_stroy_catalog" => array(
									0 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_catalog"]["vbf_incorp2_catalog"][0],
									1 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_catalog"]["vbf_incorp2_services"][0],
								),
								"CATEGORY_0_iblock_vbf_stroy_content" => array(
									0 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_projects"][0],
									1 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_news"][0],
									2 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_sale"][0],
									3 => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_blog"][0],
								)
							),
							false
						); ?>

					</div>
				</div>
			</div>
			<div class="slogan">
				<span>
					<?
					$APPLICATION->IncludeFile(
						SITE_DIR . "include/site-name.php",
						array(),
						array(
							"MODE" => "php",
							"NAME" => "Site Name",
						)
					);
					?></span>
			</div>
			<div class="place">
				<span><?
						$APPLICATION->IncludeFile(
							SITE_DIR . "include/contacts-site-address.php",
							array(),
							array(
								"MODE" => "html",
								"NAME" => "Adress",
							)
						);
						?></span>
			</div>
			<div class="phone">
				<?
				$APPLICATION->IncludeFile(
					SITE_DIR . "include/site-phone.php",
					array(),
					array(
						"MODE" => "php",
						"NAME" => "Phone",
					)
				);
				?>
			</div>
			<?
			if ($arThemeValues['CALLBACK_BUTTON'] == "Y") :
			?>
				<div class="callback_container">
					<a class="btn btn_main callback" data-event="jqm" data-param-id="<?= CIncorp2::getFormID("vbf_incorp2_callback"); ?>" data-name="callback"><?= GetMessage('CALLBACK') ?></a>
				</div>
			<?
			endif;
			?>
		</div>
	</div>
	<? if ($isIndex) : ?>
		<? CIncorp2::ShowPageType('indexblocks'); ?>
	<? endif; ?>
	<? if ((!$isIndex) && (!$is404)) : ?>
		<div class="content">
			<div class="content_top">
				<div class="inner work">
					<? $APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"incorp2",
						array(
							"PATH" => "",
							"SITE_ID" => "s1",
							"START_FROM" => "0",
							"COMPONENT_TEMPLATE" => "incorp2"
						),
						false
					); ?>
					<? $APPLICATION->ShowViewContent('rss'); ?>
					<h1><? $APPLICATION->ShowTitle(false) ?></h1>
				</div>
			</div>
			<? $APPLICATION->ShowViewContent('show_banner'); ?>
			<div class="inner work clearfix">
				<? if ($isContacts) : ?>
					<? @include(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] . '/' . SITE_DIR . '/contacts/contacts.php')); ?>
					<?= $indexProlog; ?>
				<? endif; ?>
			<? endif; ?>
			<? if (($isMenu) && (!$is404) && (!$isIndex)) : ?>
				<div class="sidebar">
					<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "left",
		"VIEW_TITLE" => "Y",
		"TITLE" => "Меню раздела",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
					<? $APPLICATION->ShowViewContent('filter'); ?>
					<div class="banner">
						<?
						$APPLICATION->IncludeFile(
							SITE_DIR . "include/sidebar_banner.php",
							array(),
							array(
								"MODE" => "php",
								"NAME" => "Banner",
							)
						);
						?>
					</div>
					<? $APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"sidebar_news",
						array(
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"ADD_SECTIONS_CHAIN" => "N",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "N",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"DISPLAY_DATE" => "Y",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["vbf_incorp2_content"]["vbf_incorp2_news"][0],
							"IBLOCK_TYPE" => "vbf_incorp2_content",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"INCLUDE_SUBSECTIONS" => "Y",
							"NEWS_COUNT" => "6",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => ".default",
							"PREVIEW_TRUNCATE_LEN" => "",
							"SET_BROWSER_TITLE" => "N",
							"SET_LAST_MODIFIED" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_TITLE" => "N",
							"SORT_BY1" => "ACTIVE_FROM",
							"SORT_BY2" => "SORT",
							"SORT_ORDER1" => "DESC",
							"SORT_ORDER2" => "ASC",
							"STRICT_SECTION_CHECK" => "N",
							"COMPONENT_TEMPLATE" => "index_news"
						),
						false
					); ?>
				</div>
				<div class="main_block">
					<? if ($isCompany) : ?>
						<div class="about_company">
						<? endif; ?>
					<? endif; ?>