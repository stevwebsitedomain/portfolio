<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var common\models\User $user */

$baseUrl = rtrim((string) (Yii::$app->params['appUrl'] ?? ''), '/');
if ($baseUrl === '') {
    $baseUrl = rtrim(Yii::$app->request->hostInfo . Yii::$app->request->baseUrl, '/');
    $baseUrl = preg_replace('#/index\.php$#i', '', $baseUrl);
}
$resetLink = $baseUrl . '/site/reset-password?token=' . urlencode((string) $user->password_reset_token);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>

