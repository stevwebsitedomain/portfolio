/**
 * Portfolio frontend → Render backend connection (Cloud Computing assignment).
 * Change apiBaseUrl if your Render service URL changes.
 */
window.PORTFOLIO_CONFIG = {
  apiBaseUrl: 'https://portfolio-mbvg.onrender.com',
  endpoints: {
    portfolio: '/api/portfolio',
    requestPasswordReset: '/api/applicant/request-password-reset',
  },
};
