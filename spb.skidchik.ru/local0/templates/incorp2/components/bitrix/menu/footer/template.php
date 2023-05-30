<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<?
foreach($arResult as $arItem):
	?>
	<span class="sub"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></span>
	<?
	if($arItem["CHILD"]):
		?>
		<ul>
			<?
			foreach($arItem["CHILD"] as $arItemChild):
				?>
				<li><a href="<?=$arItemChild["LINK"]?>"><?=$arItemChild["TEXT"]?></a></li>
				<?
			endforeach;
			?>
		</ul>
		<?
	endif;
	?>
	<?
endforeach
?>
<?
endif;
?>