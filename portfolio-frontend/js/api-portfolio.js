/**
 * Fetches portfolio JSON from Render API (Cloud Computing assignment).
 * Data is exposed on window.portfolioApiData for debugging / future dynamic UI.
 */
(function () {
  'use strict';

  var API_URL =
    document.documentElement.getAttribute('data-api-url') ||
    'https://portfolio-mbvg.onrender.com/api/portfolio';

  fetch(API_URL, {
    method: 'GET',
    headers: { Accept: 'application/json' },
    mode: 'cors',
  })
    .then(function (response) {
      if (!response.ok) {
        throw new Error('API HTTP ' + response.status);
      }
      return response.json();
    })
    .then(function (data) {
      window.portfolioApiData = data;
      document.documentElement.setAttribute('data-api-status', 'ok');
    })
    .catch(function (err) {
      console.warn('[Portfolio API]', err.message || err);
      document.documentElement.setAttribute('data-api-status', 'error');
    });
})();
