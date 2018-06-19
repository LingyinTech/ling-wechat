<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/28
 * Time: 22:25
 */

namespace common\controllers;


use common\base\Controller;
use common\components\ueditor\UEditorAction;

class UploadController extends Controller
{

    public function actions()
    {
        return [
            'upload' => [
                'class' => UEditorAction::class,
            ]
        ];
    }

    public function actionFormApi()
    {
        $result = app()->imageUpload->getBodySignature();
        return $this->format($result);
    }
}