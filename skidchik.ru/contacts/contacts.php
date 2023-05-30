<div class="contacts_in">
	<div class="items clearfix">
		<div class="item icon_1">
			<span>Как добраться?</span>
			<p><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-address.php", array(), array(
				"MODE" => "html",
				"NAME" => "Adress",
			)
		);
		?></p>
	</div>
	<div class="item icon_2">
		<span>Email</span>
		<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-email.php", array(), array(
			"MODE" => "html",
			"NAME" => "Email",
		)
	);
	?>
</div>
<div class="item icon_3">
	<span>Как связаться?</span>
	<div class="phone"><?$APPLICATION->IncludeFile(SITE_DIR."include/site-phone.php", array(), array(
		"MODE" => "php",
		"NAME" => "Как связаться?",
	)
);
?>
</div>

</div>
<div class="item icon_4">
	<span>Режим работы</span>
	<p><?$APPLICATION->IncludeFile(SITE_DIR."include/site-schedule.php", array(), array(
		"MODE" => "php",
		"NAME" => "Режим работы",
	)
);
?></p>
</div>
</div>
</div>