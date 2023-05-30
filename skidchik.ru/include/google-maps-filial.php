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
			"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:55.756194712815315;s:10:\"google_lon\";d:37.59444286116094;s:12:\"google_scale\";i:13;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:25:\"Мы находимся тут!###RN###\";s:3:\"LON\";d:37.592618959030816;s:3:\"LAT\";d:55.75534344663125;}}}",
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