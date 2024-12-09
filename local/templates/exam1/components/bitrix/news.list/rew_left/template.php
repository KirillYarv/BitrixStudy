<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="item-wrap">
	<div class="rew-footer-carousel">
	<?php foreach($arResult["ITEMS"] as $arItem):?>
		<?php
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="side-block side-opin">
				<div class="inner-block">	
					<div class="title">
						<div class="photo-block">
						<?php
							require_once('/home/bitrix/www/local/templates/exam1/components/bitrix/news.list/rew_left/include/resize_photo.php');

							$file_src = resize_photo($arItem["PREVIEW_PICTURE"]);
						?>

						<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
									
								border="0"
								src="<?=$file_src?>"
								
								alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
								title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
								/>
							</a>
						<?else:?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
								border="0"
								src="<?=SITE_TEMPLATE_PATH?>/img/no_photo_left_block.jpg"
								/>
							</a>
						<?endif;?>
						</div>
						<div class="name-block"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
							<?echo $arItem["NAME"]?></a>
						</div>
						<div class="pos-block">
							<?=$arItem["DISPLAY_PROPERTIES"]['POSITION']['DISPLAY_VALUE']?>, 
							"<?=$arItem["DISPLAY_PROPERTIES"]['COMPANY']['DISPLAY_VALUE']?>"
						</div>
					</div>
					<div class="text-block">
						<?echo $arItem["PREVIEW_TEXT"];?>
					</div>

				</div>
			</div>
		</div>
	<?endforeach;?>
	</div>
</div>
