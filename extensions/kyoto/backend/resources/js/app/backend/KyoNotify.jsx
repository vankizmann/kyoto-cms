export default {

    name: 'KyoNotify',

    data()
    {
        return {
            hasMessage: true
        };
    },

    computed: {

        user()
        {
            return kyoto.getUser();
        }

    },

    methods: {

        clearMessage()
        {
            this.hasMessage = false;
        }

    },

    renderButton()
    {
        return (
            <a class="kyo-notify__button" href="javascript:void(0)" onClick={this.clearMessage}>
                <img src={kyoto.getIcon()} alt={kyoto.getPagetitle()} />
            </a>
        );
    },

    renderUser()
    {
        let buttonProps = {
            size: 'sm',
        };

        let settingsProps = {
            type: 'primary',
        };

        let logoutProps = {
            type: 'warning',
        };

        logoutProps['onClick'] = () => {
            window.location = kyoto.getPath('logout');
        };

        return (
            <div class="kyo-notify-user">
                <div className="kyo-notify-user__image">
                    <img src={`https://api.hello-avatar.com/adorables/120/${this.user.id}`}alt={this.user.name} />
                </div>
                <div class="kyo-notify-user__info">
                    {this.trans('Hello, :name', this.user)}
                </div>
                <div class="kyo-notify-user__setting">
                    <NButton {...buttonProps} {...settingsProps}>
                        {this.trans('Settings')}
                    </NButton>
                </div>
                <div className="kyo-notify-user__logout">
                    <NButton {...buttonProps} {...logoutProps}>
                        {this.trans('Logout')}
                    </NButton>
                </div>
            </div>
        );
    },

    renderMessages()
    {
        return (
            <NScrollbar class="kyo-notify-messages">
                <NEmptyIcon size="sm">{this.trans('No messages')}</NEmptyIcon>
            </NScrollbar>
        )
    },

    renderAction()
    {
        let buttonProps = {
            size: 'sm'
        };

        return (
            <div class="kyo-notify-action">
                <div class="kyo-notify-action__title">
                    <h4>{this.trans('Messages')}</h4>
                </div>
                <div class="kyo-notify-action__button">
                    <NButton {...buttonProps}>
                        {this.trans('Clear')}
                    </NButton>
                </div>
            </div>
        )
    },

    renderPopover()
    {
        let popoverProps = {
            type: 'light',
            trigger: 'click',
            width: 460,
            position: 'bottom-start',
        };

        return (
            <NPopover class="kyo-notify__popover" {...popoverProps}>
                { this.ctor('renderAction')() }
                { this.ctor('renderMessages')() }
                { this.ctor('renderUser')() }
            </NPopover>
        );
    },

    render()
    {
        let classList = [
            'kyo-notify'
        ];

        if ( this.hasMessage ) {
            classList.push('has-message');
        }

        return (
            <div class={classList}>
                {this.ctor('renderButton')()}
                {this.ctor('renderPopover')()}
            </div>
        );
    }

}
