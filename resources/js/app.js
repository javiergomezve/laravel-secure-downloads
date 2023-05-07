import './bootstrap';

import { createApp } from "vue";
import components from "@/components";

const app = createApp({});

Object.keys(components).forEach(key => {
    app.component(key, components[key]);
});

app.mount('#app');
