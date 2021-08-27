import { Any } from "@kizmann/pico-js";

export default {

    name: 'KyoSearch',

    props: {

        value: {
            default()
            {
                return '';
            },
            type: [String]
        },

        debounce: {
            default()
            {
                return 800;
            },
            type: [Number]
        }

    },

    data()
    {
        return {
            tempValue: this.value
        }
    },

    render()
    {
        let inputProps = {
            modelValue: this.tempValue,
            icon: 'fa fa-search',
            iconPosition: 'before',
            placeholder: this.trans('Search')
        };

        inputProps['onKeydown'] = (event) => {
            if ( event.which === 13 ) {
                this.$emit('update:modelValue', this.tempValue = event.target.value);
            }
        }

        let buttonProps = {
            type: 'default',
            icon: 'fa fa-times',
            square: true,
        };

        if ( Any.isEmpty(this.tempValue) ) {
            buttonProps.disabled = true;
        }

        buttonProps['onClick'] = () => {
            this.$emit('update:modelValue', this.tempValue = '');
        };

        return (
            <div class="kyo-search">
                <div class="kyo-search__input">
                    <NInput {...inputProps} />
                </div>
                <div class="kyo-search__clear">
                    <NButton {...buttonProps} />
                </div>
            </div>
        )
    },

}
