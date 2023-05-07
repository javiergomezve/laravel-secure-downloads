import { defineAsyncComponent } from 'vue';

const components = {
    'downloads-component': defineAsyncComponent(() => import('./components/Downloads.vue')),
};

export default components;
