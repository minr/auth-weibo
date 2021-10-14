import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';

export default class BindModal extends Modal {
    className() {
        return 'WeiboAuthBindModal Modal--small';
    }

    title() {
        return app.translator.trans('minr-auth-weibo.forum.modals.bind.title');
    }

    content() {
        return (
            <div className="Modal-body">
                <div className="Form Form--centered">
                    <div className="Form-group">
                        <Button
                            className="Button LogInButton--WeiboAuth"
                            icon="fab fa-weibo"
                            loading={this.loading}
                            disabled={this.loading}
                            path={`/auth/${name}`}
                            onclick={() => this.showLogin()}
                        >
                            {app.translator.trans("minr-auth-weibo.forum.buttons.login")}
                        </Button>
                    </div>
                </div>
            </div>
        );
    }

    showLogin() {
        const width = 600;
        const height = 400;
        const $window = $(window);

        window.open(`${app.forum.attribute('apiUrl')}/auth/weibo/bind`,
            'WeiboAuthBindPopup',
            `width=${width},` +
            `height=${height},` +
            `top=${$window.height() / 2 - height / 2},` +
            `left=${$window.width() / 2 - width / 2},` +
            'status=no,scrollbars=no,resizable=no');

        this.loading = true;
    }
}