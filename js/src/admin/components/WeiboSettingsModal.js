import SettingsModal from 'flarum/components/SettingsModal';

export default class WeiboSettingsModal extends SettingsModal {
    className() {
        return 'WeiboSettingsModal Modal--small';
    }

    title() {
        return app.translator.trans('minr-auth-weibo.admin.weibo_settings.title');
    }

    form() {
        return [
            <div className="Form-group">
                <label>{app.translator.trans('minr-auth-weibo.admin.weibo_settings.client_id_label')}</label>
                <input className="FormControl" bidi={this.setting('minr-auth-weibo.client_id')}/>
            </div>,

            <div className="Form-group">
                <label>{app.translator.trans('minr-auth-weibo.admin.weibo_settings.client_secret_label')}</label>
                <input className="FormControl" bidi={this.setting('minr-auth-weibo.client_secret')}/>
            </div>
        ];
    }
}