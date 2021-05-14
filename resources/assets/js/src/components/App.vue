<script>
    import AppHeader from './AppHeader.vue';
    import AppMain from './AppMain.vue';
    import AppFooter from './AppFooter.vue';

    import Modal from './Modal.vue';

    export default {
        name: 'App',

        components: {
            AppHeader,
            AppMain,
            AppFooter,
            Modal,
        },

        data() {
            return {
                title: 'Spindle',
                modalVisible: false,
            }
        },
    
        methods: {
            openModal() {
                this.modalVisible = true;
            },

            closeModal() {
                this.modalVisible = false;
            },
        },
    };
</script>
