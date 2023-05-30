<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("404 Not Found");
?>
    <div class="content content_error">        
        <div class="inner work clearfix">
            <div class="error_404">
                <span>Ошибка  <span>404</span></span>
                <p>Страница не найдена. Неправильно набран<br> адрес или такой страницы не существует</p>
				<a href="<?=SITE_DIR?>" class="btn btn_main">На главную</a>
            </div>            
        </div>
    </div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>