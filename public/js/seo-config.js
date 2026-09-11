/**
 * Public SEO constants. Primary live domain:
 * https://makarious.legitconsult.co.tz
 *
 * Google Search Console HTML-tag method: paste the token into
 * googleSiteVerification (not the whole meta tag). HTML-file verification
 * is already served at /google8e8f4d3c041486de.html
 */
window.PORTFOLIO_SEO = {
  siteUrl: 'https://makarious.legitconsult.co.tz',
  googleSiteVerification: '',
  organizationName: 'Digital Matrix Technology',
  personName: 'Steven Makarious',
};

(function () {
  var token = window.PORTFOLIO_SEO && window.PORTFOLIO_SEO.googleSiteVerification;
  if (!token) return;
  var meta = document.querySelector('meta[name="google-site-verification"]');
  if (!meta) {
    meta = document.createElement('meta');
    meta.setAttribute('name', 'google-site-verification');
    document.head.appendChild(meta);
  }
  meta.setAttribute('content', token);
})();
