import { resolveComponent, h } from "vue";
import { Arr, Obj, Any } from "@kizmann/pico-js";

export default {

    name: 'KyoPageWidgets',

    props: {

        modelValue: {
            default()
            {
                return [];
            }
        }

    },

    provide()
    {
        return {
            KyoPagebuilder: this
        }
    },

    data()
    {
        return {
            load: false, widgets: []
        };
    },

    mounted()
    {
        this.fetchWidgets();
    },

    methods: {

        fetchWidgets()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get('/{locale}/kyoto/page/http/controllers/widget/list',
                this.$root.$data);

            this.$http.get(route, options)
                .then(this.fetchDone, this.fetchError);
        },

        fetchDone(res)
        {
            this.widgets = res.data;
        },

        fetchError(res)
        {

        }

    },

    renderSlot()
    {
        return (
            <NScrollbar class="kyo-pagebuilder-extras">
                <div class="kyo-pagebuilder-extras__wrap">
                    { this.$slots.default && this.$slots.default() }
                </div>
            </NScrollbar>
        );
    },

    render()
    {
        return (
            <div class="kyo-pagebuilder">
                <KyoPagebuilderWidgets />
                <KyoPagebuilderBuilders />
                { this.ctor('renderSlot')() }
            </div>
        );
    }

}
