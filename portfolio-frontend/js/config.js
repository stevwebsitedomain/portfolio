/**
 * Portfolio frontend (Vercel) -> Backend API (Render).
 * LIVE backend: https://portfolio-ar0s.onrender.com
 * LIVE site: https://makarious.legitconsult.co.tz
 */
window.PORTFOLIO_CONFIG = {
  siteUrl: (window.PORTFOLIO_SEO && window.PORTFOLIO_SEO.siteUrl) || 'https://makarious.legitconsult.co.tz',
  /** Paste Google Search Console HTML-tag token in js/seo-config.js */
  googleSiteVerification: (window.PORTFOLIO_SEO && window.PORTFOLIO_SEO.googleSiteVerification) || '',
  whatsappNumber: '255715296092',
  apiBaseUrl: 'https://portfolio-ar0s.onrender.com',
  endpoints: {
    portfolio: '/api/portfolio',
    contact: '/api/contact',
  },
};
