<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
use Bitrix\Main\Application;
use Bitrix\Main\Diag;
?>

<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">

<head>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?
	$APPLICATION->ShowHead();
	
	//CSS
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.carousel.css");

	//JS
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/owl.carousel.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/scripts.js");
    ?>
    
    <link rel="icon" type="image/vnd.microsoft.icon" href="<?=SITE_TEMPLATE_PATH?>/img/favicon.ico">
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/img/favicon.ico">
</head>

<body id="body">
    <?$APPLICATION->ShowPanel();?>

	<?
	CJSCore::Init("date");
	CJSCore::Init("custom_main");

	$context = Application::getInstance()->getContext();
	$request = $context->getRequest();
	var_dump($request->getPost("myVar"));
	var_dump($request->getRequestMethod());
	echo "</br></br>";
	echo $request->isPost();
	echo "</br></br>";
	echo $request->get('clear_cache');
	echo "</br></br>";

	$router = Application::getInstance()->getRouter();
	$url = $router->route('news_by_id', ['newsId'=>1,'logout'=>'yes']);

	echo "</br>".$url."</br>";

	$message = "error!!!!!!!!! Caput {1}";
	$context = array("dadasd");

	$logger = new \Bitrix\Main\Diag\FileLogger("/var/log/php/error.log");
	$logger->setLevel(\Psr\Log\LogLevel::ERROR);
	// выведет в лог
	$logger->error($message, $context);
	// НЕ выведет в лог
	$logger->debug($message, $context);

	$rsUser = CUser::GetById(1);
	$arUser = $rsUser->Fetch();

	?>
	<pre> <?//var_dump($arUser);?></pre>
	<pre><?=$_GET['YEAR']?></pre>
	
	<script>
		
		//код исполняем, только когда DOM загружен 
		BX.ready(function(){ 
			
			var editButton = BX.findChild(//найти пасынков... 
				BX('task-view-buttons'),//...для родителя 
				{//с такими вот свойствами 
					tag: 'a', 
					className: 'task-view-button edit' 
				}, 
				true//поиск рекурсивно от родителя 
			); 
			
			if (editButton)  
			{ 
				var href = window.location.href, matches, taskId; 
				//узнаем id задачи из URL 
				if (matches = href.match(/\/task\/view\/([\d]+)\//i)) { 
					taskId = matches[1]; 
				}
			
				//создаем кнопку 
				var newButton = BX.create('a', { 
					attrs: { 
						href: href + (href.indexOf('?') === -1 ? '?' : '&') + 'task=' + taskId + '&' + 'pdf=1&sessid=' + BX.bitrix_sessid(), 
						className: 'task-view-button edit webform-small-button-link task-button-edit-link' 
					}, 
					text: 'Скачать как PDF' 
				}); 
				
				//вставляем кнопку 
				BX.insertAfter(newButton, parent); 
			} 
		});
		
		// //код исполняем, только когда DOM загружен 
		// BX.ready(function(){ 
		// 	let f = BX.create('span', {
		// 		style: {
		// 			"background": "red",
		// 		},
		// 		attrs: {
		// 			className: 'task-view-button'
		// 		},
		// 		dataset: {
		// 			aaa: 123
		// 		},
		// 		text: 'Завершить'
		// 	});

		// 	console.log(f);
		// 	let parent = document.getElementById('body');
		// 	console.log(parent);
		// 	parent.appendChild(f);
		// });

	</script>
	<form method="post" action="process.php">
      	<input type="text" name="myVar" id="myVar" />
      	<input type="submit" value="Отправить" />
    </form>
	<!-- <pre>
		<?//var_dump($request);?>
	</pre> -->

    <!-- wrap -->
    <div class="wrap">
        <!-- header -->
        <header class="header">
            <div class="inner-wrap">
                <div class="logo-block"><a href="/" class="logo">Мебельный магазин</a>
                </div>
                <div class="main-phone-block">

                <?
                $hour = date('H');
                if($hour >= 9 && $hour < 18){?>
                    <a href="tel:84952128506" class="phone">8 (495) 212-85-06</a>
                <?}else {?>
                    <a href="mailto:store@store.ru" class="phone">store@store.ru</a>
                <?}?>

                    <div class="shedule">время работы с 9-00 до 18-00</div>
                </div>
                <div class="actions-block">
                    <form action="/" class="main-frm-search">
                        <input type="text" placeholder="Поиск">
                        <button type="submit"></button>
                    </form>
                    <nav class="menu-block">
                        <ul>
                            <li class="att popup-wrap">
                                <a id="hd_singin_but_open" href="" class="btn-toggle">Войти на сайт</a>
                                <form action="/" class="frm-login popup-block">
                                    <div class="frm-title">Войти на сайт</div>
                                    <a href="" class="btn-close">Закрыть</a>
                                    <div class="frm-row"><input type="text" placeholder="Логин"></div>
                                    <div class="frm-row"><input type="password" placeholder="Пароль"></div>
                                    <div class="frm-row"><a href="" class="btn-forgot">Забыли пароль</a></div>
                                    <div class="frm-row">
                                        <div class="frm-chk">
                                            <input type="checkbox" id="login">
                                            <label for="login">Запомнить меня</label>
                                        </div>
                                    </div>
                                    <div class="frm-row"><input type="submit" value="Войти"></div>
                                </form>
                            </li>
                            <li><a href="">Зарегистрироваться</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!-- /header -->
        <!-- nav -->
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "top",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "COMPONENT_TEMPLATE" => "top",
                "DELAY" => "N",
                "MAX_LEVEL" => "3",
                "MENU_CACHE_GET_VARS" => array(),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "top",
                "USE_EXT" => "Y"
            )
        );?>
        <!-- /nav -->
        <!-- breadcrumbs -->
        <?if($APPLICATION->GetCurPage() != '/'){?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "bread",
            Array()
            );?>
        <?}?>
        <!-- /breadcrumbs -->
        <!-- page -->
        <div class="page">
            <!-- content box -->
            <div class="content-box">
                <!-- content -->
                <div class="content">
                    <div class="cnt">
                        <?if($APPLICATION->GetCurPage() != '/'){?>
                        <header>
                            <h1><?$APPLICATION->ShowTitle(false)?></h1>
                        </header>
                        <?}?>
                        <?if($APPLICATION->GetCurPage() == '/'){?>
                        
						<p>«Мебельная компания» осуществляет производство мебели на высококлассном оборудовании с применением минимальной доли ручного труда, что позволяет обеспечить высокое качество нашей продукции. Налажен производственный процесс как массового и индивидуального характера, что с одной стороны позволяет обеспечить постоянную номенклатуру изделий и индивидуальный подход – с другой.
						</p>
                    
                           
						<!-- index column -->
		                <div class="cnt-section index-column">
		                    <div class="col-wrap">
		
		                        <!-- main actions box -->
		                        <div class="column main-actions-box">
		                        	<div class="title-block">
		                                <h2>Новинки</h2>
		                                 <hr>
		                            </div>
		                              <div class="items-wrap">
		                                <div class="item-wrap">
		                                    <div class="item">
		                                        <div class="title-block att">
		                                            Угловой диван!
		                                        </div>
		                                        <br>
		                                        <div class="inner-block">
		                                            <a href="" class="photo-block">
		                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/new01.jpg" alt="">
		                                            </a>
		                                            <div class="text"><a href="">Угловой диван "Титаник",  с большим выбором расцветок и фактур.</a>
		                                            <a href="" class="btn-arr"></a>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="item-wrap">
		                                    <div class="item">
		                                        <div class="title-block att">
		                                            Угловой диван!
		                                        </div>
		                                        <br>
		                                        <div class="inner-block">
		                                            <a href="" class="photo-block">
		                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/new02.jpg" alt="">
		                                            </a>
		                                            <div class="text"><a href="">Угловой диван "Титаник",  с большим выбором расцветок и фактур.</a>
		                                            <a href="" class="btn-arr"></a>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="item-wrap">
		                                    <div class="item">
		                                        <div class="title-block att">
		                                            Угловой диван!
		                                        </div>
		                                        <br>
		                                        <div class="inner-block">
		                                            <a href="" class="photo-block">
		                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/new03.jpg" alt="">
		                                            </a>
		                                            <div class="text"><a href="">Угловой диван "Титаник",  с большим выбором расцветок и фактур.</a>
		                                            <a href="" class="btn-arr"></a>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <a href="" class="btn-next">Все новинки</a>
		                        </div>
		                        <!-- /main actions box -->
		                        <!-- main news box -->
		                        <div class="column main-news-box">
		                            <div class="title-block">
		                                <h2>Новости</h2>
		                            </div>
		                            <hr>
		                            <div class="items-wrap">
		                                <div class="item-wrap">
		                                    <div class="item">
		                                        <div class="title"><a href="">29 августа 2012</a>
		                                        </div>
		                                        <div class="text"><a href="">Поступление лучших офисных кресел из Германии </a>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="item-wrap">
		                                    <div class="item">
		                                        <div class="title"><a href="">29 августа 2012</a>
		                                        </div>
		                                        <div class="text"><a href="">Мастер-класс дизайнеров  из Италии для производителей мебели </a>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="item-wrap">
		                                    <div class="item">
		                                        <div class="title"><a href="">29 августа 2012</a>
		                                        </div>
		                                        <div class="text"><a href="">Поступление лучших офисных кресел из Германии </a>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="item-wrap">
		                                    <div class="item">
		                                        <div class="title"><a href="">29 августа 2012</a>
		                                        </div>
		                                        <div class="text"><a href="">Наша дилерская сеть расширилась теперь ассортимент наших товаров доступен в Казани </a>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <a href="" class="btn-next">Все новости</a>
		                        </div>
		                        <!-- /main news box -->
		
		                    </div>
		                </div>
		                <!-- /index column -->
		                
	                    <!-- afisha box -->
		                <div class="cnt-section afisha-box">
		                    <div class="section-title-block">
		                        <h2 class="second-ttile">Ближайшие мероприятия</h2>
		                        <a href="" class="btn-next">все мероприятия</a>
		                    </div>
		                    <hr>
		                    <div class="items-wrap">
		                        <div class="item-wrap">
		                            <div class="item">
		                                <div class="title"><a href="">29 августа 2012, Москва</a>
		                                </div>
		                                <div class="text"><a href="">Семинар производителей мебели России и СНГ, Обсуждение тенденций.</a>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="item-wrap">
		                            <div class="item">
		                                <div class="title"><a href="">29 августа 2012, Москва</a>
		                                </div>
		                                <div class="text"><a href="">Открытие шоу-рума на Невском проспекте. Последние модели в большом ассортименте.</a>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="item-wrap">
		                            <div class="item">
		                                <div class="title"><a href="">29 августа 2012, Москва</a>
		                                </div>
		                                <div class="text"><a href="">Открытие нового магазина в нашей  дилерской сети.</a>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <!-- /afisha box -->      
                        <?}?>
          