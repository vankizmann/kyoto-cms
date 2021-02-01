import { Any, Dom } from "@kizmann/pico-js";

export default {

    props: {

        value: {
            required: true
        },

        item: {
            required: true
        },

        copy: {
            required: true
        },

        remove: {
            required: true
        }

    },

    computed: {

        data()
        {
            return this.item.data;
        }

    },

    provide()
    {
        return {
            KyoWidget: this
        };
    },

    mounted()
    {
        let callback = Any.debounce(this.onResize, 300);

        Dom.find(window).on('resize', callback, this._.uid);
    },

    beforeUnmount()
    {
        Dom.find(window).off('resize', null, this._.uid);
    },

    methods: {

        onResize() {}

    }

}
