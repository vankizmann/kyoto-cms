export default {

    name: 'KyoMediaSelect',

    props: {

        modelValue: {
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
                this.items = pi.Arr.clone(this.modelValue);
            }
        }

    },

    methods: {

        applyItems()
        {
            this.visible = false;

            this.$emit('update:modelValue', this.items);
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

        if ( this.limit && props.value.index >= this.limit ) {
            classList.push('kyo-media-list-item--off');
        }

        let buttonProps = {
            type: 'danger',
            size: 'xs',
            square: true,
            icon: nano.Icons.times
        }

        return (
            <div class={classList}>
                <div class="kyo-media-list-item__image">
                    <img src={ props.item.urls['square/sm'] } />
                </div>
                <div class="kyo-media-list-item__title">
                    <span>{ props.item.title }</span>
                </div>
                <div class="kyo-media-list-item__meta">
                    <span>{ props.item.type }</span>
                </div>
                <div class="kyo-media-list-item__delete">
                    <NButton {...buttonProps} onClick={props.remove} />
                </div>
            </div>
        );
    },

    renderIconNode(props)
    {
        let classList = [
            'kyo-media-list-item'
        ];

        if ( this.limit && props.value.index >= this.limit ) {
            classList.push('kyo-media-list-item--off');
        }

        let buttonProps = {
            type: 'danger',
            size: 'xs',
            square: true,
            icon: nano.Icons.times
        }

        return (
            <div class={classList}>
                <div class="kyo-media-list-item__icon" data-type={props.value.type}>
                    <span>{ props.item.file.replace(/^(.*?)\./, '') }</span>
                </div>
                <div class="kyo-media-list-item__title">
                    <span>{ props.item.title }</span>
                </div>
                <div class="kyo-media-list-item__meta">
                    <span>{ props.item.type }</span>
                </div>
                <div class="kyo-media-list-item__delete">
                    <NButton {...buttonProps} onClick={props.remove} />
                </div>
            </div>
        );
    },

    renderFolderNode(props)
    {
        let classList = [
            'kyo-media-list-item'
        ];

        if ( this.limit && props.value.index >= this.limit ) {
            classList.push('kyo-media-list-item--off');
        }

        let buttonProps = {
            type: 'danger',
            size: 'xs',
            square: true,
            icon: nano.Icons.times
        }

        return (
            <div class={classList}>
                <div class="kyo-media-list-item__icon" data-type={props.item.type}>
                    <span>{ props.item.count }</span>
                </div>
                <div class="kyo-media-list-item__title">
                    <span>{ props.item.title }</span>
                </div>
                <div class="kyo-media-list-item__meta">
                    <span>{ props.item.type }</span>
                </div>
                <div class="kyo-media-list-item__delete">
                    <NButton {...buttonProps} onClick={props.remove} />
                </div>
            </div>
        );
    },

    renderNode(props)
    {
        if ( props.item.type === 'system/folder' ) {
            return this.ctor('renderFolderNode')(props);
        }

        if ( ! pi.Any.isEmpty(props.item.view) ) {
            return this.ctor('renderViewNode')(props);
        }

        return this.ctor('renderIconNode')(props);
    },

    renderList()
    {
        let draglistProps = {
            items: this.items,
            itemHeight: 100,
            uniqueProp: 'uid',
            transformDrop: this.transformDrop,
            allowDrop: this.allowDrop,
            safezone: (height) => height * 0.51,
            'onUpdate:items': (value) => this.items = value
        };

        return (
            <div class="kyo-media-list">
                <NDraglist {...draglistProps}>
                    {{ default: this.ctor('renderNode') }}
                </NDraglist>
                <NButton class="kyo-media-list__apply" onClick={this.applyItems}>
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
                <NButton>
                    { this.trans('Select files') }
                </NButton>
                <NModal vModel={this.visible} type="media" width="100%" height="100%">
                    {{ raw: () => [this.ctor('renderGrid')(), this.ctor('renderList')()] }}
                </NModal>
            </div>
        );
    }

}
