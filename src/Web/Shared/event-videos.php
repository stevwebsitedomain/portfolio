<?php
/** @var string $baseUrl */
$baseUrl = $baseUrl ?? '';
$eventMedia = [
    [
        'kind' => 'video',
        'src' => $baseUrl . '/media/events/white-lake-school.mp4',
        'poster' => $baseUrl . '/media/events/white-lake-school.jpg?v=1',
        'title' => 'White Lake School',
    ],
    [
        'kind' => 'video',
        'src' => $baseUrl . '/media/events/tra.mp4',
        'poster' => $baseUrl . '/media/events/tra.jpg?v=1',
        'title' => 'TRA',
        'tall' => true,
    ],
    [
        'kind' => 'video',
        'src' => $baseUrl . '/media/events/aquinas-school.mp4',
        'poster' => $baseUrl . '/media/events/aquinas-school.jpg?v=1',
        'title' => 'Aquinas School',
    ],
    [
        'kind' => 'photo',
        'src' => $baseUrl . '/media/events/buhalahala.jpeg',
        'poster' => $baseUrl . '/media/events/buhalahala.jpeg',
        'title' => 'Buhalahala',
    ],
];
?>
<div class="event-videos">
  <div class="event-videos-grid">
    <?php foreach ($eventMedia as $item): ?>
      <?php $isVideo = $item['kind'] === 'video'; ?>
      <button
        class="event-video-card<?= $isVideo ? '' : ' is-photo' ?><?= !empty($item['tall']) ? ' is-tall' : '' ?>"
        type="button"
        data-kind="<?= $item['kind'] ?>"
        data-src="<?= htmlspecialchars($item['src'], ENT_QUOTES) ?>"
        data-title="<?= htmlspecialchars($item['title'], ENT_QUOTES) ?>"
        aria-label="<?= htmlspecialchars(($isVideo ? 'Play ' : 'View ') . $item['title'], ENT_QUOTES) ?>"
      >
        <span class="event-video-frame">
          <img src="<?= htmlspecialchars($item['poster'], ENT_QUOTES) ?>" alt="" loading="lazy">
          <span class="event-video-shade" aria-hidden="true"></span>
          <?php if ($isVideo): ?>
            <span class="event-video-play" aria-hidden="true"><i class="fa-solid fa-play"></i></span>
            <span class="event-video-chip" data-i18n="event_video_chip">Video</span>
            <span class="event-video-hint" data-i18n="event_video_hint">Click to play</span>
          <?php else: ?>
            <span class="event-video-chip" data-i18n="event_photo_chip">Photo</span>
            <span class="event-video-hint" data-i18n="event_photo_hint">Click to view</span>
          <?php endif; ?>
        </span>
        <span class="event-video-name"><?= htmlspecialchars($item['title'], ENT_QUOTES) ?></span>
      </button>
    <?php endforeach; ?>
  </div>
</div>
<div class="event-player" id="eventPlayer" hidden>
  <div class="event-player-dialog" role="dialog" aria-modal="true" aria-labelledby="eventPlayerTitle">
    <button class="event-player-close" type="button" data-i18n-aria="search_close" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    <p class="event-player-title" id="eventPlayerTitle"></p>
    <video controls playsinline preload="none"></video>
    <img class="event-player-photo" alt="" hidden>
  </div>
</div>
