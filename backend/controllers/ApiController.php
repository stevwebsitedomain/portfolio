<?php

declare(strict_types=1);

namespace backend\controllers;

use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Public JSON API for portfolio data (frontend / mobile / deployment).
 */
class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'portfolio' => ['GET', 'HEAD'],
            ],
        ];

        return $behaviors;
    }

    /**
     * Portfolio profile, skills, qualifications, and projects.
     *
     * GET /api/portfolio  or  index.php?r=api/portfolio
     */
    public function actionPortfolio(): array
    {
        return [
            'name' => 'Steven Makarious',
            'title' => 'Full Stack Developer | Website Developer | Systems Developer',
            'location' => 'Tanzania',
            'email' => 'stevenabalwambo@gmail.com',
            'phone' => '+255 715 296 092',
            'summary' => 'Professional developer focused on web-based management systems, institutional platforms, and business websites.',
            'skills' => [
                'technical' => [
                    'HTML',
                    'CSS',
                    'JavaScript',
                    'Bootstrap',
                    'PHP',
                    'Yii2 Framework',
                    'MySQL',
                    'Git & GitHub',
                    'Cloud Deployment',
                    'API Integration',
                    'Responsive Design',
                ],
                'soft' => [
                    'Problem Solving',
                    'Teamwork',
                    'Communication',
                    'Creativity',
                ],
            ],
            'qualification' => 'Web & Management Systems Development',
            'qualifications' => [
                'Cloud Computing (Current)',
                'Website Development Experience',
                'Backend Development Knowledge',
                'Frontend Development Experience',
                'Hosting & Deployment Knowledge',
                'Database Management Skills',
            ],
            'projects' => [
                [
                    'name' => 'Tanzania Revenue Authority (TRA)',
                    'year' => '2025 + 2026',
                    'url' => 'https://dda-tra.free.nf',
                ],
                [
                    'name' => 'Plustax Associates',
                    'year' => '2025 + 2026',
                    'url' => 'https://audit.plustax.co.tz/',
                ],
                [
                    'name' => 'Aquinas Secondary School',
                    'year' => '2026',
                    'url' => 'https://aoa.aquinasschool.sc.tz',
                ],
                [
                    'name' => 'Miracle Tech Company',
                    'year' => '2026',
                    'url' => 'https://miracletechgroup.com',
                ],
                [
                    'name' => 'White Lake High School',
                    'year' => '2026',
                    'url' => null,
                ],
                [
                    'name' => 'EASTC',
                    'year' => '2026',
                    'url' => null,
                ],
            ],
        ];
    }
}
