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
<?if($arResult["ITEMS"]):?>
<div class="slider">
  <ul class="bxslider">
    <?foreach($arResult["ITEMS"] as $arItem){?>
      <?
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
      ?>
      <li id="<?=$this->GetEditAreaId($arItem['ID']);?>"
        <?if($arItem['DETAIL_PICTURE']):?>
        style="background: url(<?=$arItem['DETAIL_PICTURE']['SRC']?>) center center no-repeat;"
        <?endif;?> >
        <div class="container">
          <div class="inner work clearfix">
            <div class="col <?=$arItem['PROPERTIES']['BANNERTYPE']['VALUE_XML_ID']?>">
              <span class="title_slider <?if ($arItem['PROPERTIES']['TEXTCOLOR']['VALUE_XML_ID'] == "white") echo "white";?>"><?=$arItem['NAME']?></span>
              <p <?if ($arItem['PROPERTIES']['TEXTCOLOR']['VALUE_XML_ID'] == "white") echo "class='white'";?>><?=$arItem['PREVIEW_TEXT']?></p>
              <div class="btn_list">
               <?if($arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']):?>
               <div>
                <a class="btn btn_main color" href="<?=$arItem['PROPERTIES']['BUTTON1LINK']['VALUE']?>"><?=$arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']?></a>
              </div>
              <?endif;?>
              <?if($arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']):?>
              <div>
                <?if($arItem['PROPERTIES']['FORMS']['VALUE']):?>
                <a class="btn btn_white" data-event="jqm" data-param-id="<?=$arItem['PROPERTIES']['FORMS']['VALUE']?>" data-name="question"><?=$arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']?></a> 
                <?else:?>
                <a class="btn btn_white" href="<?=$arItem['PROPERTIES']['BUTTON2LINK']['VALUE']?>"><?=$arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']?></a>
                <?endif;?>
              </div>
              <?endif;?>
            </div>
          </div>                        
        </div>
      </div>
    </li>
  <? } ?>
</ul>
</div>
<?endif;?>