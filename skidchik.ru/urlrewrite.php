<?php
$arUrlRewrite=array (
  1 => 
  array (
    'CONDITION' => '#^={$arResult["FOLDER"].$arParams["FILTER_URL_TEMPLATE"]}\\??(.*)#',
    'RULE' => '&$1',
    'ID' => 'vebfabrika:catalog.filter.incorp2',
    'PATH' => '/bitrix/templates/incorp2/components/bitrix/news/catalog/section.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/company/partners/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/partners/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/info/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/news/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/info/sale/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/sale/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/services/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/projects/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/promo/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/promo/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/index.php',
    'SORT' => 100,
  ),
);
