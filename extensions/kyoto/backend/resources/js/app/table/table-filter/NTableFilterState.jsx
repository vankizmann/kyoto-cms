import NTableFilterString from "@kizmann/nano-ui/src/table/src/table-filter/types/table-filter-boolean";

export default {

    name: 'NTableFilterState',

    extends: NTableFilterString,

    renderForm()
    {
        let options = {
            1: this.trans('Enabled'),
            0: this.trans('Disabled'),
            2: this.trans('Archived'),
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
