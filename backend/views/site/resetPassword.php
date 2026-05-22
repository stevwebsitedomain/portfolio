<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Reset password';
?>
<div class="container py-5" style="max-width: 420px;">
    <h1 class="h4 mb-3"><?= Html::encode($this->title) ?></h1>
    <p class="text-muted small mb-4">LEGIT BUSINESS CONSULT LTD</p>

    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'placeholder' => 'New password']) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save password', ['class' => 'btn btn-primary w-100']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
