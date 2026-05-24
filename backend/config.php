<?php

declare(strict_types=1);

/**
 * Backend config — set these on Render (Environment Variables).
 */
return [
    'senderEmail' => getenv('SENDER_EMAIL') ?: 'developer.company2026@gmail.com',
    'senderName' => getenv('SENDER_NAME') ?: 'LEGIT BUSINESS CONSULT LTD',
    'contactRecipientEmail' => getenv('CONTACT_EMAIL') ?: 'developer.company2026@gmail.com',
    'mailerDsn' => getenv('MAILER_DSN') ?: '',
    'mailTransport' => getenv('MAIL_TRANSPORT') ?: '',
    'brevoApiKey' => getenv('BREVO_API_KEY') ?: '',
    'resendApiKey' => getenv('RESEND_API_KEY') ?: '',
    'smtp' => [
        'host' => getenv('SMTP_HOST') ?: 'smtp.gmail.com',
        'port' => (int) (getenv('SMTP_PORT') ?: 587),
        'user' => getenv('SMTP_USER') ?: getenv('SENDER_EMAIL') ?: 'developer.company2026@gmail.com',
        'pass' => getenv('SMTP_PASSWORD') ?: getenv('SMTP_PASS') ?: '',
        'encryption' => getenv('SMTP_ENCRYPTION') ?: 'tls',
    ],
];
