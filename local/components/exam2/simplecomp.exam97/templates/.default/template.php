<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?=$USER->IsAuthorized()?>
<?php if($arResult["AUTH_USER"]) {?>
<!--    <p><b>--><?php //=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?><!--</b></p>-->

    <ul style='margin-left:30px; list-style-type: disc'>
        <?php foreach ($arResult["USERS"] as $user) {?>
            <li>
                [<?=$user["ID"]?>] - <?=$user["LOGIN"]?>
                <ul style='margin-left:60px; list-style-type: disc'>

                    <?php foreach ($user["NEWS"] as $news) {?>
                        <li>
                            - <?=$news["NAME"]?>
                        </li>
                    <?php }?>
                </ul>
            </li>
        <?php }?>
    </ul>
<?php } else {?>
    <p><?=GetMessage("ERROR_NON_AUTH")?></p>
<?php }?>
