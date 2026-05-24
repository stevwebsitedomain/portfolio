<?php

declare(strict_types=1);

use Portfolio\Api\Env;

/**
 * Backend config — set these on Render (Environment Variables).
 */
return [
    'senderEmail' => Env::get('SENDER_EMAIL', 'developer.company2026@gmail.com'),
    'senderName' => Env::get('SENDER_NAME', 'LEGIT BUSINESS CONSULT LTD'),
    'contactRecipientEmail' => Env::get('CONTACT_EMAIL', 'developer.company2026@gmail.com'),
    'mailerDsn' => Env::get('MAILER_DSN'),
    'mailTransport' => Env::get('MAIL_TRANSPORT'),
    'brevoApiKey' => Env::get('BREVO_API_KEY'),
    'resendApiKey' => Env::get('RESEND_API_KEY'),
    'smtp' => [
        'host' => Env::get('SMTP_HOST', 'smtp.gmail.com'),
        'port' => (int) (Env::get('SMTP_PORT', '587') ?: '587'),
        'user' => Env::get('SMTP_USER') ?: Env::get('SENDER_EMAIL', 'developer.company2026@gmail.com'),
        'pass' => Env::get('SMTP_PASSWORD') ?: Env::get('SMTP_PASS'),
        'encryption' => Env::get('SMTP_ENCRYPTION', 'tls'),
    ],
];
