import { Obj, Any } from "@kizmann/pico-js";
import NTableCell from "@kizmann/nano-ui/src/table/src/table-cell/table-cell";

export default {

    name: 'NTableCellLink',

    extends: NTableCell,

    render()
    {
        if ( ! this.init ) {
            return null;
        }

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
