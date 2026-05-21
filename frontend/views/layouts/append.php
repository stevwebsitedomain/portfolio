<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use yii\helpers\Url;

$web = Yii::getAlias('@web');
$bodyClass = $this->params['bodyClass'] ?? '';

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link href="<?= $web ?>/images/favicon.png" rel="icon" type="image/png">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="<?= $web ?>/template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $web ?>/template/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $web ?>/template/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= $web ?>/template/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= $web ?>/template/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= $web ?>/template/css/main.css" rel="stylesheet">
    <link href="<?= $web ?>/template/css/portfolio-custom.css" rel="stylesheet">

    <?php $this->head() ?>
</head>
<body class="<?= Html::encode($bodyClass) ?>">
<?php $this->beginBody() ?>

<?= $this->render('partials/_header') ?>

<?= $content ?>

<?= $this->render('partials/_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
