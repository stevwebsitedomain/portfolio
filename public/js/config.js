/**
 * Yii3 app: pages + portfolio API on the same origin.
 */
window.PORTFOLIO_CONFIG = {
  siteUrl: (window.PORTFOLIO_SEO && window.PORTFOLIO_SEO.siteUrl) || 'https://makarious.legitconsult.co.tz',
  googleSiteVerification: (window.PORTFOLIO_SEO && window.PORTFOLIO_SEO.googleSiteVerification) || '',
  whatsappNumber: '255715296092',
  contactEndpoint: (window.PORTFOLIO_BASE || '') + '/send-message.php',
  apiBaseUrl: window.PORTFOLIO_BASE || '',
  endpoints: {
    portfolio: '/api/portfolio',
    contact: '/api/contact',
  },
};
