import { Arr, Obj, Str, Any, Dom } from "@kizmann/pico-js";
import { h, resolveComponent } from "vue";
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
        },

        size: {
            default()
            {
                return 'sm';
            },
            type: [String]
        },

        type: {
            default()
            {
                return 'wysiwyg';
            },
            type: [String]
        },

        mapping: {
            default()
            {
                return {};
            },
            type: [Object]
        },

        renderList: {
            default()
            {
                return [
                    'tags', ['b', 'i', 'u'], ['atl', 'atc', 'atr'], ['ul', 'ol'], 'a'
                ]
            },
            type: [Array]
        },

        renderTags: {
            default()
            {
                return ['p', 'h2', 'h3', 'h4']
            },
            type: [Array]
        },

        blockTag: {
            default()
            {
                return 'P';
            },
            type: [String]
        },

        allowedAttr: {
            default()
            {
                return [
                    'href', 'target', 'class'
                ];
            },
            type: [Array]
        },

        inlineTags: {
            default()
            {
                return [
                    '#text', 'a', 'b', 'q', 'i', 'u', 'li'
                ];
            },
            type: [Array]
        },

        blockTags: {
            default()
            {
                return [
                    'ul', 'ol', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
                ]
            },
            type: [Array]
        }

    },

    watch: {
        modelValue: function (value) {
            if ( value !== this.squire.getHTML() ) {
                this.squire.setHTML(value);
            }
        }
    },

    data()
    {
        let mapping = {
            'b': 'KyoWysiwygNative',
            'i': 'KyoWysiwygNative',
            'u': 'KyoWysiwygNative'
        };

        let texts = {
            'p': 'Paragraph',
            'h1': 'Headline 1',
            'h2': 'Headline 2',
            'h3': 'Headline 3',
            'h4': 'Headline 4',
            'h5': 'Headline 5',
            'h6': 'Headline 6',
            'b': 'Bold',
            'i': 'Italic',
            'u': 'Underline',
            'a': 'Insert link',
            'atl': 'Left',
            'atc': 'Center',
            'atr': 'Right',
            'ul': 'Unordered list',
            'ol': 'Ordered list',
        };

        let icons = {
            'p': 'fa fa-paragraph',
            'h1': 'fa fa-heading',
            'h2': 'fa fa-heading',
            'h3': 'fa fa-heading',
            'h4': 'fa fa-heading',
            'h5': 'fa fa-heading',
            'h6': 'fa fa-heading',
            'b': 'fa fa-bold',
            'i': 'fa fa-italic',
            'u': 'fa fa-underline',
            'a': 'fa fa-link',
            'atl': 'fa fa-align-left',
            'atc': 'fa fa-align-center',
            'atr': 'fa fa-align-right',
            'ul': 'fa fa-list-ul',
            'ol': 'fa fa-list-ol',
        };

        return { mapping, texts, icons, path: [] };
    },

    provide()
    {
        return {
            KyoWysiwyg: this
        };
    },

    mounted()
    {
        let options = {
            blockTag: this.blockTag,
            sanitizeToDOMFragment: this.sanatizeHtml,
        }

        this.squire = new Squire(this.$refs.editor, options)
            .setHTML(this.modelValue);

        Dom.find(this.$refs.editor).on('mousedown',
            this.onMousedown, this._.uid);

        Dom.find(this.$refs.editor).on('mouseup',
            this.onMouseup, this._.uid);

        this.squire.addEventListener('input',
            this.onInput);

        this.squire.addEventListener('pathChange',
            this.onPathchange);
    },

    beforeUnmount()
    {
        Dom.find(this.$refs.editor).off('mousedown',
            null, this._.uid);

        Dom.find(this.$refs.editor).off('mouseup',
            null, this._.uid);

        this.squire.destroy();
    },

    methods: {

        onMousedown(event)
        {
            let el = Dom.find(event.target).closest('a');

            if ( ! el || ! Arr.has(window.keyMods, 91) ) {
                return;
            }

            Dom.find(el).attr('contenteditable', false);
        },

        onMouseup(event)
        {
            let el = Dom.find(event.target).closest('a');

            if ( ! el || ! Arr.has(window.keyMods, 91) ) {
                return;
            }

            Any.delay(() => Dom.find(el).attr('contenteditable', null));
        },

        onPathchange()
        {
            let path = this.squire.getPath();

            if ( path === '(selection)' ) {
                return this.path = [];
            }

            this.path = Arr.each(path.split('>'), (tag) => {
                return Str.lower(tag);
            });
        },

        onInput(event)
        {
            this.$emit('update:modelValue', this.squire.getHTML());

            Any.delay(this.onPathchange, 100);
        },

        wrapFragments(fragments)
        {
            let finalFrags = new DocumentFragment();

            let inlineFrags = [];

            let appendFrags = () => {

                if ( ! inlineFrags.length ) {
                    return;
                }

                let wrap = Dom.make('p');

                Arr.each(inlineFrags,
                    (el) => wrap.append(el));

                finalFrags.append(wrap.get(0));

                inlineFrags = [];
            }

            let nodes = Array.prototype.slice
                .call(fragments.childNodes);

            Arr.each(nodes, (el) => {

                let tag = el.tagName && el.tagName
                    .toLowerCase();

                if ( ! Arr.has(this.blockTags, tag) ) {
                    return inlineFrags.push(el);
                }

                if ( inlineFrags.length ) {
                    appendFrags();
                }

                finalFrags.append(el);
            });

            appendFrags();

            return finalFrags;
        },

        sanatizeHtml(html)
        {
            let options = {
                ALLOWED_TAGS: Arr.merge(this.inlineTags, this.blockTags),
                ALLOWED_ATTR: this.allowedAttr,
                ALLOW_UNKNOWN_PROTOCOLS: false,
                WHOLE_DOCUMENT: false,
                RETURN_DOM: true,
                RETURN_DOM_FRAGMENT: true
            };

            let fragments = DOMPurify.sanitize(html, options);

            return this.wrapFragments(fragments);
        },

        setClass(append, remove = [])
        {
            this.squire.modifyBlocks((frag) => {

                let el = Dom.find(frag);

                el.childs().each((child) => {
                    Dom.find(child).removeClass(remove);
                    Dom.find(child).addClass(append);
                });

                return el.get(0);
            });

            Any.delay(() => this.squire.focus(), 100);
        },

        setTag(tag)
        {
            this.squire.modifyBlocks((frag) => {

                let finalFrags = new DocumentFragment();

                Dom.find(frag).childs().each((child) => {

                    let replFrag = Dom.make(tag, {
                        classList: child.getAttribute('class')
                    });

                    replFrag.html(child.innerHTML);

                    replFrag.appendTo(finalFrags);
                });

                return finalFrags;
            });

            Any.delay(() => this.squire.focus(), 100);
        },

        setTextLeft()
        {
            this.setClass(['text-left'],
                ['text-center', 'text-right']);
        },

        setTextCenter()
        {
            this.setClass(['text-center'],
                ['text-left', 'text-right']);
        },

        setTextRight()
        {
            this.setClass(['text-right'],
                ['text-left', 'text-center']);
        },

    },

    renderTags()
    {
        let options = Arr.each(this.renderTags, (tag) => {
            return (
                <NPopoverOption icon={this.icons[tag]} onMousedown={() => this.setAny(tag)}>
                    { this.trans(this.texts[tag]) }
                </NPopoverOption>
            );
        })

        return (
            <div class="col--flex-0-0">
                <NButton size={this.size} type="wysiwyg" icon="fa fa-font">
                    { this.trans('Text') }
                </NButton>
                <NPopover trigger="click" position="bottom-start">
                    { options }
                </NPopover>
            </div>
        );
    },

    renderGroup(group)
    {
        let options = Arr.each(group, (tag) => {
            return this.ctor('renderElement')('NButton', tag, false);
        });

        return (
            <div class="col--flex-0-0">
                <NButtonGroup size={this.size}>{ options }</NButtonGroup>
            </div>
        );
    },

    renderSingle(tag)
    {
        return (
            <div class="col--flex-0-0">
                { this.ctor('renderElement')('NButton', tag, true) }
            </div>
        );
    },

    renderElement(el, tag, text = true)
    {
        let map = Obj.get(this.mapping, tag);

        if ( ! map ) {
            return null;
        }

        let component = resolveComponent(map);

        return h(component, { el, tag, text });
    },

    renderToolbar()
    {
        return Arr.each(this.renderList, (tag) => {

            if ( Any.isString(tag) ) {
                return this.ctor('renderSingle')(tag);
            }

            return this.ctor('renderGroup')(tag);
        });
    },

    render()
    {
        let classList = [
            'kyo-wysiwyg',
        ];

        return (
            <div class={classList}>
                <div class="grid grid--row grid--5" style="margin-top: -10px; margin-bottom: 20px;">
                    { this.ctor('renderToolbar')() }
                </div>
                <div class="kyo-squire" ref="editor"></div>
            </div>
        )
    }

}
