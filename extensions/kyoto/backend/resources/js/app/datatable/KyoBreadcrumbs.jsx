import { Obj, Arr } from "@kizmann/pico-js";

export default {

    name: 'KyoBreadcrumbs',

    props: {

        showHome: {
            default() {
                return true;
            },
            type: [Boolean]
        }

    },

    computed: {

        menu() {
            return Obj.get(this.$route, 'meta.menu', {});
        },

        root() {
            return Obj.get(this.$route, 'meta.root', {});
        }

    },

    watch: {

        '$route': function () {
            this.getCascade();
        }
    },

    data()
    {
        return {
            cascade: []
        };
    },

    methods: {

        getCascade() {
            Arr.recursive(this.root, 'children',
                this.findCascade, []);
        },

        findCascade(value, cascade = [], ...args)
        {
            if ( this.menu.id === value.id ) {
                this.cascade = [...cascade, value];
            }
        },

    },

    mounted()
    {
        this.getCascade();
    },

    renderItemSpan(item)
    {
        return (
            <span>
                {this.trans(item.title)}
            </span>
        );
    },

    renderItemLink(item)
    {
        return (
            <router-link to={item.route}>
                {this.trans(item.title)}
            </router-link>
        );
    },

    renderItem(item, index)
    {
        let allowLink = this.cascade.length > index + 1 &&
            ! item.route.match(/:/);

        return (
            <li>
                {this.ctor(allowLink ? 'renderItemLink' : 'renderItemSpan')(item)}
            </li>
        );
    },

    render()
    {
        return (
            <div class="kyo-breadcrumbs">
                <ul>
                    {Arr.each(this.cascade, this.ctor('renderItem'))}
                </ul>
            </div>
        );
    }

}
