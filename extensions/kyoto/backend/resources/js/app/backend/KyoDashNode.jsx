import { Any } from "@kizmann/pico-js";

export default {

    name: 'KyoDashNode',

    inject: {

        KyoDash: {
            default: undefined
        }

    },

    props: {

        index: {
            required: true,
        },

        item: {
            required: true,
        },

    },

    renderType()
    {
        return (
            <div class="kyo-dash-node__type">
                <span>{this.item.type}</span>
            </div>
        );
    },

    renderInfo()
    {
        return (
            <div class="kyo-dash-node__info">
                <h4>{this.item.title}</h4>
                <p>{this.item.description}</p>
            </div>
        );
    },

    render()
    {
        let classList = [
            'kyo-dash-node'
        ];

        if ( this.KyoDash.index == this.index ) {
            classList.push('is-focus');
        }

        let divProps = {
            'data-index': this.index,
            'data-type': this.item.type,
        };

        if ( ! Any.isEmpty(this.item.icon) ) {
            divProps['data-icon'] = this.item.icon;
        }

        divProps['onClick'] = () => {
            this.KyoDash.pushDash(this.item);
        };

        return (
            <div class={classList} {...divProps}>
                {this.ctor('renderType')()}
                {this.ctor('renderInfo')()}
            </div>
        );
    },

}
