try {
  window.$ = window.jQuery = require('jquery');
  // require('bootstrap-sass');
} catch (e) {}

var token = document.head.querySelector('meta[name="csrf-token"]');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

