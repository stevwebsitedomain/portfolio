<?php

declare(strict_types=1);

return [
    'container' => [
        'singletons' => [
            \yii\mail\MailerInterface::class => [
                'class' => \yii\symfonymailer\Mailer::class,
                'viewPath' => '@common/mail',
                'useFileTransport' => true,
            ],
        ],
    ],
    'components' => [
        'mailer' => \yii\mail\MailerInterface::class,
    ],
];
