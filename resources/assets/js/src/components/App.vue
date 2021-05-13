<template>
    <app-header :title="title"></app-header>
</template>

<script>
import AppHeader from './AppHeader.vue';

export default {
    name: 'App',

    components: {
        AppHeader,
    },

    data() {
        return {
            title: 'Spindle',
        }
    },
};
</script>
