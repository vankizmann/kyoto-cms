Nano.Data.set('kyoto/page::page', {
    'NFormGroup:00': {
        props: {
            legend: Nano.Locale.trans('Page'),
            icon: 'fa fa-file'
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
                                    label: Nano.Locale.trans('Page')
                                },
                                content: {
                                    'NInput:00': {
                                        model: {
                                            path: 'page_id'
                                        }
                                    }
                                }
                            },
                        }
                    }
                }
            }
        }
    },

});
