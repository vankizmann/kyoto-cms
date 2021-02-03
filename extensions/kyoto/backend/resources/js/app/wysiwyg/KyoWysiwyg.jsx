import { Arr, Any, Dom } from "@kizmann/pico-js";
import Squire from "squire-rte";

export default {

    name: 'KyoWysiwyg',

    props: {

        modelValue: {
            default()
            {
                return '';
            },
            type: [String]
        }

    },

    data()
    {
        return { height: 0 };
    },

    mounted()
    {
        let options = {
            blockTag: 'P',
            sanitizeToDOMFragment: (html) => {

                let result = DOMPurify.sanitize(html, {
                    ALLOWED_TAGS: [
                        'a', 'p', 'b', 'q', 'i', 'u', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'ul', 'ol', 'li'
                    ],
                    ALLOWED_ATTR: [
                        'href', 'target', 'class'
                    ],
                    ALLOW_UNKNOWN_PROTOCOLS: false,
                    WHOLE_DOCUMENT: false,
                    RETURN_DOM: true,
                    RETURN_DOM_FRAGMENT: true
                });

                let frags = new DocumentFragment(), buffer = [];

                for (let i = 0; i < result.childNodes.length; i++) {

                    let el = result.childNodes[i];

                    if ( el.tagName !== 'P' ) {
                        buffer.push(el)
                    } else {

                        if ( buffer.length ) {
                            let parent = Dom.make('p');

                            Arr.each(buffer, (sub) => {
                                parent.append(sub);
                            });

                            frags.append(parent.get(0));
                        }

                        frags.append(el);

                    }
                }

                if ( buffer.length ) {
                    let parent = Dom.make('p');

                    Arr.each(buffer, (sub) => {
                        parent.append(sub);
                    });

                    frags.append(parent.get(0));
                }

                return frags;
            },
        }

        this.squire = new Squire(this.$refs.editor, options)
            .setHTML(this.modelValue);

        Dom.find(document).on('keydown', (event) => {
            if ( event.which === 91 ) {
                Dom.find(this.$refs.editor).attr('contenteditable', false);
            }
        });

        Dom.find(document).on('keyup', (event) => {
            if ( event.which === 91 ) {
                Dom.find(this.$refs.editor).attr('contenteditable', true);
            }
        });

        this.squire.addEventListener('input', this.onInput)
    },

    methods: {

        onInput(event)
        {
            this.$emit('update:modelValue', this.squire.getHTML());
        },

        setBold()
        {
            if ( ! this.squire.hasFormat('b') ) {
                return this.squire.bold();
            }

            this.squire.removeBold();
        },

        setItalic()
        {
            if ( ! this.squire.hasFormat('i') ) {
                return this.squire.italic();
            }

            this.squire.removeItalic();
        },

        setUnderline()
        {
            if ( ! this.squire.hasFormat('u') ) {
                return this.squire.underline();
            }

            this.squire.removeUnderline();
        },

        setTextLeft()
        {
            this.squire.modifyBlocks((frag) => {

                let el = Dom.find(frag);

                el.childs().each((child) => {
                    Dom.find(child).removeClass('text-center text-right');
                    Dom.find(child).addClass('text-left');
                });

                return el.get(0);
            });

            Any.delay(() => this.squire.focus(), 100);
        },

        setTextCenter()
        {
            this.squire.modifyBlocks((frag) => {

                let el = Dom.find(frag);

                el.childs().each((child) => {
                    Dom.find(child).removeClass('text-left text-right');
                    Dom.find(child).addClass('text-center');
                });

                return el.get(0);
            });

            Any.delay(() => this.squire.focus(), 100);
        },

        setTextRight()
        {
            this.squire.modifyBlocks((frag) => {

                let el = Dom.find(frag);

                el.childs().each((child) => {
                    Dom.find(child).removeClass('text-left text-center');
                    Dom.find(child).addClass('text-right');
                });

                return el.get(0);
            });

            Any.delay(() => this.squire.focus(), 100);
        },

        setTag(tag)
        {
            this.squire.modifyBlocks((frag) => {

                let el = Dom.find(frag), cc = new DocumentFragment();

                el.childs().each((child) => {

                    let repl = Dom.make(tag);

                    repl.html(child.innerHTML);

                    repl.appendTo(cc);
                });

                return cc;
            });

            Any.delay(() => this.squire.focus(), 100);
        },

    },

    render()
    {
        let classList = [
            'kyo-wysiwyg',
        ];

        let props = {
            value: this.modelValue,
            placeholder: this.trans('Enter your text'),
            // onInput: this.onInput
        };

        let style = {};

        return (
            <div class={classList}>
                <div class="grid grid--row grid--5" style="margin-top: -10px; margin-bottom: 20px;">
                    <div class="col--flex-0-0">
                        <NButton size="sm" type="wysiwyg" icon="fa fa-paragraph">
                            Paragraph
                        </NButton>
                        <NPopover trigger="click" position="bottom-start">
                            <NPopoverOption icon="fa fa-heading-h1" onMousedown={() => this.setTag('p')}>
                                Paragraph
                            </NPopoverOption>
                            <NPopoverOption icon="fa fa-heading-h1" onMousedown={() => this.setTag('h1')}>
                                Headline H1
                            </NPopoverOption>
                            <NPopoverOption icon="fa fa-heading-h2" onMousedown={() => this.setTag('h2')}>
                                Headline H2
                            </NPopoverOption>
                            <NPopoverOption icon="fa fa-heading-h3" onMousedown={() => this.setTag('h3')}>
                                Headline H3
                            </NPopoverOption>
                            <NPopoverOption icon="fa fa-heading-h4" onMousedown={() => this.setTag('h4')}>
                                Headline H4
                            </NPopoverOption>
                            <NPopoverOption icon="fa fa-heading-h5" onMousedown={() => this.setTag('h5')}>
                                Headline H5
                            </NPopoverOption>
                            <NPopoverOption icon="fa fa-heading-h6" onMousedown={() => this.setTag('h6')}>
                                Headline H6
                            </NPopoverOption>
                        </NPopover>
                    </div>
                    <div class="col--flex-0-0">
                        <NButtonGroup size="sm">
                            <NButton size="sm" type="wysiwyg" icon="fa fa-bold" onClick={this.setBold} />
                            <NButton size="sm" type="wysiwyg" icon="fa fa-italic" onClick={this.setItalic} />
                            <NButton size="sm" type="wysiwyg" icon="fa fa-underline" onClick={this.setUnderline} />
                        </NButtonGroup>
                    </div>
                    <div class="col--flex-0-0">
                        <NButtonGroup size="sm">
                            <NButton size="sm" type="wysiwyg" icon="fa fa-align-left" onClick={this.setTextLeft} />
                            <NButton size="sm" type="wysiwyg" icon="fa fa-align-center" onClick={this.setTextCenter} />
                            <NButton size="sm" type="wysiwyg" icon="fa fa-align-right" onClick={this.setTextRight} />
                        </NButtonGroup>
                    </div>
                    <div class="col--flex-0-0">
                        <NButtonGroup size="sm">
                            <NButton size="sm" type="wysiwyg" icon="fa fa-list-ul" />
                            <NButton size="sm" type="wysiwyg" icon="fa fa-list-ol" />
                        </NButtonGroup>
                    </div>
                    <div class="col--flex-0-0">
                        <NButton size="sm" type="wysiwyg" icon="fa fa-link">Insert link</NButton>
                        <NModal width="420px">
                            <NForm>
                                <NFormItem label={this.trans('URL')}>
                                    <NInput></NInput>
                                </NFormItem>
                                <NFormItem label={this.trans('Target')}>
                                    <NSwitch>{this.trans('Open in new window')}</NSwitch>
                                </NFormItem>
                            </NForm>
                        </NModal>
                    </div>
                </div>
                <div class="kyo-squire" ref="editor"></div>
            </div>
        )
    }

}
