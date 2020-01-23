window._ = require('lodash');

window.dayjs = require('dayjs');
window.dayjs.extend(require('dayjs/plugin/utc'))
window.dayjs.extend(require('dayjs/plugin/relativeTime'))

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
