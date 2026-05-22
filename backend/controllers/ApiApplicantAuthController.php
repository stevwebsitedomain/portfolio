<?php

declare(strict_types=1);

namespace backend\controllers;

use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Public auth API (password reset) for portfolio backend on Render.
 *
 * POST /api/applicant/request-password-reset
 */
class ApiApplicantAuthController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $origins = Yii::$app->params['api.corsOrigins'] ?? ['*'];

        $behaviors = [
            'cors' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => $origins,
                    'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => false,
                    'Access-Control-Max-Age' => 86400,
                ],
            ],
        ] + $behaviors;

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['?', '@'],
                ],
            ],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'request-password-reset' => ['POST', 'OPTIONS'],
            ],
        ];

        return $behaviors;
    }

    /**
     * Request password reset link by email.
     */
    public function actionRequestPasswordReset(): array
    {
        $raw = Yii::$app->request->getRawBody();
        $data = json_decode($raw, true);
        $email = mb_strtolower(trim((string) ($data['email'] ?? '')));

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Yii::$app->response->statusCode = 422;

            return ['ok' => false, 'error' => 'Please enter a valid email address.'];
        }

        $user = User::find()->where(['email' => $email, 'status' => User::STATUS_ACTIVE])->one();
        if (!$user) {
            Yii::$app->response->statusCode = 404;

            return ['ok' => false, 'error' => 'User not found.'];
        }

        if (!User::isPasswordResetTokenValid((string) $user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save(false)) {
                Yii::$app->response->statusCode = 500;

                return ['ok' => false, 'error' => 'Could not prepare password reset link.'];
            }
        }

        $fromEmail = (string) (Yii::$app->params['senderEmail'] ?? Yii::$app->params['supportEmail'] ?? 'noreply@example.com');
        $fromName = (string) (Yii::$app->params['senderName'] ?? 'LEGIT BUSINESS CONSULT LTD');
        $appName = (string) (Yii::$app->name ?? $fromName);

        $sent = Yii::$app->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user],
            )
            ->setFrom([$fromEmail => $fromName])
            ->setTo($email)
            ->setSubject('Password reset for ' . $appName)
            ->send();

        if (!$sent) {
            Yii::$app->response->statusCode = 500;

            return ['ok' => false, 'error' => 'Could not send reset email right now.'];
        }

        return ['ok' => true, 'message' => 'Password reset link sent. Please check your email.'];
    }
}
