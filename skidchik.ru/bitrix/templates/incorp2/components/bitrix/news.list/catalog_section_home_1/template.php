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
<div class="catalog_list">
  <div class="inner work clearfix">
    <div class="clearfix">
      <?if($arParams['TITLE']):?><h2 class="title_block"><?=$arParams['TITLE']?></h2><?endif;?>
      <?if($arParams['ALL_LINK']):?><a class="more" href="<?=$arParams['ALL_LINK']?>"><span><?=$arParams['LINK_NAME']?></span></a><?endif;?>
    </div>
    <div class="items clearfix">
      <?foreach($arResult['SECTIONS'] as $arItem):?>
      <?
        // edit/add/delete buttons for edit mode
      $arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
      $this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
      $this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        // preview picture
      if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
        $bImage = strlen($arItem['~PICTURE']);
        $arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 377, 'height' => 260), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
        $imageSectionSrc = ($bImage ? $arSectionImage['src'] : SITE_TEMPLATE_PATH.'/images/noimage_sections.png');
      }
      ?>
      <div class="item" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
        <div class="clearfix">
          <div class="left">
            <div class="pic">
              <div><a href="<?=$arItem['SECTION_PAGE_URL']?>"><img src="<?=SITE_TEMPLATE_PATH?>/img/loader_lazy.svg" data-src="<?=$arSectionImage['src']?>" class="b-lazy" alt="<?=$arItem['NAME']?>"/></a></div>
            </div>
          </div>
          <div class="right">
            <span class="title"><a href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a></span>
            <p>
              <?=$arItem['UF_SECTION_TEXT']?>                                   
            </p>
          </div>
        </div>
      </div>
      <?endforeach;?>
    </div>
  </div>
</div>
<?endif;?>