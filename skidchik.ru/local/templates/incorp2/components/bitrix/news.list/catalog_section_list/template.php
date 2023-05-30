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
<?if($arResult['SECTIONS']):?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="catalog_list catalog_list_in">  
<?
//printr($arResult['SECTIONS']);
$current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//printr($_SERVER['HTTP_HOST']);
//printr($_SERVER['REQUEST_SCHEME']);
//printr($arResult);


?>                                
    <div class="items clearfix">
        <?foreach($arResult['SECTIONS'] as $arItem):?>
        <?
                // edit/add/delete buttons for edit mode
        $arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
        $this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
        $this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                // preview picture
        $bImage = strlen($arItem['~PICTURE']);
        $arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 377, 'height' => 260), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
        $imageSectionSrc = ($bImage ? $arSectionImage['src'] : SITE_TEMPLATE_PATH.'/images/noimage_sections.png');
        ?>
		<?
		//printr($arItem);
		//if($arItem['NAME'] == 'Москва'):
		?>
        <div class="item" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
            <div class="clearfix">
                <div class="left">
                    <div class="pic">
                        <div><a href="<?=$arItem['SECTION_PAGE_URL']?>"><img src="<?=$imageSectionSrc?>" /></a></div>
                    </div>
                </div>
                <div class="right">
                    <span class="title"><a href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a></span>
                    <?if($arItem['CHILD']):?>
                    <ul>
                        <?foreach($arItem['CHILD'] as $arSubItem):?>
                        <li><a class="color_text" href="<?=($arSubItem['SECTION_PAGE_URL'] ? $arSubItem['SECTION_PAGE_URL'] : $arSubItem['DETAIL_PAGE_URL'] );?>"><?=$arSubItem['NAME']?></a></li>
                        <?endforeach;?>
                    </ul>
                    <?endif;?>                                 
                </div>
            </div>
        </div>
		<?//endif;?>
        <?endforeach;?>

    </div>                 
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?endif;?>