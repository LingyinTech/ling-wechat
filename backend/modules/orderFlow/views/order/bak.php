<?php
use yii\helpers\Html;

if (class_exists('backend\assets\AppAsset')) {
    backend\assets\AppAsset::register($this);
}

dmstr\web\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <input type="text" value="" id="elementId" name="test">

    </div>

    <?php $this->endBody() ?>

    <script>
        $(document).keydown(function(event) {
            var keyCode = event.keyCode;
            if(keyCode == "13"){
                var value = $("#elementId").val();
                console.log(value);
                //$("#elementId").val('');
                $("#elementId").focus();
            }else{
                console.log(keyCode);
            }
        });
    </script>

    </body>
    </html>
<?php $this->endPage() ?>
