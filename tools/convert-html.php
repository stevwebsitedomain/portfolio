<?php

declare(strict_types=1);

/**
 * One-time script: convert Bootstrap HTML pages to Yii2 PHP views.
 */
$root = dirname(__DIR__);

$pages = [
    'index' => 'index.html',
    'blog' => 'blog.html',
    'blog-details' => 'blog-details.html',
    'portfolio-details' => 'portfolio-details.html',
    'services-details' => 'services-details.html',
    'starter-page' => 'starter-page.html',
];

$linkMap = [
    'index.html' => "<?= \\yii\\helpers\\Url::to(['site/index']) ?>",
    'blog.html' => "<?= \\yii\\helpers\\Url::to(['site/blog']) ?>",
    'blog-details.html' => "<?= \\yii\\helpers\\Url::to(['site/blog-details']) ?>",
    'portfolio-details.html' => "<?= \\yii\\helpers\\Url::to(['site/portfolio-details']) ?>",
    'services-details.html' => "<?= \\yii\\helpers\\Url::to(['site/services-details']) ?>",
    'starter-page.html' => "<?= \\yii\\helpers\\Url::to(['site/starter-page']) ?>",
];

function convertLinks(string $html): string
{
    global $linkMap;
    $html = str_replace(array_keys($linkMap), array_values($linkMap), $html);
    $html = str_replace('assets/', "<?= Yii::getAlias('@web') ?>/assets/", $html);
    $html = str_replace('forms/', "<?= Yii::getAlias('@web') ?>/forms/", $html);
    return $html;
}

$indexHtml = file_get_contents($root . '/index.html');
if (!preg_match('/<header id="header".*?<\/header>/s', $indexHtml, $headerMatch)) {
    fwrite(STDERR, "Header not found\n");
    exit(1);
}
if (!preg_match('/<footer id="footer".*?<script src="assets\/js\/main\.js"><\/script>/s', $indexHtml, $footerMatch)) {
    fwrite(STDERR, "Footer block not found\n");
    exit(1);
}

$viewsDir = $root . '/frontend/views/site';
$layoutsDir = $root . '/frontend/views/layouts';
$partialsDir = $root . '/frontend/views/layouts/partials';

foreach ([$viewsDir, $layoutsDir, $partialsDir] as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

$headerPhp = "<?php\n/** @var \\yii\\web\\View \$this */\n/** @var string|null \$activeNav */\n?>\n" . convertLinks($headerMatch[0]);
file_put_contents($partialsDir . '/_header.php', $headerPhp);

$footerPhp = "<?php\n/** @var \\yii\\web\\View \$this */\n?>\n" . convertLinks($footerMatch[0]);
file_put_contents($partialsDir . '/_footer.php', $footerPhp);

foreach ($pages as $view => $file) {
    $path = $root . '/' . $file;
    if (!is_file($path)) {
        fwrite(STDERR, "Missing: $file\n");
        continue;
    }
    $html = file_get_contents($path);
    if (!preg_match('/<main class="main">(.*)<\/main>/s', $html, $mainMatch)) {
        fwrite(STDERR, "Main not found in $file\n");
        continue;
    }
    $bodyClass = 'page';
    if (preg_match('/<body class="([^"]*)"/', $html, $bodyMatch)) {
        $bodyClass = $bodyMatch[1];
    }
    $title = 'Append';
    if (preg_match('/<title>([^<]*)<\/title>/', $html, $titleMatch)) {
        $title = trim($titleMatch[1]);
    }

    $main = convertLinks($mainMatch[1]);
    $viewPhp = <<<PHP
<?php

/** @var yii\web\View \$this */

\$this->title = '{$title}';
\$this->params['bodyClass'] = '{$bodyClass}';

?>
<main class="main">
{$main}
</main>

PHP;
    file_put_contents($viewsDir . '/' . $view . '.php', $viewPhp);
    echo "Created view: $view.php\n";
}

echo "Done.\n";
