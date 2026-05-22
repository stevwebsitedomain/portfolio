<?php

declare(strict_types=1);

/**
 * Backend config — values from Render Environment Variables.
 */
return [
    'senderEmail' => getenv('SENDER_EMAIL') ?: 'developer.company2026@gmail.com',
    'senderName' => getenv('SENDER_NAME') ?: 'LEGIT BUSINESS CONSULT LTD',
    'contactRecipientEmail' => getenv('CONTACT_EMAIL') ?: 'developer.company2026@gmail.com',
    'mailerDsn' => getenv('MAILER_DSN') ?: '',
    'corsOrigins' => array_filter(array_map('trim', explode(',', (string) (getenv('CORS_ORIGINS') ?: implode(',', [
        '*',
        'https://portfolio-nu-taupe-017y2cafli.vercel.app',
        'https://portfolio-mbvg.onrender.com',
        'http://localhost',
        'http://127.0.0.1',
    ]))))),
];
