pi.Data.set('kyoto/menu::redirect', {
    'NFormGroup:00': {
        $props: {
            label: pi.Locale.trans('Redirect'),
            icon: 'fa fa-directions'
        },
        content: {
            'div:00': {
                class: 'grid grid--row grid--wrap grid--30',
                content: {
                    'div:00': {
                        class: 'col--1-1 col--1-2@sm',
                        content: {
                            'NFormItem:00': {
                                $props: {
                                    label: pi.Locale.trans('URL')
                                },
                                content: {
                                    'NInput:00': {
                                        model: {
                                            path: 'option.url'
                                        }
                                    }
                                }
                            },
                        }
                    },
                    'div:10': {
                        class: 'col--1-1 col--1-2@sm',
                        content: {
                            'NFormItem:00': {
                                $props: {
                                    label: pi.Locale.trans('Menu')
                                },
                                content: {
                                    'NInput:00': {
                                        model: {
                                            path: 'option.redirect'
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    },

});
