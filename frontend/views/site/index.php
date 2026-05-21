<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Steven Makarious — Cloud Computing Portfolio';
$this->params['bodyClass'] = 'index-page';

$web = Yii::getAlias('@web');
$home = Url::to(['site/index']);
$img = $web . '/images';

$orgLogos = [
    ['file' => 'tra.jpg', 'alt' => 'Tanzania Revenue Authority'],
    ['file' => 'plustax.jpg', 'alt' => 'Plustax Associates'],
    ['file' => 'aquinas.png', 'alt' => 'Aquinas Secondary School'],
    ['file' => 'miracletech.jpeg', 'alt' => 'Miracle Tech Company'],
    ['file' => 'whitelake.png', 'alt' => 'White Lake High School'],
    ['file' => 'eastc.png', 'alt' => 'EASTC'],
];

?>
<main class="main">

    <!-- 1. Hero / Introduction -->
    <section id="hero" class="hero section dark-background">
      <img src="<?= $web ?>/template/img/hero-bg.jpg" alt="" data-aos="fade-in">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
            <p class="mb-2 opacity-75">Full Stack Developer | Website Developer | Systems Developer</p>
            <h2>Steven Makarious</h2>
            <p class="lead mt-3">I design and develop professional websites, web-based management systems, and digital solutions for businesses, schools, and institutions. I build custom applications, integrate databases and APIs, and deploy projects to the cloud so organizations can work more efficiently online.</p>
            <div class="d-flex flex-wrap gap-3 mt-4 hero-actions">
              <a href="<?= $home ?>#projects" class="btn-getstarted">View Projects</a>
              <a href="<?= $home ?>#contact" class="btn-getstarted">Contact Me</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 2. Personal Profile -->
    <section id="profile" class="about section light-background">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">
          <div class="col-xl-5 content">
            <h3>Personal Profile</h3>
            <h2>Steven Makarious</h2>
            <p>I am a professional developer focused on building web-based management systems, institutional platforms, and business websites. I design and develop complete digital solutions — from user interfaces and databases to backend logic, reports, and live deployment — helping organizations manage data, serve clients online, and run their operations more efficiently.</p>
          </div>
          <div class="col-xl-7">
            <div class="row gy-4 icon-boxes profile-icon-boxes">
              <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box w-100">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Location</h3>
                  <p>Tanzania</p>
                </div>
              </div>
              <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box w-100">
                  <i class="bi bi-window-stack"></i>
                  <h3>Field</h3>
                  <p>Web & Management Systems</p>
                </div>
              </div>
              <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box w-100">
                  <i class="bi bi-code-slash"></i>
                  <h3>Experience</h3>
                  <p>Systems & Web Development</p>
                </div>
              </div>
              <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box w-100">
                  <i class="bi bi-cpu"></i>
                  <h3>Interest</h3>
                  <p>Management Systems, Website Development, Database Solutions</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 3. Skills -->
    <section id="skills" class="services section skills">
      <div class="container section-title" data-aos="fade-up">
        <h2>Skills</h2>
        <p>Technical and professional competencies in modern web and cloud development</p>
      </div>
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
          <div class="col-lg-7">
            <h4 class="mb-4">Technical Skills</h4>
            <?php
            $technical = [
                ['name' => 'HTML', 'pct' => 95],
                ['name' => 'CSS', 'pct' => 90],
                ['name' => 'JavaScript', 'pct' => 85],
                ['name' => 'Bootstrap', 'pct' => 90],
                ['name' => 'PHP', 'pct' => 88],
                ['name' => 'Yii2 Framework', 'pct' => 82],
                ['name' => 'MySQL', 'pct' => 85],
                ['name' => 'Git & GitHub', 'pct' => 80],
                ['name' => 'Cloud Deployment', 'pct' => 78],
                ['name' => 'API Integration', 'pct' => 80],
                ['name' => 'Responsive Design', 'pct' => 92],
            ];
            foreach ($technical as $i => $skill): ?>
            <div class="skill-item" data-aos="fade-up" data-aos-delay="<?= min(100 + $i * 30, 400) ?>">
              <h4><?= $skill['name'] ?> <span><?= $skill['pct'] ?>%</span></h4>
              <div class="progress" role="progressbar" aria-valuenow="<?= $skill['pct'] ?>" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: <?= $skill['pct'] ?>%"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="col-lg-5">
            <h4 class="mb-4">Soft Skills</h4>
            <div class="row gy-4">
              <?php
              $soft = [
                  ['icon' => 'bi-lightbulb', 'name' => 'Problem Solving'],
                  ['icon' => 'bi-people', 'name' => 'Teamwork'],
                  ['icon' => 'bi-chat-dots', 'name' => 'Communication'],
                  ['icon' => 'bi-palette', 'name' => 'Creativity'],
              ];
              foreach ($soft as $i => $s): ?>
              <div class="col-6" data-aos="zoom-in" data-aos-delay="<?= 150 + $i * 80 ?>">
                <div class="soft-skill-card">
                  <i class="bi <?= $s['icon'] ?>"></i>
                  <h5 class="mb-0"><?= $s['name'] ?></h5>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 4. Qualifications -->
    <section id="qualifications" class="features section light-background qualifications">
      <div class="container section-title" data-aos="fade-up">
        <h2>Qualifications</h2>
        <p>Academic background and professional development in computing and web technologies</p>
      </div>
      <div class="container">
        <div class="row gy-4">
          <?php
          $quals = [
              ['icon' => 'bi-mortarboard', 'title' => 'Cloud Computing', 'text' => 'Diploma/Bachelor in Cloud Computing (Current) — building expertise in cloud infrastructure, deployment, and distributed systems.'],
              ['icon' => 'bi-window', 'title' => 'Website Development', 'text' => 'Practical experience designing and developing responsive, professional websites for organizations and personal projects.'],
              ['icon' => 'bi-server', 'title' => 'Backend Development', 'text' => 'Strong knowledge of PHP, Yii2, MySQL, authentication, and RESTful API development for real-world applications.'],
              ['icon' => 'bi-layout-text-window', 'title' => 'Frontend Development', 'text' => 'Proficient in HTML, CSS, JavaScript, and Bootstrap for modern, user-friendly interfaces.'],
              ['icon' => 'bi-cloud-upload', 'title' => 'Hosting & Deployment', 'text' => 'Experience deploying applications to cloud platforms including Vercel, Render, and shared hosting environments.'],
              ['icon' => 'bi-database', 'title' => 'Database Management', 'text' => 'Skilled in designing, querying, and maintaining MySQL databases for web applications and reporting systems.'],
          ];
          foreach ($quals as $i => $q): ?>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= 100 + $i * 50 ?>">
            <div class="qual-card">
              <i class="bi <?= $q['icon'] ?>"></i>
              <h4><?= $q['title'] ?></h4>
              <p class="mb-0"><?= $q['text'] ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- 5. Projects (Work I've Done) -->
    <section id="projects" class="services section light-background work-done">
      <div class="container section-title" data-aos="fade-up">
        <h2>Projects</h2>
        <p>Professional systems and websites I have developed for organizations in Tanzania and beyond</p>
      </div>
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="org-card">
              <div class="org-logo"><img src="<?= $img ?>/tra.jpg" alt="Tanzania Revenue Authority"></div>
              <p class="org-year">2025 + 2026</p>
              <h4>Tanzania Revenue Authority (TRA)</h4>
              <p>I developed a web system that scrapes business names online. This system helps TRA easily identify taxpayers from online businesses, thus increasing the efficiency of revenue collection.</p>
              <div class="org-tags mb-3">
                <span>Web Scraping</span><span>Tax System</span><span>PHP</span><span>Database</span>
              </div>
              <div class="btn-live">
                <a href="https://dda-tra.free.nf" target="_blank" rel="noopener" class="btn btn-get-started">View Live System</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
            <div class="org-card">
              <div class="org-logo"><img src="<?= $img ?>/plustax.jpg" alt="Plustax Associates"></div>
              <p class="org-year">2025 + 2026</p>
              <h4>Plustax Associates</h4>
              <p>I built an office management system for Plustax Associates — an institution focused on tax assessment and auditing various companies. The system is used by staff to store documents and communicate through the platform, increasing work efficiency.</p>
              <div class="org-tags mb-3">
                <span>Office System</span><span>Document Management</span><span>Communication</span><span>Audit</span>
              </div>
              <div class="btn-live">
                <a href="https://audit.plustax.co.tz/" target="_blank" rel="noopener" class="btn btn-get-started">View Live System</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="org-card">
              <div class="org-logo"><img src="<?= $img ?>/aquinas.png" alt="Aquinas Secondary School"></div>
              <p class="org-year">2026</p>
              <h4>Aquinas Secondary School</h4>
              <p>I developed an online application system for Aquinas Secondary School that allows students and parents to easily apply for admission online. The system simplifies the application process, manages applicant data efficiently, and reduces paperwork for the school administration.</p>
              <div class="org-tags mb-3">
                <span>Online Application</span><span>Education</span><span>Admission System</span><span>Web App</span>
              </div>
              <div class="btn-live">
                <a href="https://aoa.aquinasschool.sc.tz" target="_blank" rel="noopener" class="btn btn-get-started">View Live System</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="org-card">
              <div class="org-logo"><img src="<?= $img ?>/miracletech.jpeg" alt="Miracle Tech Company"></div>
              <p class="org-year">2026</p>
              <h4>Miracle Tech Company</h4>
              <p>I designed and developed the official company website for Miracle Tech, a technology company. The website showcases their services, portfolio, and contact information with a modern, responsive design that helps the company establish a strong online presence and attract more clients.</p>
              <div class="org-tags mb-3">
                <span>Company Website</span><span>Web Design</span><span>Responsive</span><span>Branding</span>
              </div>
              <div class="btn-live">
                <a href="https://miracletechgroup.com" target="_blank" rel="noopener" class="btn btn-get-started">View Live System</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="org-card">
              <div class="org-logo"><img src="<?= $img ?>/whitelake.png" alt="White Lake High School"></div>
              <p class="org-year">2026</p>
              <h4>White Lake High School</h4>
              <p>I developed a student results management system for White Lake High School that allows teachers to easily enter, calculate, and publish student examination results. Students and parents can securely access their results online, while the school administration can generate reports, track academic performance, and manage student records efficiently.</p>
              <div class="org-tags mb-3">
                <span>Results System</span><span>Education</span><span>School Management</span><span>Web App</span>
              </div>
              <div class="btn-live">
                <a href="#" class="btn btn-get-started">View Live System</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
            <div class="org-card">
              <div class="org-logo"><img src="<?= $img ?>/eastc.png" alt="EASTC"></div>
              <p class="org-year">2026</p>
              <h4>EASTC</h4>
              <p>I developed a web-based management system for EASTC that supports institutional operations, data management, and efficient service delivery. The system helps staff manage records, streamline workflows, and improve overall administrative performance within the organization.</p>
              <div class="org-tags mb-3">
                <span>Management System</span><span>Web Development</span><span>Database</span><span>Institution</span>
              </div>
              <div class="btn-live">
                <a href="#" class="btn btn-get-started">View Live System</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Logo marquee below cards -->
        <div class="org-marquee-wrap" data-aos="fade-up" data-aos-delay="100">
          <h4>Organizations I Have Worked With</h4>
          <div class="org-marquee">
            <div class="org-marquee-track">
              <?php foreach (array_merge($orgLogos, $orgLogos) as $logo): ?>
              <img src="<?= $img ?>/<?= $logo['file'] ?>" alt="<?= $logo['alt'] ?>">
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Projects -->

    <!-- 6. Contact -->
    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact Information</h2>
        <p>Get in touch for collaborations, opportunities, or project inquiries</p>
      </div>
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-5">
            <div class="row gy-4">
              <div class="col-md-12">
                <div class="info-item" data-aos="fade" data-aos-delay="200">
                  <i class="bi bi-envelope"></i>
                  <h3>Email</h3>
                  <p><a href="mailto:stevenabalwambo@gmail.com">stevenabalwambo@gmail.com</a></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Phone</h3>
                  <p><a href="tel:+255715296092">+255 715 296 092</a></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="350">
                  <i class="bi bi-whatsapp"></i>
                  <h3>WhatsApp</h3>
                  <p><a href="https://wa.me/255715296092" target="_blank" rel="noopener">+255 715 296 092</a></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <i class="bi bi-github"></i>
                  <h3>GitHub</h3>
                  <p><a href="https://github.com/" target="_blank" rel="noopener">github.com/stevenmakarious</a></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="450">
                  <i class="bi bi-linkedin"></i>
                  <h3>LinkedIn</h3>
                  <p><a href="https://linkedin.com/" target="_blank" rel="noopener">linkedin.com/in/stevenmakarious</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <form action="<?= $web ?>/forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="col-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>
                <div class="col-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>
                <div class="col-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                  <button type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

</main>
