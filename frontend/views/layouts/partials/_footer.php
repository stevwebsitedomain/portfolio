<?php
/** @var \yii\web\View $this */

use yii\helpers\Url;

$web = Yii::getAlias('@web');
$home = Url::to(['site/index']);
?>
<footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="<?= $home ?>" class="logo d-flex align-items-center">
            <span class="sitename">Steven Makarious</span>
          </a>
          <p>Full stack developer building responsive websites, management systems, and cloud-deployed applications for organizations in Tanzania.</p>
          <div class="social-links d-flex mt-4">
            <a href="https://github.com/" target="_blank" rel="noopener" aria-label="GitHub"><i class="bi bi-github"></i></a>
            <a href="https://linkedin.com/" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="https://wa.me/255715296092" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            <a href="mailto:stevenabalwambo@gmail.com" aria-label="Email"><i class="bi bi-envelope"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Navigate</h4>
          <ul>
            <li><a href="<?= $home ?>#hero">Home</a></li>
            <li><a href="<?= $home ?>#profile">Profile</a></li>
            <li><a href="<?= $home ?>#skills">Skills</a></li>
            <li><a href="<?= $home ?>#qualifications">Qualifications</a></li>
            <li><a href="<?= $home ?>#projects">Projects</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>More</h4>
          <ul>
            <li><a href="<?= $home ?>#contact">Contact</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact</h4>
          <p>Tanzania</p>
          <p class="mt-3"><strong>Email:</strong> <span>stevenabalwambo@gmail.com</span></p>
          <p><strong>Phone:</strong> <span>+255 715 296 092</span></p>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="sitename">Steven Makarious</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <script src="<?= $web ?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $web ?>/template/vendor/php-email-form/validate.js"></script>
  <script src="<?= $web ?>/template/vendor/aos/aos.js"></script>
  <script src="<?= $web ?>/template/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= $web ?>/template/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= $web ?>/template/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?= $web ?>/template/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= $web ?>/template/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= $web ?>/template/js/main.js"></script>
