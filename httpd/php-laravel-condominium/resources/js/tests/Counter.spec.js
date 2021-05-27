import { shallowMount } from '@vue/test-utils';
import Counter from '../Counter.vue'

describe('Counter.vue', () => {
    it('increments counter', () => {
        const wrapper = shallowMount(Counter);        

        expect(wrapper.vm.counter).toBe(0);

        wrapper.find('button').trigger('click')

        expect(wrapper.vm.counter).toBe(1);
    })
});
