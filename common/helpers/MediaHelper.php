<?php

namespace common\helpers;

use Yii;
use yii\imagine\Image;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\HttpException;
use common\models\base\Media;

/**
 * Media Helper 
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 */
class MediaHelper {

    /**
     * Get Img Url
     * @author Ahmed Sharaf <sharaf.developer@gmail.com>
     * @param obj $oMedia of Media Model
     * @param string $size 'Optional' size from image config sizes ex: 'thumb'
     * @param bool|string $placeholder 'Optional' placeholder from image config whether to return placeholder img ro no ex: 'default'
     * @param bool $overwrite 'Optional' whether to overwite exists img or no.
     * @return string of img url :
     * if the img dosen't exists => return a place holder img url
     * if the img size dosen't exists => generate the img size and return url 
     */
    public static function getImgUrl($oMedia, $size = null, $placeholder = true, $overwrite = false) {
        $imgConfig = require(__DIR__ . '/../config/image.php');

        if (!($oMedia && is_file($oMedia->getFilePath()) && exif_imagetype($oMedia->getFilePath())) && $placeholder) {
            ($placeholder === true || !array_key_exists($placeholder, $imgConfig['placeholders'])) and $placeholder = 'default';
            $oMedia = new Media($imgConfig['placeholders'][$placeholder]);
        }

        if ($size && array_key_exists($size, $imgConfig['sizes']) && (!is_file($oMedia->getFilePath($size)) || $overwrite))
            static::generateImgSizes($oMedia->getFilePath(), $size);

        return $oMedia->getFileUrl($size);
    }

    public static function getPlaceholderUrl($size = null, $placeholder = true, $overwrite = false) {
        return self::getImgUrl(null, $size, $placeholder, $overwrite);
    }

    /**
     * Generate img sizes using yii\imagine\Image.
     * @author Ahmed Sharaf <sharaf.developer@gmail.com>
     * @param string $imgPath root path like: /var/www/app/images/img.jpg
     * @param string|array $sizes from /common/config/image.php ex: 'thumb' | ['thumb', 'large']
     */
    public static function generateImgSizes($imgPath, $sizes) {
        $pathInfo = pathinfo($imgPath);
        if (!is_file($imgPath) || !exif_imagetype($imgPath) || empty($sizes))
            throw new HttpException(400, Yii::t('app', 'invalid data'));

        $imgConfig = require(__DIR__ . '/../config/image.php');
        !is_array($sizes) and $sizes = [$sizes];
        $sizes = array_intersect_key($imgConfig['sizes'], array_flip($sizes));
        foreach ($sizes as $size => $action) {
            $oImage = new Image();
            $func = $action[0]; //callback function
            $action[0] = $imgPath;
            $sizePath = $pathInfo['dirname'] . '/' . $size;
            FileHelper::createDirectory($sizePath);
            call_user_func_array(array($oImage, $func), $action)->save($sizePath . '/' . $pathInfo['basename']);
        }
    }

