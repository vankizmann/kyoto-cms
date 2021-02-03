import { Any, Obj } from "@kizmann/pico-js";
import NInfoField from "@kizmann/nano-ui/src/info/src/info-field/info-field";

export default {

    name: 'NInfoFieldLink',

    extends: NInfoField,

    render()
    {
        if ( this.column.cslo('default', this) ) {
            return (
                <div>{ this.column.$slots.default(this) }</div>
            );
        }

        let targetUrl = Obj.assign({ params: this.item },
            this.column.modelValue);

        return (
            <div>
                <router-link to={targetUrl}>
                    { Any.convertString(this.input, this.column.emptyText) }
                </router-link>
            </div>
        );
    }

}
