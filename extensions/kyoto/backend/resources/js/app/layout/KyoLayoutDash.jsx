
import { Arr, Obj, Dom, Any, Event } from "@kizmann/pico-js";
import Fuse from 'fuse.js'

export default {

    name: 'KyoLayoutDash',

    computed: {

        results()
        {
            return this.fuse.search(this.search);
        }

    },

    data()
    {
        let keys = [
            {
                name: 'title',
                weight: 0.9
            },
            {
                name: 'description',
                weight: 0.3
            },
            {
                name: 'type',
                weight: 0.7
            },
            {
                name: 'tags',
                weight: 0.4
            }
        ];

        let options = {
            threshold: 0.5, distance: 300, keys
        };

        return {
            options, focus: false, search: '', index: 0
        };
    },

    beforeMount()
    {
        this.fuse = new Fuse(kyoto.dashes, this.options);
    },

    mounted()
    {
        Event.bind('KyoDash:update', (dashes) =>
            this.fuse.setCollection(dashes), this._.uid);

        Dom.find(window).on('keyup', this.onKeyup,
            this._.uid);
    },

    beforeUnmount()
    {
        Dom.find(window).on('keydown', null,
            this._.uid);
    },

    methods: {

        pushDash(dash)
        {
            if ( dash.callback ) {
                dash.callback(this.search);
            }

            this.onBlur();
        },

        pushCurrent()
        {
            if ( Any.isEmpty(this.results) ) {
                return;
            }

            let callback = Obj.get(this.results,
                `${this.index}.item.callback`);

            if ( callback ) {
                callback(this.search);
            }

            this.onBlur();
        },

        selectPrev()
        {
            this.index--;

            if ( this.index < 0 ) {
                this.index = this.results.length - 1;
            }

            let selector = `[data-index="${this.index}"]`;

            this.$refs.scrollbar.scrollIntoView(selector);
        },

        selectNext()
        {
            this.index++;

            if ( this.index > this.results.length - 1 ) {
                this.index = 0;
            }

            let selector = `[data-index="${this.index}"]`;

            this.$refs.scrollbar.scrollIntoView(selector);
        },

        onFocus()
        {
            this.$refs.input.focus();
            this.focus = true;
        },

        onBlur()
        {
            this.$refs.input.blur();
            this.index = 0;
            this.search = '';
            this.focus = false;
        },

        onInput(event)
        {
            this.search = event.target.value;
            this.index = 0;
            this.focus = true;
        },

        onKeydown(event)
        {
            if ( event.which === 13 ) {
                event.preventDefault();
                this.pushCurrent();
            }

            if ( event.which === 38 ) {
                event.preventDefault();
                this.selectPrev();
            }

            if ( event.which === 40 ) {
                event.preventDefault();
                this.selectNext();
            }
        },

        onKeyup(event)
        {
            if ( event.which !== 191 && event.which !== 192 ) {
                return;
            }

            let isInput = Dom.find(event.target)
                .closest('input,textarea,select,[contenteditable]');

            if ( isInput ) {
                return;
            }

            event.preventDefault();

            this.onFocus();
        },

        onPopover(value)
        {
            if ( ! value ) {
                return this.onBlur();
            }

            this.onFocus();
        }

    },

    renderInput()
    {
        let props = {
            value: this.search,
            onInput: this.onInput,
            onFocus: this.onFocus,
            onKeydown: this.onKeydown,
        };

        return (
            <div class="kyo-layout-dash__input">
                <input ref="input" value={this.search} type="text" {...props} />
            </div>
        );
    },

    renderDashItem(dash, index)
    {
        let classList = [
            'kyo-layout-dash__item'
        ];

        if ( this.index == index ) {
            classList.push('is-focus');
        }

        let props = {
            'data-index': index,
            'data-type': dash.type,
            onClick: () => this.pushDash(dash)
        };

        if ( ! Any.isEmpty(dash.icon) ) {
            props['data-icon'] = dash.icon;
        }

        return (
            <div class={classList} {...props}>
                <div class="kyo-layout-dash__type">
                    <span>{ dash.type }</span>
                </div>
                <div class="kyo-layout-dash__title">
                    <h4>{ dash.title }</h4><p>{ dash.description}</p>
                </div>
            </div>
        );
    },

    renderEmpty()
    {
        return (
            <div class="kyo-layout-dash__empty">
                ooops keine ergebnisse
            </div>
        );
    },

    renderInfo()
    {
        return (
            <div class="kyo-layout-dash__info">
                tipper mal was ein und schau was raus kommt!
            </div>
        );
    },

    renderItems()
    {
        if ( Any.isEmpty(this.search) ) {
            return this.ctor('renderInfo')();
        }

        if ( Any.isEmpty(this.results) ) {
            return this.ctor('renderEmpty')();
        }

        let results = Arr.filter(this.results, (dash) => {
            return ! dash.item.search || dash.item.search(this.search);
        });

        return Arr.each(results, (value, index) => {
            return this.ctor('renderDashItem')(value.item, index);
        });
    },

    renderDashes()
    {
        return (
            <NScrollbar ref="scrollbar" relative={true}>
                { this.ctor('renderItems')() }
            </NScrollbar>
        );
    },

    renderPopover()
    {
        let props = {
            modelValue: this.focus,
            type: 'dash',
            width: 400,
            multiClose: false,
            position: 'bottom-start',
            trigger: 'click',
        };

        props['onUpdate:modelValue'] = this.onPopover;

        return (
            <NPopover {...props}>
                { { raw: this.ctor('renderDashes') } }
            </NPopover>
        );
    },

    renderButton()
    {
        let props = {
            type: 'default',
            square: true,
            icon: 'fa fa-terminal'
        };

        return (
            <NButton {...props}></NButton>
        );
    },

    render()
    {
        let classList = [
            'kyo-layout-dash'
        ];

        if ( this.focus ) {
            classList.push('is-focus');
        }

        return (
            <div class={classList}>
                { this.ctor('renderButton')() }
                { this.ctor('renderInput')() }
                { this.ctor('renderPopover')() }
            </div>
        );
    }

}
