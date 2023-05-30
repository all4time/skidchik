 <?if(($isMenu) && (!$is404) && (!$isIndex)):?>
			<?if($isCompany):?>
			</div> <?// about_company ?>
			<?endif;?>
			</div> <?// main_block ?>
			<?endif;?>
			<?if((!$isIndex) && (!$is404)):?>
			</div> <?// inner work clearfix?>
			</div><?// content?>
			<?endif;?>

			<?if($isContacts):?>
			<style>
				.content .inner {
					padding-bottom: 50px;
				}
			</style>
			<div class="map_main map_contacts">
				<?if($arThemeValues['GOOGLE_MAPS'] == "Y"):?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:map.google.view", 
						".default", 
						array(
							"API_KEY" => "",
							"CONTROLS" => array(
								0 => "SMALL_ZOOM_CONTROL",
								1 => "TYPECONTROL",
								2 => "SCALELINE",
							),
							"INIT_MAP_TYPE" => "ROADMAP",
							"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:55.756194712815315;s:10:\"google_lon\";d:37.59444286116094;s:12:\"google_scale\";i:13;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:25:\"Tut!###RN###\";s:3:\"LON\";d:37.592618959030816;s:3:\"LAT\";d:55.75534344663125;}}}",
							"MAP_HEIGHT" => "500",
							"MAP_ID" => "MAPS",
							"MAP_WIDTH" => "100%",
							"OPTIONS" => array(
								0 => "ENABLE_DBLCLICK_ZOOM",
								1 => "ENABLE_DRAGGING",
								2 => "ENABLE_KEYBOARD",
							),
							"COMPONENT_TEMPLATE" => ".default"
						),
						false
					);?>
				<?else:?>        
				<?$APPLICATION->IncludeComponent(
					"bitrix:map.yandex.view", 
					".default", 
					array(
						"CONTROLS" => array(
							0 => "ZOOM",
							1 => "MINIMAP",
							2 => "TYPECONTROL",
							3 => "SCALELINE",
						),
						"INIT_MAP_TYPE" => "MAP",
						"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.74227149199072;s:10:\"yandex_lon\";d:37.58186296065696;s:12:\"yandex_scale\";i:11;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.5964962711639;s:3:\"LAT\";d:55.73820639728646;s:4:\"TEXT\";s:17:\"Tut!\";}}}",
						"MAP_HEIGHT" => "500",
						"MAP_ID" => "",
						"MAP_WIDTH" => "100%",
						"OPTIONS" => array(
							0 => "ENABLE_DBLCLICK_ZOOM",
							1 => "ENABLE_DRAGGING",
						),
						"COMPONENT_TEMPLATE" => ".default",
						"API_KEY" => ""
					),
					false
				);?>
				<?endif;?>
			</div>
			<?endif;?>
			<div class="footer  footer_type_<?=$arThemeValues['FOOTER_TYPE']?>">
				<div class="inner work clearfix">
					<div class="clearfix">
						<div class="left clearfix">
							<div class="links">
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu", 
									"footer", 
									array(
										"ALLOW_MULTI_SELECT" => "N",
										"CHILD_MENU_TYPE" => "left",
										"DELAY" => "N",
										"MAX_LEVEL" => "2",
										"MENU_CACHE_GET_VARS" => array(
										),
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_TYPE" => "N",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"ROOT_MENU_TYPE" => "bottom",
										"USE_EXT" => "Y",
										"COMPONENT_TEMPLATE" => "footer"
									),
									false
								);?>
							</div>
							<div class="links">
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu", 
									"footer", 
									array(
										"ALLOW_MULTI_SELECT" => "N",
										"CHILD_MENU_TYPE" => "left",
										"DELAY" => "N",
										"MAX_LEVEL" => "2",
										"MENU_CACHE_GET_VARS" => array(
										),
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_TYPE" => "N",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"ROOT_MENU_TYPE" => "bottom2",
										"USE_EXT" => "Y",
										"COMPONENT_TEMPLATE" => "footer"
									),
									false
								);?>
							</div>
							<div class="links">
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu", 
									"footer", 
									array(
										"ALLOW_MULTI_SELECT" => "N",
										"CHILD_MENU_TYPE" => "left",
										"DELAY" => "N",
										"MAX_LEVEL" => "2",
										"MENU_CACHE_GET_VARS" => array(
										),
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_TYPE" => "N",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"ROOT_MENU_TYPE" => "bottom3",
										"USE_EXT" => "Y",
										"COMPONENT_TEMPLATE" => "footer"
									),
									false
								);?>
							</div>
						</div>
						<div class="right">
							<div class="phone">
								<?
								$APPLICATION->IncludeFile(SITE_DIR."include/site-phone.php", array(), array(
									"MODE" => "php",
									"NAME" => "Phone",
								)
							);
							?>
						</div>
						<div class="place">
							<span><?
							$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-address.php", array(), array(
								"MODE" => "html",
								"NAME" => "Adress",
							)
						);
						?></span>
					</div>
					<div class="mail">
						<span><?
						$APPLICATION->IncludeFile(SITE_DIR."include/site-email.php", array(), array(
							"MODE" => "php",
							"NAME" => "Phone",
						)
					);
					?></span>
				</div>

			</div>
		</div>
		<div class="bottom">
			<div class="copyright">
				<?
				$APPLICATION->IncludeFile(SITE_DIR."include/site-name.php", array(), array(
					"MODE" => "php",
					"NAME" => "Phone",
				)
			);
			?>
		</div>
		<?$APPLICATION->IncludeComponent(
	"vebfabrika:social.incorp2", 
	".default", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_NOTES" => "",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
		?>
	</div>
</div>
</div>
<?if(!$arTheme['SCROLLTOTOP_TYPE']['LIST']['NONE']['CURRENT']):?>
<button type="button" class="crp-button-up <?=($arTheme["SCROLLTOTOP_POSITION"]["LIST"]["LEFT"]["CURRENT"] == "Y" ? 'left' : 'right')?> <?if($arTheme['SCROLLTOTOP_COLOR']['VALUE'] == "Y"):?>color<?endif;?> <?=($arTheme['SCROLLTOTOP_TYPE']['LIST']['ROUND']['CURRENT'] == "Y" ? 'round' : 'rect')?>" style="display: none;">
	<i class="fa fa-angle-up"></i>
</button>
<?endif;?>
<div class="counter">
    <?$APPLICATION->IncludeFile(SITE_DIR."include/invis-counter.php", Array(), Array(
        "MODE" => "text",
        "NAME" => "Counters place for Yandex.Metrika, Google.Analytics",
    )
);?>
</div>
</body>
</html>