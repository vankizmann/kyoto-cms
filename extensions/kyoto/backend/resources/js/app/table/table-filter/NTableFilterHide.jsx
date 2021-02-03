import NTableFilterString from "@kizmann/nano-ui/src/table/src/table-filter/types/table-filter-boolean";

export default {

    name: 'NTableFilterHide',

    extends: NTableFilterString,

    renderForm()
    {
        let options = {
            0: this.trans('Visible'),
            1: this.trans('Hidden'),
        };

        return (
            <NForm>
                <NFormItem>
                    <NSelect size="sm" vModel={this.filter.value} options={options} />
                </NFormItem>
            </NForm>
        );
    }

}
