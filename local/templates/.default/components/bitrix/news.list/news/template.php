<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var array $arParams */

$this->setFrameMode(true);
\Bitrix\Main\Page\Asset::getInstance()->addCss($templateFolder . "/style.css");
if (empty($arResult['ITEMS'])): ?>
    <p>Новостей пока нет.</p>
    <?php return; endif; ?>

<div id="barba-wrapper">
    <?php foreach ($arResult['ITEMS'] as $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);

        $title = $arItem['NAME'] ?? '';
        $url = $arItem['DETAIL_PAGE_URL'] ?? '#';
        $text = $arItem['PREVIEW_TEXT'] ?? '';

        $img = '';
        if (!empty($arItem['PREVIEW_PICTURE']['SRC'])) {
            $img = $arItem['PREVIEW_PICTURE']['SRC'];
        } elseif (!empty($arItem['DETAIL_PICTURE']['SRC'])) {
            $img = $arItem['DETAIL_PICTURE']['SRC'];
        }
        ?>

<!--        <div class="article-item__wrapper" id="--><?php //= $this->GetEditAreaId($arItem['ID']); ?><!--">-->
<!--            --><?php //if ($img): ?>
<!--                <a class="article-item__background" href="--><?php //= htmlspecialcharsbx($url) ?><!--">-->
<!--                    <img src="--><?php //= htmlspecialcharsbx($img) ?><!--" alt="--><?php //= htmlspecialcharsbx($title) ?><!--" loading="lazy">-->
<!--                </a>-->
<!--            --><?php //endif; ?>
<!---->
<!--            <div class="article-item__content">-->
<!--                --><?php //if ($date): ?>
<!--                    <div class="news-card__date">--><?php //= htmlspecialcharsbx($date) ?><!--</div>-->
<!--                --><?php //endif; ?>
<!---->
<!--                <h3 class="news-card__title">-->
<!--                    <a href="--><?php //= htmlspecialcharsbx($url) ?><!--">--><?php //= htmlspecialcharsbx($title) ?><!--</a>-->
<!--                </h3>-->
<!---->
<!--                --><?php //if ($text): ?>
<!--                    <p class="news-card__text">--><?php //= htmlspecialcharsbx($text) ?><!--</p>-->
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--        </div>-->
        <div class="article-list">
            <a class="article-item article-list__item" href="<?= htmlspecialcharsbx($url) ?>"
                                     data-anim="anim-3">
                <?php if ($img): ?>

                    <div class="article-item__background"><img src="<?= htmlspecialcharsbx($img) ?>"
                                                               data-src="xxxHTMLLINKxxx0.39186223192351520.41491856731872767xxx"
                                                               alt=""/>
                    </div>
                <?php endif; ?>
                <div class="article-item__wrapper">
                    <div class="article-item__title"><?= htmlspecialcharsbx($title) ?></div>
                    <div class="article-item__content"><?= htmlspecialcharsbx($text) ?></div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
