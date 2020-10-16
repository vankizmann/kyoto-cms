Nano.Data.set('kyoto/menu::vue', {
    'NFormGroup:00': {
        props: {
            legend: Nano.Locale.trans('Vue'),
            icon: 'fab fa-vuejs'
        },
        content: {
            'div:00': {
                class: 'grid grid--row grid--wrap grid--30',
                content: {
                    'div:00': {
                        class: 'col--1-1 col--1-2@sm',
                        content: {
                            'NFormItem:00': {
                                props: {
                                    label: Nano.Locale.trans('Component')
                                },
                                content: {
                                    'NInput:00': {
                                        model: {
                                            path: 'option.component'
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
                                props: {
                                    label: Nano.Locale.trans('Menu')
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
