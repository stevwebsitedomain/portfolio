<?php

declare(strict_types=1);

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Contact form API — sends messages to portfolio inbox (Render backend).
 *
 * POST /api/contact
 */
class ApiContactController extends Controller
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
                'send' => ['POST', 'OPTIONS'],
            ],
        ];

        return $behaviors;
    }

    /**
     * Receive contact form JSON and email the portfolio owner.
     */
    public function actionSend(): array
    {
        $raw = Yii::$app->request->getRawBody();
        $data = json_decode($raw, true);

        $name = trim((string) ($data['name'] ?? ''));
        $email = mb_strtolower(trim((string) ($data['email'] ?? '')));
        $subject = trim((string) ($data['subject'] ?? ''));
        $message = trim((string) ($data['message'] ?? ''));

        if ($name === '' || $email === '' || $subject === '' || $message === '') {
            Yii::$app->response->statusCode = 422;

            return ['ok' => false, 'error' => 'Please fill in all fields.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Yii::$app->response->statusCode = 422;

            return ['ok' => false, 'error' => 'Please enter a valid email address.'];
        }

        if (mb_strlen($subject) > 200 || mb_strlen($message) > 5000) {
            Yii::$app->response->statusCode = 422;

            return ['ok' => false, 'error' => 'Message is too long.'];
        }

        $toEmail = (string) (Yii::$app->params['contactRecipientEmail']
            ?? Yii::$app->params['adminEmail']
            ?? 'developer.company2026@gmail.com');
        $fromEmail = (string) (Yii::$app->params['senderEmail'] ?? $toEmail);
        $fromName = (string) (Yii::$app->params['senderName'] ?? 'LEGIT BUSINESS CONSULT LTD');

        $textBody = "Portfolio contact form\n\n"
            . "Name: {$name}\n"
            . "Email: {$email}\n"
            . "Subject: {$subject}\n\n"
            . "Message:\n{$message}\n";

        $sent = Yii::$app->mailer
            ->compose()
            ->setTo($toEmail)
            ->setFrom([$fromEmail => $fromName])
            ->setReplyTo([$email => $name])
            ->setSubject('[Portfolio] ' . $subject)
            ->setTextBody($textBody)
            ->send();

        if (!$sent) {
            Yii::$app->response->statusCode = 500;

            return [
                'ok' => false,
                'error' => 'Could not send your message right now. Please try again later or email us directly.',
            ];
        }

        return [
            'ok' => true,
            'message' => 'Your message has been sent. Thank you!',
        ];
    }
}
