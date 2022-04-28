import { Obj } from "@kizmann/pico-js";
import KyoGateEdit from "./KyoGateEdit";

export default Obj.assign({}, KyoGateEdit, {

    name: 'KyoGateCreate',

    /**
     * Refresh on locale change (true|false)
     */
    localized: false,

    /**
     * Used routes in view
     */
    urls: {
        show: '/{locale}/kyoto/user/http/controllers/gate/show',
        store: '/{locale}/kyoto/user/http/controllers/gate/store',
    },

});
