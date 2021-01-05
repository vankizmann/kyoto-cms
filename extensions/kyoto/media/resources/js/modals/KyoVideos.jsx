export default {

    name: 'KyoVideos',

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
            load: false, visible: false, clipboard: null, video: null
        };
    },

    watch: {

        'clipboard': function () {
            this.resolveVideo();
        }

    },

    mounted()
    {
        this.Dom.find(window).on('focus',
            this.eventFocus, this._uid);
    },

    beforeDestroy()
    {
        this.Dom.find(window).off('focus',
            null, this._uid);
    },

    methods: {

        eventFocus(event)
        {
            navigator.clipboard.readText().then((data) => {
                if ( data.match(/^https?:\/\//) ) {
                    this.clipboard = data;
                }
            });
        },

        resolveVideo()
        {
            this.video = null;

            let youtube = this.clipboard.match(/^https?:\/\/(www\.)?youtube\.[a-z]{2,3}\/watch\?v=([^\&]+)/);

            if ( youtube ) {
                this.video = { file: Nano.Arr.last(youtube), type: 'video/youtube' };
            }

            let vimeo = this.clipboard.match(/^https?:\/\/(www\.)?vimeo\.[a-z]{2,3}\/([^\&\?]+)/);

            if ( vimeo ) {
                this.video = { file: Nano.Arr.last(vimeo), type: 'video/vimeo' };
            }
        },

        storeItem()
        {
            if ( Nano.Any.isEmpty(this.video) ) {
                return;
            }

            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get('/{locale}/kyoto/media/http/controllers/media/store',
                this.$root.$data);

            let data = Nano.Obj.assign({}, this.video, {
                id: Nano.UUID(), parent_id: this.parent
            });

            this.$http.post(route, data, options)
                .then(this.fetchDone, this.fetchDone);
        },

        fetchDone()
        {
            this.visible = false;

            Nano.Event.fire('media:refresh');
        }

    },

    renderPreview()
    {
        if ( this.video && this.video.type === 'video/youtube' ) {
            return (<iframe src={`https://www.youtube.com/embed/${this.video.file}`} frameborder="0"></iframe>);
        }

        if ( this.video && this.video.type === 'video/vimeo' ) {
            return (<iframe src={`https://player.vimeo.com/video/${this.video.file}`} frameborder="0"></iframe>);
        }

        return null;
    },

    render()
    {
        return (
            <div class="kyo-media__videos">
                <NButton size={this.size} icon="fa fa-photo-video" vOn:click={() => this.visible = true}>
                    {this.trans('Webvideo')}
                </NButton>
                <NModal type="video" vModel={this.visible} selector={false} closable={true} width="800px">
                    <NLoader visible={this.load}>
                        <div class="kyo-video-preview">
                            { this.ctor('renderPreview')() }
                        </div>
                        <div class="kyo-video-text">
                            <div class="grid grid--row grid--10">
                                <div class="col--flex-1-1">
                                    <NInput vModel={this.clipboard}></NInput>
                                </div>
                                <div class="col--flex-0-0">
                                    <NButton disabled={!this.video} vOn:click={this.storeItem}>
                                        { this.trans('Save video') }
                                    </NButton>
                                </div>
                            </div>
                        </div>
                    </NLoader>
                </NModal>
            </div>
        );
    }

}
