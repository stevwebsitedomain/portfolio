<?php
/** @var \yii\web\View $this */
/** @var string|null $activeNav */

use yii\helpers\Url;

$home = Url::to(['site/index']);
?>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="<?= $home ?>" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">Steven</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="<?= $home ?>#hero" class="active">Home</a></li>
          <li><a href="<?= $home ?>#profile">Profile</a></li>
          <li><a href="<?= $home ?>#skills">Skills</a></li>
          <li><a href="<?= $home ?>#qualifications">Qualifications</a></li>
          <li><a href="<?= $home ?>#projects">Projects</a></li>
          <li><a href="<?= $home ?>#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="<?= $home ?>#contact">Contact Me</a>

    </div>
  </header>
