<?php

/**
 * Created by PhpStorm.
 * User: artemshmanovsky
 * Date: 12.03.15
 * Time: 20:12
 */
if (!$multiLanguage) {
    echo $form->field($model, 'title')->textInput(['maxlength' => 255]);
    echo $form->field($model, 'keywords')->textInput(['maxlength' => 255]);
    echo $form->field($model, 'description')->textArea();
} else {
    echo $form->field($model, 'title')->textInput(['maxlength' => 255])->widget(\webvimark\behaviors\multilanguage\input_widget\MultiLanguageActiveField::className());
    echo $form->field($model, 'keywords')->textInput(['maxlength' => 255])->widget(\webvimark\behaviors\multilanguage\input_widget\MultiLanguageActiveField::className());
    echo $form->field($model, 'description')->textArea()->widget(\webvimark\behaviors\multilanguage\input_widget\MultiLanguageActiveField::className(), ['inputType' => 'textArea']);
}