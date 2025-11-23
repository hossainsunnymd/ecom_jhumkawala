import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3';
import "vue-toast-notification/dist/theme-sugar.css";
import '../css/Admin/css/style.css';
import '../css/Admin/css/custom.css';
import '../css/Admin/css/animation.css';
import '../css/Admin/css/animate.min.css';
import '../css/Admin/css/bootstrap-select.min.css';
import '../css/Admin/font/fonts.css';
import '../css/Admin/font/fonts.css';
import '../css/Admin/icon/style.css';
import '../css/Admin/css/bootstrap.css';
import './bootstrap';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})
