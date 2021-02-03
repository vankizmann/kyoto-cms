import { Locale } from "@kizmann/pico-js";
import NInfoField from "@kizmann/nano-ui/src/info/src/info-field/info-field";

export default {

    name: 'NInfoFieldState',

    extends: NInfoField,

    render()
    {
        if ( this.column.cslo('default', this) ) {
            return (
                <div>{ this.column.$slots.default(this) }</div>
            );
        }

        let classList = [];

        if ( this.input === 1 ) {
            classList.push('is-enabled');
        }

        if ( this.input === 0 ) {
            classList.push('is-disabled');
        }

        if ( this.input === -1 ) {
            classList.push('is-deleted');
        }

        if ( this.input === 2 ) {
            classList.push('is-archived');
        }

        let text = 'Unknown';

        if ( this.input === 1 ) {
            text = 'Enabled';
        }

        if ( this.input === 0 ) {
            text = 'Disabled';
        }

        if ( this.input === -1 ) {
            text = 'Deleted';
        }

        if ( this.input === 2 ) {
            text = 'Archived';
        }

        return (
            <div class={classList}>
                <span>{ Locale.trans(text) }</span>
            </div>
        );
    }

}
