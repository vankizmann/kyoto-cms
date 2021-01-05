export default {

    name: 'KyoUploads',

    inject: {
        KyoIndex: {
            fallback: undefined
        }
    },

    props: {

        size: {
            default()
            {
                return 'default';
            },
            type: [String]
        }

    },

    computed: {

        parent()
        {
            return this.KyoIndex.query.parent || null;
        }

    },

    data()
    {
        return {
            visible: false, text: null, filelist: []
        };
    },

    beforeMount()
    {
        this.text = this.changeText();
    },

    mounted()
    {
        this.Dom.find(document.body).on('drop',
            this.eventDrop, this._uid);

        this.Dom.find(document.body).on('dragenter',
            this.eventDragenter, this._uid);

        this.Dom.find(document.body).on('dragend',
            this.eventDragend, this._uid);

        this.Dom.find(document.body).on('dragover',
            this.eventDragover, this._uid);
    },

    beforeDestroy()
    {
        this.Dom.find(document.body).off('drop',
            null, this._uid);

        this.Dom.find(document.body).off('dragenter',
            null, this._uid);

        this.Dom.find(document.body).off('dragend',
            null, this._uid);

        this.Dom.find(document.body).off('dragover',
            null, this._uid);
    },

    methods: {

        eventDragenter(event)
        {
            if ( ! event.dataTransfer.files.length && ! event.dataTransfer.items.length ) {
                return;
            }

            event.preventDefault();
        },

        eventDragover(event)
        {
            if ( ! this.visible ) {
                return;
            }

            event.preventDefault();
        },

        eventDragend(event)
        {
            if ( ! this.visible ) {
                return;
            }

            event.preventDefault();
        },

        eventDrop(event)
        {
            if ( ! event.dataTransfer.files.length && ! event.dataTransfer.items.length ) {
                return;
            }

            event.preventDefault();

            if ( this.visible ) {
                return;
            }

            Nano.Obj.each(event.dataTransfer.files, this.addFile);

            if ( ! this.filelist.length ) {
                return;
            }

            this.visible = true;

            Nano.Any.delay(this.storeItem, 150);
        },

        addLegacy()
        {
            Nano.Obj.each(this.$refs.legacy.files, this.addFile);

            if ( ! this.filelist.length ) {
                return;
            }

            this.visible = true;

            Nano.Any.delay(this.storeItem, 150);
        },

        addFile(file)
        {
            this.filelist.push({
                id: Nano.UUID(), parent_id: this.parent, file: file
            });
        },

        changeText(callback = null)
        {
            if ( Nano.Any.isFunction(callback) ) {
                callback.call(this);
            }

            if ( Math.round(Math.random() * 4) === 1 ) {
                return 'Flashing :count files into the cloud ...';
            }

            if ( Math.round(Math.random() * 4) === 1 ) {
                return 'Pushing bits on the server ... :count files remaining';
            }

            if ( Math.round(Math.random() * 4) === 1 ) {
                return 'Only a few seconds remaining ... :count files';
            }

            return 'Flying in the cloud ... :count files are done';
        },

        storeItem()
        {
            if ( Nano.Any.isEmpty(this.filelist) ) {
                return;
            }

            let route = this.Route.get('/{locale}/kyoto/media/http/controllers/media/upload',
                this.$root.$data);

            this.cancelToken = this.$http.CancelToken.source();

            let options = {
                cancelToken: this.cancelToken.token
            };

            this.$http.post(route, Nano.Ajax.form(this.filelist[0]), options)
                .then(this.fetchDone, this.fetchDone);
        },

        fetchDone()
        {
            this.text = this.changeText(() => {
                Nano.Arr.removeIndex(this.filelist, 0);
            });

            if ( ! Nano.Any.isEmpty(this.filelist) ) {
                return Nano.Any.delay(this.storeItem, 100);
            }

            this.visible = false;

            Nano.Event.fire('media:refresh');
        }

    },

    render()
    {
        return (
            <div class="kyo-media__uploads">
                <NButton size={this.size} icon="fa fa-cloud-upload-alt" vOn:click={() => this.$refs.legacy.click()}>
                    {this.trans('Upload')}
                </NButton>
                <NModal type="upload" visible={this.visible} selector={false} closable={false} width="360px">
                    <div class="kyo-upload-animation">
                        { /* Cool animation here */}
                    </div>
                    <div class="kyo-upload-text">
                        { this.trans(this.text, { count: this.filelist.length }) }
                    </div>
                </NModal>
                <input ref="legacy" type="file" style="display: none !important;" vOn:change={this.addLegacy} multiple/>
            </div>
        );
    }

}
