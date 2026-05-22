<?php

declare(strict_types=1);

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$baseUrl = rtrim((string) (Yii::$app->params['appUrl'] ?? ''), '/');
if ($baseUrl === '') {
    $baseUrl = rtrim(Yii::$app->request->hostInfo . Yii::$app->request->baseUrl, '/');
    $baseUrl = preg_replace('#/index\.php$#i', '', $baseUrl);
}
$resetLink = $baseUrl . '/site/reset-password?token=' . urlencode((string) $user->password_reset_token);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Follow the link below to reset your password:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
