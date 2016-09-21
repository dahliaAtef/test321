<?php

namespace digi\web;

/**
 * View represents a view object in the MVC pattern.
 *
 * View provides a set of methods (e.g. [[render()]]) for rendering purpose.
 *
 * View is configured as an application component in [[\yii\base\Application]] by default.
 * You can access that instance via `Yii::$app->view`.
 *
 * You can modify its configuration by adding an array to your application config under `components`
 * as it is shown in the following example:
 *
 * ~~~
 * 'view' => [
 *     'theme' => 'app\themes\MyTheme',
 *     'renderers' => [
 *         // you may add Smarty or Twig renderer here
 *     ]
 *     // ...
 * ]
 * ~~~
 *
 * @property \yii\web\AssetManager $assetManager The asset manager. Defaults to the "assetManager" application
 * component.
 * 
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 * @copyright Copyright (c) 2015 Digitree
 */
class View extends \yii\web\View {

    /**
     * @inheritdoc
     * Overwite the function to find the view file in the $context->baseViewPath if the child class doesn't has its own one.
     */
    public function render($view, $params = [], $context = null) {
        if (isset($context->baseViewPath) || isset($this->context->baseViewPath)) {
            (!$context && isset($this->context)) and $context = $this->context;
            $viewFile = $this->findViewFile($view, $context);
            if ($this->theme !== null) {
                $viewFile = $this->theme->applyTo($viewFile);
            }
            !is_file($viewFile) and $viewFile = $this->findViewFile($context->baseViewPath . DIRECTORY_SEPARATOR . $view, $context);
            return $this->renderFile($viewFile, $params, $context);
        }
        $viewFile = $this->findViewFile($view, $context);
        return $this->renderFile($viewFile, $params, $context);
    }

    /**
     * @inheritdoc
     * Overwite the function to make it public
     */
    public function findViewFile($view, $context = null) {
        return parent::findViewFile($view, $context);
    }

}
