import { shallowMount } from '@vue/test-utils'

import Modal from '../../src/components/Modal.vue';

describe('Counter.vue', () => {
    it('emits the close-modal event', () => {
        const wrapper = shallowMount(Modal);

        wrapper.find('button').trigger('click');

        expect(wrapper.emitted()).toHaveProperty('close-modal')
    });
});
