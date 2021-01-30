import { Arr, Obj, Any, Event, UUID } from "@kizmann/pico-js";

export default {

    name: 'KyoUploads',

    inject: {
        KyoIndex: {
            fallback: undefined
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
            this.eventDrop, this._.uid);

        this.Dom.find(document.body).on('dragenter',
            this.eventDragenter, this._.uid);

        this.Dom.find(document.body).on('dragend',
            this.eventDragend, this._.uid);

        this.Dom.find(document.body).on('dragover',
            this.eventDragover, this._.uid);
    },

    beforeUnmount()
    {
        this.Dom.find(document.body).off('drop',
            null, this._.uid);

        this.Dom.find(document.body).off('dragenter',
            null, this._.uid);

        this.Dom.find(document.body).off('dragend',
            null, this._.uid);

        this.Dom.find(document.body).off('dragover',
            null, this._.uid);
    },

    methods: {

        eventDragenter(event)
        {
            let isEmpty = ! event.dataTransfer.files.length &&
                ! event.dataTransfer.items.length;

            if ( isEmpty ) {
                return;
            }

            event.preventDefault();
        },

        eventDragover(event)
        {
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
            let isEmpty = ! event.dataTransfer.files.length &&
                ! event.dataTransfer.items.length;

            if ( isEmpty ) {
                return;
            }

            event.preventDefault();

            if ( this.visible ) {
                return;
            }

            Obj.each(event.dataTransfer.files, this.addFile);

            if ( ! this.filelist.length ) {
                return;
            }

            this.visible = true;

            Any.delay(this.storeItem, 150);
        },

        addLegacy()
        {
            Obj.each(this.$refs.legacy.files, this.addFile);

            if ( ! this.filelist.length ) {
                return;
            }

            this.visible = true;

            Any.delay(this.storeItem, 150);
        },

        addFile(file)
        {
            this.filelist.push({
                id: UUID(), parent_id: this.parent, file: file
            });
        },

        changeText(callback = null)
        {
            if ( Any.isFunction(callback) ) {
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
            if ( Any.isEmpty(this.filelist) ) {
                return;
            }

            let route = this.Route.get('/{locale}/kyoto/media/http/controllers/media/upload',
                this.$root.$data);

            this.cancelToken = this.$http.CancelToken.source();

            let options = {
                cancelToken: this.cancelToken.token
            };

            let formData = Any.form(this.filelist[0]);

            this.$http.post(route, formData, options)
                .then(this.fetchDone, this.fetchDone);
        },

        fetchDone()
        {
            this.text = this.changeText(() => {
                Arr.removeIndex(this.filelist, 0);
            });

            if ( ! Any.isEmpty(this.filelist) ) {
                return Any.delay(this.storeItem, 100);
            }

            this.visible = false;

            Event.fire('media:refresh');
        }

    },

    render()
    {
        return (
            <div class="kyo-media__uploads">
                <NButton icon="fa fa-cloud-upload-alt" onClick={() => this.$refs.legacy.click()}>
                    {this.trans('Upload')}
                </NButton>
                <NModal vModel={this.visible} listen={false} closable={false} width="360px">
                    <div class="kyo-upload-animation">
                        { /* Cool animation here */}
                    </div>
                    <div class="kyo-upload-text">
                        { this.trans(this.text, { count: this.filelist.length }) }
                    </div>
                </NModal>
                <input ref="legacy" type="file" style="display: none !important;" onChange={this.addLegacy} multiple/>
            </div>
        );
    }

}
