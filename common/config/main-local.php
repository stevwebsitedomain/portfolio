<?php

declare(strict_types=1);

return [
    'container' => [
        'singletons' => [
            \yii\mail\MailerInterface::class => [
                'class' => \yii\symfonymailer\Mailer::class,
                'viewPath' => '@common/mail',
                'useFileTransport' => getenv('MAILER_DSN') ? false : true,
                'transport' => getenv('MAILER_DSN')
                    ? ['dsn' => getenv('MAILER_DSN')]
                    : [],
            ],
        ],
    ],
    'components' => [
        'mailer' => \yii\mail\MailerInterface::class,
    ],
];
