import { transform } from "lodash";

export default {

    name: 'KyoUploads',

    data()
    {
        return {
            visible: false, text: null, queue: -1, filelist: []
        };
    },

    beforeMount()
    {
        this.changeText();
    },

    mounted()
    {
        this.Dom.find(document.body).on('drop',
            this.eventDrop);

        this.Dom.find(document.body).on('dragenter',
            this.eventDragenter);

        this.Dom.find(document.body).on('dragend',
            this.eventDragend);

        this.Dom.find(document.body).on('dragover',
            this.eventDragover);
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

            this.visible = true;

            this.Obj.each(event.dataTransfer.files, this.addFile);

            if ( this.queue !== -1 ) {
                return;
            }

            this.storeItem();
        },

        addFile(file)
        {
            this.filelist.push({ id: this.UUID(), file: file });
        },

        changeText()
        {
            let messages = [
                'Only a few seconds remaining ... :count files',
                'Flashing :count files into the cloud ...',
                'Pushing bits on the server ... :count files remaining',
                'Do, do, do ... only a few time units until :count files are done'
            ];

            this.text = messages[Math.round(Math.random() * (messages.length - 1))];
        },

        storeItem()
        {
            this.changeText();

            if ( Nano.Any.isEmpty(this.filelist) ) {
                return;
            }

            let route = this.Route.get('/{locale}/kyoto/media/http/controllers/media/upload',
                this.$root.$data);

            this.$http.post(route, Nano.Ajax.form(this.filelist[0]))
                .then(this.fetchDone, this.fetchError);

            Nano.Arr.removeIndex(this.filelist, 0);
        },

        fetchDone()
        {
            if ( ! Nano.Any.isEmpty(this.filelist) ) {
                return Nano.Any.delay(this.storeItem, 1000);
            }

            this.visible = false;

            Nano.Event.fire('media:refresh');
        },

        fetchError()
        {
            this.visible = false;
        }

    },

    render()
    {
        return (
            <NModal type="upload" visible={this.visible} selector={false} closable={false} width="360px">
                <div class="kyo-upload-animation">
                    { /* Cool animation here */}
                </div>
                <div class="kyo-upload-text">
                    { this.trans(this.text, { count: this.filelist.length }) }
                </div>
            </NModal>
        );
    }

}
