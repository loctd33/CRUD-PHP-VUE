import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import jQuery from "jquery";
const $ = jQuery;
window.$ = $;

const app = createApp(App).use(router)
app.mount('#app')
