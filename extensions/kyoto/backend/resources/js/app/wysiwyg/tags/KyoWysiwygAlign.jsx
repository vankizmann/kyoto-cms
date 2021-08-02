import { Str, Obj, Arr, Any, Dom } from "@kizmann/pico-js";
import { h, resolveComponent } from "vue";

export default {

    name: 'KyoWysiwygAlign',

    inject: {

        KyoWysiwyg: {
            default: undefined
        }

    },

    props: {

        tag: {
            required: true
        },

        text: {
            required: true
        },

        el: {
            default()
            {
                return 'NButton';
            },
            type: [String]
        },

    },

    computed: {

        squire()
        {
            return this.KyoWysiwyg.squire;
        },

        active()
        {
            return Arr.has(this.KyoWysiwyg.path, this.tag);
        }

    },

    data()
    {
        let types = {
            'atl': 'text-left',
            'atc': 'text-center',
            'atr': 'text-right'
        };

        let labels = {
            'atl': 'Left',
            'atc': 'Center',
            'atr': 'Right'
        };

        return {
            type: Obj.get(types, this.tag),
            label: Obj.get(labels, this.tag)
        };
    },

    methods: {

        onMousedown()
        {
            eval(`this.set${Str.ucfirst(Str.camelcase(this.type))}()`);
        },

        setBold()
        {
            if ( ! this.squire.hasFormat('b') ) {
                return this.squire.bold();
            }

            this.squire.removeBold();
        },

        setItalic()
        {
            if ( ! this.squire.hasFormat('i') ) {
                return this.squire.italic();
            }

            this.squire.removeItalic();
        },

        setUnderline()
        {
            if ( ! this.squire.hasFormat('u') ) {
                return this.squire.underline();
            }

            this.squire.removeUnderline();
        },

    },

    render()
    {
        if ( ! this.type ) {
            return null;
        }

        let props = {
            type: this.KyoWysiwyg.type,
            size: this.KyoWysiwyg.size,
            icon: nano.Icons[this.type],
            onMousedown: this.onMousedown
        };

        if ( this.active ) {
            props.class = 'is-active';
        }

        let context = [
            this.trans(this.label)
        ];

        if ( ! this.text ) {
            context = null;
        }

        let component = resolveComponent(this.el);

        return h(component, props, context);
    },

}
