<?php

declare(strict_types=1);

use Portfolio\Api\Env;

/**
 * Backend config — set GMAIL_APP_PASSWORD on Render.
 */
return [
    'senderEmail' => Env::get('SENDER_EMAIL', 'developer.company2026@gmail.com'),
    'senderName' => Env::get('SENDER_NAME', 'Steven Portfolio'),
    'contactRecipientEmail' => Env::get('CONTACT_EMAIL', 'developer.company2026@gmail.com'),
    'smtpHost' => Env::get('SMTP_HOST', 'smtp.gmail.com'),
    'smtpPort' => (int) (Env::get('SMTP_PORT', '587') ?: '587'),
    'smtpUser' => Env::get('SMTP_USER', 'developer.company2026@gmail.com'),
];
