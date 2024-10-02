import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from 'ziggy'
import { route } from 'ziggy';

import Main from '@/Layouts/Main.vue'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page =  pages[`./Pages/${name}.vue`]

    page.default.layout = page.default.layout || Main

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })      
      .use(plugin)
      .use(ZiggyVue)
      .mount(el)
  },
})