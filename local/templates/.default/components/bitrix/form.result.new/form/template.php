<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arResult * */
/** @var array $arParams * */

$this->setFrameMode(true);
?>

<div class="contact-form">
    <?php
    if ($arResult["isFormNote"] === "Y" || (isset($_REQUEST["formresult"]) && $_REQUEST['formresult'] === 'addok')): ?>
        <div class="contact-form__head">
            <div class="contact-form__head-title">Спасибо!</div>
            <div class="contact-form__head-text">
                Ваша заявка успешно принята. Наши менеджеры свяжутся с вами в ближайшее время.
            </div>
        </div>
    <?php
    else: ?>

        <div class="contact-form__head">
            <div class="contact-form__head-title">Связаться</div>
            <div class="contact-form__head-text">Наши сотрудники помогут выполнить подбор услуги и&nbsp;расчет цены с&nbsp;учетом
                ваших требований
            </div>
        </div>

        <?php
        if ($arResult["isFormErrors"] == "Y"): ?>
            <div class="input__notification">
                <?= $arResult["FORM_ERRORS_TEXT"]; ?>
            </div>
        <?php
        endif; ?>

        <?= $arResult["FORM_HEADER"]; ?>
        <?= $arResult["HIDDEN"]; ?>

        <div class="contact-form_form-inputs">
            <?php
            foreach ($arResult["QUESTIONS"] as $FILED_SID => $arQuestion): ?>
                <?php
                $arAnswer = $arQuestion["STRUCTURE"][0];
                $fieldType = $arAnswer["FIELD_TYPE"];
                $answerID = $arAnswer["ID"];

                if ($fieldType === 'textarea') {
                    continue;
                }

                $fieldName = "form_" . $fieldType . "_" . $answerID;
                ?>

                <div class="input contact-form__input">
                    <label class="input__label">
                        <div class="input__label-text">
                            <?= $arQuestion["CAPTION"] ?> <?= ($arQuestion["REQUIRED"] == "Y" ? "*" : "") ?>
                        </div>
                        <input
                                class="input__input"
                                type="<?= ($fieldType === 'email' ? 'email' : 'text') ?>"
                                name="<?= $fieldName ?>"
                                value="<?= htmlspecialcharsbx($_REQUEST[$fieldName] ?? '') ?>"
                            <?= ($arQuestion["REQUIRED"] == "Y" ? "required" : "") ?>
                        >
                    </label>
                </div>
            <?php
            endforeach; ?>
        </div>
        <div class="contact-form__form-message">
            <?php
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
                <?php
                $arAnswer = $arQuestion["STRUCTURE"][0];
                if ($arAnswer["FIELD_TYPE"] === 'textarea'):
                    $fieldName = "form_textarea_" . $arAnswer["ID"];
                    ?>
                    <div class="input">
                        <label class="input__label">
                            <div class="input__label-text">
                                <?= $arQuestion["CAPTION"] ?><?= ($arQuestion["REQUIRED"] == "Y" ? "*" : "") ?>
                            </div>
                            <textarea class="input__input" name="<?= $fieldName ?>"><?= htmlspecialcharsbx(
                                    $_REQUEST[$fieldName] ?? ''
                                ) ?></textarea>
                        </label>
                    </div>
                <?php
                endif; ?>
            <?php
            endforeach; ?>
        </div>

        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">
                Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что ознакомлены, полностью согласны и&nbsp;принимаете
                условия &laquo;Согласия на&nbsp;обработку персональных данных&raquo;.
            </div>

            <button class="form-button contact-form__bottom-button" type="submit" name="web_form_submit" value="Y">
                <div class="form-button__title">Оставить заявку</div>
            </button>
        </div>

        <?= $arResult["FORM_FOOTER"] ?>

    <?php
    endif; ?>
</div>
