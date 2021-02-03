import { Any, Locale } from "@kizmann/pico-js";
import NInfoField from "@kizmann/nano-ui/src/info/src/info-field/info-field";

export default {

    name: 'NInfoFieldHide',

    extends: NInfoField,

    render()
    {
        if ( this.column.cslo('default', this) ) {
            return (
                <div>{ this.column.$slots.default(this) }</div>
            );
        }

        let classList = [];

        if ( this.input === 0 ) {
            classList.push('is-visible');
        }

        if ( this.input === 1 ) {
            classList.push('is-hidden');
        }

        let text = 'Unknown';

        if ( this.input === 0 ) {
            text = 'Visible';
        }

        if ( this.input === 1 ) {
            text = 'Hidden';
        }

        return (
            <div class={classList}>
                <span>{ Locale.trans(text) }</span>
            </div>
        );
    }

}