    /**
     * Delete files in given path (and subdirs)
     * @author Ahmed Sharaf <sharaf.developer@gmail.com>
     * @param string|array $path 'Requeried' Path to the files to delete or array ex: array(array($path, $match, $recursive), ...) (when array other params are ignored) 
     * @param string $match Filename to delete all (use * as wildcard)
     * @param boolean $recursive Delete matching files in subdirs
     * @return integer Returns how many files that were deleted
     */
    public static function deleteFiles($path, $match = null, $recursive = false) {
        static $deleted = 0;
        $deleteFiles = is_array($path) ? $path : array(array($path, $match, $recursive));
        foreach ($deleteFiles as $deleteFile) {
            list($path, $match, $recursive) = $deleteFile;
            // make sure we have a valid path
            $fullPath = rtrim($path, '/') . '/';
            $files = glob($fullPath . $match, GLOB_NOSORT);
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                    $deleted++;
                }
            }
            if ($recursive) {
                $dirs = glob($fullPath . "*", GLOB_NOSORT);  // GLOB_NOSORT to make it quicker
                foreach ($dirs as $dir) {
                    if (is_dir($dir)) {
                        $dir = basename($dir) . DIRECTORY_SEPARATOR;
                        static::deleteFiles($path . $dir, $match, false);
                    }
                }
            }
        }
        return $deleted;
    }

    public static function gridDisplay($oMedia) {
        if (strpos($oMedia->mime, 'image') !== false)
            return static::imgLink($oMedia, 'micro', ['class' => 'colorboxImg', 'data-pjax' => '0']);
        elseif (strpos($oMedia->mime, 'audio') !== false)
            return static::audio($oMedia, ['width' => 300]);
        elseif (strpos($oMedia->mime, 'video') !== false)
            return static::video($oMedia, ['width' => 300]);
        else
            return Html::a($oMedia->filename, $oMedia->getFileUrl(), ['target' => 'blanck', 'data-pjax' => '0']);
    }

    public static function imgLink($oMedia, $size = 'micro', $options = []) {
        return Html::a(static::img($oMedia, $size), $oMedia->getFileUrl(), $options);
    }

    public static function img($oMedia, $size = 'micro', $options = []) {
        return Html::img($oMedia->getImgUrl($size), $options);
    }

    public static function audio($oMedia, $options = []) {
        $options['controls'] = true;
        $sourceOption = ['src' => $oMedia->getFileUrl(), 'type' => $oMedia->mime];
        $sourceTag = Html::tag('source', null, $sourceOption);
        $content = $sourceTag . yii::t('app', 'Your browser does not support HTML5 audio');
        return Html::tag('audio', $content, $options);
    }

    public static function video($oMedia, $options = []) {
        $options['controls'] = true;
        $sourceOption = ['src' => $oMedia->getFileUrl(), 'type' => $oMedia->mime];
        $sourceTag = Html::tag('source', null, $sourceOption);
        $content = $sourceTag . yii::t('app', 'Your browser does not support HTML5 video');
        return Html::tag('video', $content, $options);
    }
    
    /**
     * Upload file from $_FILES
     * @param obj $oMedia
     * @return boolean
     */
    public static function fileUpload($oMedia) {
        
        $oMedia->filename = Yii::$app->security->generateRandomString(16) . '.' . ($oMedia->uploadedFile->type == 'application/pdf')? 'pdf' : $oMedia->uploadedFile->extension;
        $path = static::createUploadDir();
        $oMedia->path = substr($path, strlen(Yii::getAlias('@root'))) . '/';
        $oMedia->size = $oMedia->uploadedFile->size;
        $oMedia->mime = $oMedia->uploadedFile->type;
        
        return $oMedia->validate() && $oMedia->uploadedFile->saveAs($path . DIRECTORY_SEPARATOR . $oMedia->filename) &&  $oMedia->save(false);
        
    }

    /**
     * Uplad file from url and save data
     * @param obj $oMedia
     * @param string $url
     * @param string $extension 
     * @return boolean
     */
    public static function urlUpload($oMedia, $url, $extension = null) {

        if (!$extension) {
            $info = pathinfo($url);
            $extension = reset(explode('?', $info['extension']));
        }

        $oMedia->filename = Yii::$app->security->generateRandomString(16) . '.' . $extension;
        $path = static::createUploadDir();
        $oMedia->path = substr($path, strlen(Yii::getAlias('@root'))) . '/';

        file_put_contents($path . DIRECTORY_SEPARATOR . $oMedia->filename, file_get_contents($url));

        $oMedia->size = filesize($path . DIRECTORY_SEPARATOR . $oMedia->filename);
        $oMedia->mime = mime_content_type($path . DIRECTORY_SEPARATOR . $oMedia->filename);

        return $oMedia->save();
    }

    /**
     * Creates uoload dir
     * @param string $path
     * @return int $path
     */
    public static function createUploadDir($path = null) {
        $path or $path = Yii::getAlias('@uploadPath') . '/' . date('Y/m/d');
        if (!is_dir($path)) {
            mkdir($path, 0775, true);
            chmod($path, 0775);
        } elseif (!is_writable($path)) {
            chmod($path, 0775);
        }
        return $path;
    }

}
