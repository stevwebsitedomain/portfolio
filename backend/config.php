<?php

declare(strict_types=1);

use Portfolio\Api\Env;

/**
 * Backend config — set these on Render (Environment Variables).
 */
return [
    // Must match a VERIFIED sender in Brevo (Senders tab)
    'senderEmail' => Env::get('BREVO_SENDER_EMAIL')
        ?: Env::get('SENDER_EMAIL', 'stevenabalwambo@gmail.com'),
    'senderName' => Env::get('SENDER_NAME', 'Steven Portfolio'),
    'contactRecipientEmail' => Env::get('CONTACT_EMAIL', 'stevenabalwambo@gmail.com'),
    'brevoApiKey' => Env::getBrevoApiKey(),
];
