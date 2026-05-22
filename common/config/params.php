<?php

declare(strict_types=1);

return [
    'adminEmail' => 'developer.company2026@gmail.com',
    'supportEmail' => 'developer.company2026@gmail.com',
    'senderEmail' => 'developer.company2026@gmail.com',
    'senderName' => 'LEGIT BUSINESS CONSULT LTD',
    /** Inbox for portfolio contact form (Render API) */
    'contactRecipientEmail' => 'developer.company2026@gmail.com',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    /** Public backend URL (Render) — used in password-reset emails */
    'appUrl' => 'https://portfolio-mbvg.onrender.com',
    'api.corsOrigins' => [
        'https://portfolio-nu-taupe-017y2cafli.vercel.app',
        'https://portfolio-mbvg.onrender.com',
        'http://localhost',
        'http://127.0.0.1',
    ],
];
