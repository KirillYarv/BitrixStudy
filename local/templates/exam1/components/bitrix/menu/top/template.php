<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<nav class="nav">
	<div class="inner-wrap">
		<div class="menu-block popup-wrap">
			<a href="" class="btn-menu btn-toggle"></a>
			<div class="menu popup-block">
				<?if (!empty($arResult)):?>
				<ul id="">
					<li class="main-page"><a href="/"><?=Getmessage('MAIN')?></a>
				<?
				$previousLevel = 0;
				foreach($arResult as $arItem):?>

					<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
						<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
					<?endif?>

					<?if ($arItem["IS_PARENT"]):?>

						<?if ($arItem["DEPTH_LEVEL"] == 1):?>
							<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
								<ul>
								<?if ($arItem["PARAMS"]["TEXT"]) {?>
									<div class="menu-text"><?=$arItem["PARAMS"]["TEXT"]?></div>
								<?}?>
						<?else:?>
							<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
								<ul>
								<?if ($arItem["PARAMS"]["TEXT"]) {?>
									<div class="menu-text"><?=$arItem["PARAMS"]["TEXT"]?></div>
								<?}?>
						<?endif?>

					<?else:?>

						<?if ($arItem["PERMISSION"] > "D"):?>

							<?if ($arItem["DEPTH_LEVEL"] == 1):?>
								<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
							<?else:?>
								<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
							<?endif?>

						<?endif?>

					<?endif?>

					<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

				<?endforeach?>

				<?if ($previousLevel > 1)://close last item tags?>
					<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
				<?endif?>

				</ul>

				<?endif?>
				<a href="" class="btn-close"></a>
			</div>
			<div class="menu-overlay"></div>
		</div>
	</div>
</nav>