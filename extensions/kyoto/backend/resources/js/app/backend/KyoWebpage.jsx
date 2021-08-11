import KyoWebpageNode from "./KyoWebpageNode";
import { Route } from "@kizmann/pico-js";

export default {

    name: 'KyoWebpage',

    components: {
        [KyoWebpageNode.name]: KyoWebpageNode
    },

    data()
    {
        let query = {
            search: '', columns: ['title', 'slug']
        };

        return {
            load: false, selected: [], items: [], query
        };
    },

    mounted()
    {
        this.fetch();
    },

    watch: {

        'query.search': function () {
            this.fetch();
        }

    },

    methods: {

        /**
         * Fetch items from server
         */
        fetch()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = Route.get('/{locale}/kyoto/menu/http/controllers/menu/index',
                this.$root.$data, this.query);

            this.$http.get(route, options)
                .then(this.fetchDone, this.fetchError);
        },

        /**
         * Function when request succeeds
         * @param res
         */
        fetchDone(res)
        {
            this.items = res.data.data;
        },

        /**
         * Function when request fails
         * @param res
         */
        fetchError(res)
        {
            //
        },

    },

    renderSearch()
    {
        if ( this.selected.length !== 0 ) {
            return;
        }

        let searchProps = {
            modelValue: this.query.search,
            placeholder: this.trans('Search for ...')
        };

        searchProps['onKeydown'] = (event) => {
            if ( event.which === 13 ) {
                this.query.search = event.target.value;
            }
        };

        let refreshProps = {
            type: 'default',
            icon: 'fa fa-sync',
            square: true,
        };

        refreshProps['onClick'] = () => {
            this.fetch();
        }

        return (
            <div class="kyo-webpage__search">
                <div class="grid grid--row grid--middle grid--5">
                    <div class="col--flex-1-1">
                        <NInput {...searchProps} />
                    </div>
                    <div class="col--flex-0-0">
                        <NButton {...refreshProps} />
                    </div>
                </div>
            </div>
        )
    },

    renderTools()
    {
        if ( this.selected.length === 0 ) {
            return;
        }

        let deleteProps = {
            type: 'danger',
            icon: 'fa fa-minus-circle',
        };

        let closeProps = {
            type: 'default',
            icon: 'fa fa-times',
            square: true,
        };

        closeProps['onClick'] = () => {
            this.selected = [];
        };

        return (
            <div class="kyo-webpage__search">
                <div class="grid grid--row grid--middle grid--5">
                    <div class="col--flex-0-0">
                        <NButton {...deleteProps}>
                            { this.trans('Remove') }
                        </NButton>
                    </div>
                    <div class="col--flex-1-1">
                        { /* spacer */}
                    </div>
                    <div class="col--flex-0-0">
                        <NButton {...closeProps} />
                    </div>
                </div>
            </div>
        );
    },

    renderTree()
    {
        let treeProps = {
            items: this.items,
            selected: this.selected,
            group: ['menu'],
            allowGroups: ['menu', 'transaction'],
            itemHeight: 38,
            itemOffset: 26,
            scrollTopOnChange: false,
            disableMove: true,
            allowCurrent: true,
            renderSelect: true,
            renderExpand: true,
            //safezone: this.safezone,
        };

        treeProps['onUpdate:selected'] = (value) => {
            this.selected = value;
        }

        return (
            <NDraglist class="kyo-webpage__tree" {...treeProps}>
                { (props) => <KyoWebpageNode {...props} /> }
            </NDraglist>
        )
    },

    render()
    {
        let resizerProps = {
            minWidth: 320,
        };

        resizerProps['onUpdate:modelValue'] = () => {
            pi.Dom.find(window).fire('resize');
        }

        let loaderProps = {
            visible: this.load
        };

        return (
            <NResizer class="kyo-webpage" {...resizerProps}>
                <NLoader class="kyo-webpage__body" {...loaderProps}>
                    { this.ctor('renderSearch')() }
                    { this.ctor('renderTools')() }
                    { this.ctor('renderTree')() }
                </NLoader>
            </NResizer>
        );
    }

}
