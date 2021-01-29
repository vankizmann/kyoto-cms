export default {

    name: 'KyoMediaSelect',

    props: {

        value: {
            default()
            {
                return [];
            },
            type: [Array]
        },

        allowed: {
            default()
            {
                return [];
            },
            type: [Array]
        },

        limit: {
            default()
            {
                return 0;
            },
            type: [Number]
        }

    },

    computed: {

        patterns()
        {
            return pi.Arr.map(this.allowed, (item) => {
                return new RegExp('^' + item.replace('/', '\\/').replace('*', '[^\\/]+') + '$');
            });
        }

    },

    data()
    {
        return {
            visible: false, items: []
        }
    },

    watch: {

        'visible': function () {
            if ( this.visible ) {
                this.items = pi.Arr.clone(this.value);
            }
        }

    },

    methods: {

        applyItems()
        {
            this.visible = false;

            this.$emit('input', this.items);
        },

        transformDrop(source)
        {
            return pi.Obj.assign(source, {
                uid: pi.UUID()
            });
        },

        allowDrop(source)
        {
            if ( pi.Any.isEmpty(this.allowed) ) {
                return true;
            }

            let rainbow = pi.Arr.each(this.patterns, (pattern) => {
                return !! source.item.type.match(pattern);
            });

            return pi.Arr.has(rainbow, true);
        }

    },

    renderViewNode(props)
    {
        let classList = [
            'kyo-media-list-item'
        ];

        if ( this.limit && props.index > this.limit ) {
            classList.push('kyo-media-list-item--off');
        }

        let buttonProps = {
            type: 'danger',
            size: 'mini',
            square: true,
            icon: this.icons.times
        }

        return (
            <div class={classList}>
                <div class="kyo-media-list-item__image">
                    <img src={ props.value.urls['square/sm'] } />
                </div>
                <div class="kyo-media-list-item__title">
                    <span>{ props.value.title }</span>
                </div>
                <div class="kyo-media-list-item__meta">
                    <span>{ props.value.type }</span>
                </div>
                <div class="kyo-media-list-item__delete">
                    <NButton props={buttonProps} vOn:click={props.remove} />
                </div>
            </div>
        );
    },

    renderIconNode(props)
    {
        let classList = [
            'kyo-media-list-item'
        ];

        if ( this.limit && props.index > this.limit ) {
            classList.push('kyo-media-list-item--off');
        }

        let buttonProps = {
            type: 'danger',
            size: 'mini',
            square: true,
            icon: this.icons.times
        }

        return (
            <div class={classList}>
                <div class="kyo-media-list-item__icon" data-type={props.value.type}>
                    <span>{ props.value.file.replace(/^(.*?)\./, '') }</span>
                </div>
                <div class="kyo-media-list-item__title">
                    <span>{ props.value.title }</span>
                </div>
                <div class="kyo-media-list-item__meta">
                    <span>{ props.value.type }</span>
                </div>
                <div class="kyo-media-list-item__delete">
                    <NButton props={buttonProps} vOn:click={props.remove} />
                </div>
            </div>
        );
    },

    renderFolderNode(props)
    {
        let classList = [
            'kyo-media-list-item'
        ];

        if ( this.limit && props.index > this.limit ) {
            classList.push('kyo-media-list-item--off');
        }

        let buttonProps = {
            type: 'danger',
            size: 'mini',
            square: true,
            icon: this.icons.times
        }

        return (
            <div class={classList}>
                <div class="kyo-media-list-item__icon" data-type={props.value.type}>
                    <span>{ props.value.count }</span>
                </div>
                <div class="kyo-media-list-item__title">
                    <span>{ props.value.title }</span>
                </div>
                <div class="kyo-media-list-item__meta">
                    <span>{ props.value.type }</span>
                </div>
                <div class="kyo-media-list-item__delete">
                    <NButton props={buttonProps} vOn:click={props.remove} />
                </div>
            </div>
        );
    },

    renderNode(props)
    {
        if ( props.value.type === 'system/folder' ) {
            return this.ctor('renderFolderNode')(props);
        }

        if ( ! pi.Any.isEmpty(props.value.view) ) {
            return this.ctor('renderViewNode')(props);
        }

        return this.ctor('renderIconNode')(props);
    },

    renderList()
    {
        let draglistProps = {
            items: this.items,
            viewportHeight: true,
            itemHeight: 100,
            uniqueProp: 'uid',
            transformDrop: this.transformDrop,
            allowDrop: this.allowDrop,
            renderNode: this.ctor('renderNode')
        };

        let draglistEvents = {
            'input': (value) => this.items = value
        };

        return (
            <div class="kyo-media-list">
                <NDraglist props={draglistProps} on={draglistEvents}>
                    { /* Draglist */ }
                </NDraglist>
                <NButton class="kyo-media-list__apply" vOn:click={this.applyItems}>
                    { this.trans('Apply') }
                </NButton>
            </div>
        );
    },

    renderGrid()
    {
        return (
            <KyoMedias class="kyo-media-grid" navigation={false} />
        );
    },

    render()
    {
        return (
            <div>
                <NButton vOn:click={() => this.visible = true}>
                    { this.trans('Select files') }
                </NButton>
                <NModal vModel={this.visible} selector={false} raw={true} type="media" width="100%" height="100%">
                    { this.ctor('renderGrid')() }
                    { this.ctor('renderList')() }
                </NModal>
            </div>
        );
    }

}
