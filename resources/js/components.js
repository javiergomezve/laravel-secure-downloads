import { defineAsyncComponent } from "vue";

const components = {
    'hello-component': defineAsyncComponent(() => import('./components/Hello.vue')),
    'world-component': defineAsyncComponent(() => import('./components/World.vue')),
};

export default components;
