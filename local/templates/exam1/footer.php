<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>

                    </div>
                </div>
                <!-- /content -->
                <!-- side -->
                <div class="side">
                    <!-- side menu -->
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu", 
                        "left", 
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "left",
                            "USE_EXT" => "Y",
                            "COMPONENT_TEMPLATE" => "left"
                        ),
                        false
                    );?>
                    <!-- /side menu -->
                    <div id="sidebar">
                        <div class="content-block">
                            <div class="content-block-inner">
                                <h3><?=GetMessage('CFT_LANG_CANGE')?></h3>
                                <?$APPLICATION->IncludeComponent(
	"bitrix:main.site.selector", 
	"ex2_dropdown", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"SITE_LIST" => array(
		),
		"COMPONENT_TEMPLATE" => "ex2_dropdown"
	),
	false
);?><br>
                            </div>
                        </div>
                    <!-- side anonse -->
                    <div class="side-block side-anonse">
                        <div class="title-block"><span class="i i-title01"></span>Полезная информация!</div>
                        <div class="item">
                            <p>Клиенты предпочитают все больше эко-материалов.</p>
                        </div>
                    </div>
                    <!-- /side anonse -->
                    <?php
                        $APPLICATION->ShowViewContent("min_max_price");
                    ?>
                    <!-- side wrap -->
                    <div class="side-wrap">
                        <div class="item-wrap">
                            <!-- side action -->
                            <div class="side-block side-action">
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/side-action-bg.jpg" alt="" class="bg">
                                <div class="photo-block">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/side-action.jpg" alt="">
                                </div>
                                <div class="text-block">
                                    <div class="title">Акция!</div>
                                    <p>Мебельная полка всего за 560 <span class="r">a</span>
                                    </p>
                                </div>
                                <a href="" class="btn-more">подробнее</a>
                            </div>
                            <!-- /side action -->
                        </div>
                        
                       <!-- footer rew slider box -->
                       <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list", 
                            "rew_left", 
                            array(
                                "ACTIVE_DATE_FORMAT" => "j M Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "/rew/#ELEMENT_CODE#/",
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "5",
                                "IBLOCK_TYPE" => "rew",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "2",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "150",
                                "PROPERTY_CODE" => array(
                                    0 => "POSITION",
                                    1 => "COMPANY",
                                    2 => "",
                                ),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "NAME",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "COMPONENT_TEMPLATE" => "rew_left"
                            ),
                            false
                        );?>
						<!-- / footer rew slider box --> 
                        
                    </div>
                    <!-- /side wrap -->
                </div>
                <!-- /side -->
            </div>
            <!-- /content box -->
        </div>
        <!-- /page -->
        <div class="empty"></div>
    </div>
    <!-- /wrap -->
    <!-- footer -->
    <footer class="footer">
        <div class="inner-wrap">
            <nav class="main-menu">
                <div class="item">
                    <div class="title-block">О магазине</div>
                    <ul>
                        <li><a href="">Отзывы</a>
                        </li>
                        <li><a href="">Руководство </a>
                        </li>
                        <li><a href="">История</a>
                        </li>
                    </ul>
                </div>
                <div class="item">
                    <div class="title-block">Каталог товаров</div>
                    <ul>
                        <li><a href="">Кухни</a>
                        </li>
                        <li><a href="">Гарнитуры</a>
                        </li>
                        <li><a href="">Спальни и матрасы</a>
                        </li>
                        <li><a href="">Столы и стулья</a>
                        </li>
                        <li><a href="">Раскладные диваны</a>
                        </li>
                        <li><a href="">Кресла</a>
                        </li>
                        <li><a href="">Кровати и кушетки</a>
                        </li>
                        <li><a href="">Тумобчки и прихожие</a>
                        </li>
                        <li><a href="">Аксессуары</a>
                        </li>
                        <li><a href="">Каталоги мебели</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="contacts-block">
                <div class="title-block"><?=GetMessage('CONTACT_INFO')?></div>
                <div class="loc-block">
                    <div class="address">ул. Летняя, стр.12, офис 512</div>
                    <div class="phone"><a href="tel:84952128506">8 (495) 212-85-06</a>
                    </div>
                </div>
                <div class="main-soc-block">
                    <a href="" class="soc-item">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/soc01.png" alt="">
                    </a>
                    <a href="" class="soc-item">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/soc02.png" alt="">
                    </a>
                    <a href="" class="soc-item">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/soc03.png" alt="">
                    </a>
                    <a href="" class="soc-item">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/soc04.png" alt="">
                    </a>
                </div>
                <div class="copy-block">© 2000 - 2012 "Мебельный магазин"</div>
            </div>
        </div>
    </footer>
    <!-- /footer -->
</body>

</html>