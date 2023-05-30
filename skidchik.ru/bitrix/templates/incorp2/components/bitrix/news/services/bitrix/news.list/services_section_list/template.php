<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?if($arResult['SECTIONS']):?>
<div class="services services_in">
    <div class="items clearfix">
        <?foreach($arResult['SECTIONS'] as $arItem):?>
        <?
                // edit/add/delete buttons for edit mode
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
         // preview picture
        $bImage = strlen($arItem['~PICTURE']);
        $arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 377, 'height' => 260), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
        $imageSectionSrc = ($bImage ? $arSectionImage['src'] : SITE_TEMPLATE_PATH.'/img/noimage_sections.jpg');
        
        ?>
        <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="pic" style="background-image: url(<?=$imageSectionSrc?>);"></div>
            <div class="description">
                <a href="<?=$arItem['SECTION_PAGE_URL']?>"><span class="name"><?=$arItem['NAME']?></span></a>
				<?if($arItem['UF_SECTION_TEXT']):?>
                	<p><?=$arItem['UF_SECTION_TEXT']?></p>
				<?endif;?>
				<?if($arItem['CHILD']):?>
                	<ul>
                 		<?foreach($arItem['CHILD'] as $arElement):?>
                		 	<li><a href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=$arElement['NAME']?></a></li>
                		 <?endforeach;?>
            		 </ul>
				<?endif;?>
             <div><a href="<?=$arItem['SECTION_PAGE_URL']?>" class="more"><span><?=GetMessage("BUTTON_LINK")?></span></a></div>
         </div>       
     </div>
     <?endforeach;?>          
 </div>
</div>  
<?endif;?>