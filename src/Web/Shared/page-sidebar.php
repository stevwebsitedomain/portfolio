<?php
/** @var string $baseUrl */
/** @var string $sidebarTitle */
/** @var string|null $sidebarTitleI18n */
/** @var array<int, array{href:string,label:string,i18n?:string}> $sidebarLinks */
$baseUrl = $baseUrl ?? '';
$sidebarTitle = $sidebarTitle ?? 'Pages';
$sidebarTitleI18n = $sidebarTitleI18n ?? null;
if (empty($sidebarLinks)) {
    $sidebarLinks = [
        ['href' => $baseUrl . '/about', 'label' => 'About'],
        ['href' => $baseUrl . '/services', 'label' => 'Services'],
        ['href' => $baseUrl . '/projects', 'label' => 'Projects'],
        ['href' => $baseUrl . '/news', 'label' => 'News'],
        ['href' => $baseUrl . '/events', 'label' => 'Events'],
        ['href' => $baseUrl . '/qualifications', 'label' => 'Qualifications'],
        ['href' => $baseUrl . '/contact', 'label' => 'Contact'],
    ];
}
?>
<aside class="moh-sidebox">
  <h3<?= $sidebarTitleI18n ? ' data-i18n="' . htmlspecialchars($sidebarTitleI18n, ENT_QUOTES) . '"' : '' ?>><?= htmlspecialchars($sidebarTitle) ?></h3>
  <ul>
    <?php foreach ($sidebarLinks as $link): ?>
      <li><a href="<?= htmlspecialchars($link['href'], ENT_QUOTES) ?>"<?= !empty($link['i18n']) ? ' data-i18n="' . htmlspecialchars($link['i18n'], ENT_QUOTES) . '"' : '' ?>><?= htmlspecialchars($link['label']) ?></a></li>
    <?php endforeach; ?>
  </ul>
</aside>
