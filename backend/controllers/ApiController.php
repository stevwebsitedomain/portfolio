<?php

declare(strict_types=1);

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Public JSON API for portfolio data (Vercel frontend / assignment).
 *
 * GET https://portfolio-mbvg.onrender.com/api/portfolio
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

        $origins = Yii::$app->params['api.corsOrigins'] ?? ['*'];

        $behaviors = [
            'cors' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => $origins,
                    'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => false,
                    'Access-Control-Max-Age' => 86400,
                ],
            ],
        ] + $behaviors;

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['?', '@'],
                ],
            ],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'portfolio' => ['GET', 'HEAD', 'OPTIONS'],
            ],
        ];

        return $behaviors;
    }

    /**
     * Portfolio JSON for static frontend (Vercel).
     *
     * GET /api/portfolio
     */
    public function actionPortfolio(): array
    {
        return [
            'profile' => [
                'name' => 'Steven Makarious',
                'title' => 'Full Stack Developer | Website Developer | Systems Developer',
                'organization' => 'LEGIT BUSINESS CONSULT LTD',
                'location' => 'Tanzania',
                'summary' => 'Professional developer focused on web-based management systems, institutional platforms, and business websites.',
            ],
            'skills' => [
                'HTML',
                'CSS',
                'JavaScript',
                'Bootstrap',
                'PHP',
                'Yii2',
                'MySQL',
                'Git & GitHub',
                'Cloud Deployment',
                'API Integration',
                'Responsive Design',
                'Problem Solving',
                'Teamwork',
                'Communication',
                'Creativity',
            ],
            'qualifications' => [
                'Cloud Computing (Current)',
                'Website Development',
                'Backend Development (PHP, Yii2, MySQL, REST APIs)',
                'Frontend Development (HTML, CSS, JavaScript, Bootstrap)',
                'Hosting & Deployment (Vercel, Render)',
                'Database Management',
            ],
            'projects' => [
                [
                    'name' => 'Tanzania Revenue Authority (TRA)',
                    'year' => '2025 + 2026',
                    'url' => 'https://dda-tra.free.nf',
                    'description' => 'Web system that scrapes business names online to help TRA identify taxpayers from online businesses.',
                    'tags' => ['Web Scraping', 'Tax System', 'PHP', 'Database'],
                ],
                [
                    'name' => 'Plustax Associates',
                    'year' => '2025 + 2026',
                    'url' => 'https://audit.plustax.co.tz/',
                    'description' => 'Office management system for document storage and staff communication.',
                    'tags' => ['Office System', 'Document Management', 'Communication', 'Audit'],
                ],
                [
                    'name' => 'Aquinas Secondary School',
                    'year' => '2026',
                    'url' => 'https://aoa.aquinasschool.sc.tz',
                    'description' => 'Online admission application system for students and parents.',
                    'tags' => ['Online Application', 'Education', 'Admission System', 'Web App'],
                ],
                [
                    'name' => 'Miracle Tech Company',
                    'year' => '2026',
                    'url' => 'https://miracletechgroup.com',
                    'description' => 'Official company website with modern responsive design.',
                    'tags' => ['Company Website', 'Web Design', 'Responsive', 'Branding'],
                ],
                [
                    'name' => 'White Lake High School',
                    'year' => '2026',
                    'url' => null,
                    'description' => 'Student results management system for teachers and parents.',
                    'tags' => ['Results System', 'Education', 'School Management', 'Web App'],
                ],
                [
                    'name' => 'EASTC',
                    'year' => '2026',
                    'url' => null,
                    'description' => 'Web-based institutional management system.',
                    'tags' => ['Management System', 'Web Development', 'Database', 'Institution'],
                ],
                [
                    'name' => 'Portfolio Website',
                    'year' => '2026',
                    'url' => 'https://portfolio-nu-taupe-017y2cafli.vercel.app',
                    'description' => 'Cloud Computing assignment portfolio — static frontend on Vercel, API on Render.',
                    'tags' => ['Portfolio', 'Vercel', 'Render', 'REST API'],
                ],
            ],
            'contact' => [
                'email' => 'stevenabalwambo@gmail.com',
                'phone' => '+255 715 296 092',
                'whatsapp' => 'https://wa.me/255715296092',
                'github' => 'https://github.com/stevwebsitedomain',
                'linkedin' => 'https://linkedin.com/in/stevenmakarious',
            ],
        ];
    }
}
