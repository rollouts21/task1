<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var array $arParams */

$this->setFrameMode(true);
\Bitrix\Main\Page\Asset::getInstance()->addCss($templateFolder . "/style.css");
if (empty($arResult['ITEMS'])): ?>
    <p>Новостей пока нет.</p>
    <?php return; endif; ?>

<div class="news-cards">
    <?php foreach ($arResult['ITEMS'] as $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);

        $title = $arItem['NAME'] ?? '';
        $url   = $arItem['DETAIL_PAGE_URL'] ?? '#';
        $date  = $arItem['DISPLAY_ACTIVE_FROM'] ?? '';
        $text  = $arItem['PREVIEW_TEXT'] ?? '';

        $img = '';
        if (!empty($arItem['PREVIEW_PICTURE']['SRC'])) {
            $img = $arItem['PREVIEW_PICTURE']['SRC'];
        } elseif (!empty($arItem['DETAIL_PICTURE']['SRC'])) {
            $img = $arItem['DETAIL_PICTURE']['SRC'];
        }
        ?>

        <article class="news-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <?php if ($img): ?>
                <a class="news-card__media" href="<?= htmlspecialcharsbx($url) ?>">
                    <img src="<?= htmlspecialcharsbx($img) ?>" alt="<?= htmlspecialcharsbx($title) ?>" loading="lazy">
                </a>
            <?php endif; ?>

            <div class="news-card__body">
                <?php if ($date): ?>
                    <div class="news-card__date"><?= htmlspecialcharsbx($date) ?></div>
                <?php endif; ?>

                <h3 class="news-card__title">
                    <a href="<?= htmlspecialcharsbx($url) ?>"><?= htmlspecialcharsbx($title) ?></a>
                </h3>

                <?php if ($text): ?>
                    <p class="news-card__text"><?= htmlspecialcharsbx($text) ?></p>
                <?php endif; ?>
            </div>
        </article>
    <?php endforeach; ?>
</div>
