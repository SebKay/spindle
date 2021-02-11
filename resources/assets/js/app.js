import { createApp } from 'vue';

const App = createApp({
    name: 'App',
    delimiters: ['{=', '=}'],
    data() {
        return {
            test: 'yas'
        }
    },
    mounted() {
        console.log('yas');
    }
});

App.mount('#app');
