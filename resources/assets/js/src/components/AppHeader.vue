<template>
    <header class="site-header">
        <h1>
            <a href="/">
                {{ title }}
            </a>
        </h1>
    </header>
</template>

<script>
    export default {
        data() {
            return {
                //
            }
        },
        props: ['title'],
    }
</script>
