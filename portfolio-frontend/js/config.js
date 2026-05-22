/**
 * Portfolio frontend → Render backend (change apiBaseUrl when you deploy backend).
 *
 * Example after Render deploy:
 *   apiBaseUrl: 'https://your-service.onrender.com'
 */
window.PORTFOLIO_CONFIG = {
  apiBaseUrl: 'https://portfolio-mbvg.onrender.com',
  endpoints: {
    portfolio: '/api/portfolio',
    contact: '/api/contact',
    requestPasswordReset: '/api/applicant/request-password-reset',
  },
};
