<template>
    <transition name="fade">
        <div class="modal">
            <div class="modal__outer">
                <div class="modal__inner">
                    <div class="modal__header" v-if="$slots.title">
                        <h6 class="modal__title">
                            <slot name="title"></slot>
                        </h6>
                    </div>

                    <div class="modal__content">
                        <slot></slot>
                    </div>

                    <div class="modal__footer">
                        <button class="btn" @click="close()">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        data() {
            return {
                //
            }
        },

        methods: {
            close() {
                this.$emit('close-modal');
            },
        },
    };
</script>
