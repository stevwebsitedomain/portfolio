<?php
/** @var string $baseUrl */
$baseUrl = $baseUrl ?? '';
$cvUrl = $baseUrl . '/files/Steven_Abalwambo_CV.pdf';
$cvDownload = $baseUrl . '/download-cv.php';
?>
<section class="cv-panel" id="cv">
  <div class="cv-pdf" aria-hidden="true">
    <svg class="cv-pdf-svg" viewBox="0 0 72 92" width="78" height="100" focusable="false">
      <path fill="#ffffff" d="M8 2h38.5L66 21.5V84a6 6 0 0 1-6 6H8a6 6 0 0 1-6-6V8a6 6 0 0 1 6-6z"/>
      <path fill="#d7e4f0" d="M46.5 2V18a4 4 0 0 0 4 4H66z"/>
      <path fill="#b7c9d8" d="M46.5 2 66 22H50.5a4 4 0 0 1-4-4z" opacity=".45"/>
      <rect x="8" y="52" width="56" height="24" rx="3" fill="#E5252A"/>
      <text x="36" y="69" text-anchor="middle" fill="#ffffff" font-family="Arial, Helvetica, sans-serif" font-size="15" font-weight="700" letter-spacing="0.6">PDF</text>
      <path fill="#c5d4e2" d="M14 28h28v3H14zm0 8h22v3H14z"/>
    </svg>
  </div>
  <div class="cv-panel-copy">
    <h2 data-i18n="cv_title">Curriculum Vitae</h2>
    <p data-i18n="cv_lead">Steven Abalwambo — Full Stack Developer. View the CV in the browser or download the PDF.</p>
  </div>
  <div class="cv-panel-actions">
    <a class="cv-dl-btn" href="<?= htmlspecialchars($cvDownload, ENT_QUOTES) ?>">
      <i class="fa-solid fa-download" aria-hidden="true"></i>
      <span data-i18n="cv_download">Download PDF</span>
    </a>
    <a class="cv-view-btn" href="<?= htmlspecialchars($cvUrl, ENT_QUOTES) ?>" target="_blank" rel="noopener">
      <i class="fa-regular fa-eye" aria-hidden="true"></i>
      <span data-i18n="cv_view">View CV</span>
    </a>
  </div>
</section>
