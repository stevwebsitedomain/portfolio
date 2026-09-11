<?php

declare(strict_types=1);

use App\Backend;
use App\Web;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

$baseUrl = require __DIR__ . '/base-url.php';

return [
    Group::create($baseUrl)
        ->routes(
            Route::get('/')
                ->action(Web\HomePage\Action::class)
                ->name('home'),
            Route::get('/about')
                ->action(Web\AboutPage\Action::class)
                ->name('about'),
            Route::get('/projects')
                ->action(Web\ProjectsPage\Action::class)
                ->name('projects'),
            Route::get('/contact')
                ->action(Web\ContactPage\Action::class)
                ->name('contact'),
            Route::get('/qualifications')
                ->action(Web\QualificationsPage\Action::class)
                ->name('qualifications'),
            Route::get('/news')
                ->action(Web\NewsPage\Action::class)
                ->name('news'),
            Route::get('/events')
                ->action(Web\EventsPage\Action::class)
                ->name('events'),
            Route::get('/services')
                ->action(Web\ServicesPage\Action::class)
                ->name('services'),
            Route::get('/api/portfolio')
                ->action(Backend\Portfolio\Action::class)
                ->name('api.portfolio'),
            Route::post('/send-message')
                ->action(Backend\Contact\Action::class)
                ->name('contact.send'),
            Route::post('/api/contact')
                ->action(Backend\Contact\Action::class)
                ->name('api.contact'),
        ),
];
