(function () {
  var root = document.querySelector('.event-videos');
  var modal = document.getElementById('eventPlayer');
  if (!root || !modal) return;

  var video = modal.querySelector('video');
  var photo = modal.querySelector('.event-player-photo');
  var title = modal.querySelector('.event-player-title');

  function closePlayer() {
    modal.hidden = true;
    document.body.classList.remove('event-player-open');
    video.pause();
    video.removeAttribute('src');
    video.load();
    video.hidden = false;
    photo.hidden = true;
    photo.removeAttribute('src');
  }

  function openPlayer(card) {
    var src = card.getAttribute('data-src');
    var kind = card.getAttribute('data-kind');
    var name = card.getAttribute('data-title') || '';
    if (!src) return;
    title.textContent = name;
    if (kind === 'photo') {
      video.pause();
      video.hidden = true;
      photo.hidden = false;
      photo.alt = name;
      photo.src = src;
    } else {
      photo.hidden = true;
      photo.removeAttribute('src');
      video.hidden = false;
      video.src = src;
      var playAttempt = video.play();
      if (playAttempt && typeof playAttempt.catch === 'function') {
        playAttempt.catch(function () {});
      }
    }
    modal.hidden = false;
    document.body.classList.add('event-player-open');
  }

  root.addEventListener('click', function (event) {
    var card = event.target.closest('.event-video-card');
    if (!card || !root.contains(card)) return;
    openPlayer(card);
  });

  modal.querySelector('.event-player-close').addEventListener('click', closePlayer);
  modal.addEventListener('click', function (event) {
    if (event.target === modal) closePlayer();
  });
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && !modal.hidden) closePlayer();
  });
})();
