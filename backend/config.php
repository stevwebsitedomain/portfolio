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
    'brevoApiKey' => Env::getBrevoApiKey(),
];
