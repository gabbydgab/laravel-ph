require('./bootstrap');

window.Vue = require('vue');

// plugins
import VCalendar from 'v-calendar';
Vue.use(VCalendar, {});

//filters
Vue.filter('dateFormat', function (value, format) {
    if (! value) return null
    return dayjs(value).format(format)
});

// components
Vue.component('photo-upload', require('./components/PhotoUpload.vue').default);
Vue.component('date-time-picker', require('./components/DateTimePicker.vue').default);
Vue.component('tags-input', require('./components/TagsInput.vue').default);

const app = new Vue({ el: '#app' });
