import SettingsModal from 'flarum/components/SettingsModal';

export default class WeiboSettingsModal extends SettingsModal {
    className() {
        return 'WeiboSettingsModal Modal--small';
    }

    title() {
        return app.translator.trans('flarum-auth-weibo.admin.weibo_settings.title');
    }

    form() {
        return [
            <div className="Form-group">
                <label>{app.translator.trans('flarum-auth-weibo.admin.weibo_settings.api_key_label')}</label>
                <input className="FormControl" bidi={this.setting('flarum-auth-weibo.api_key')}/>
            </div>,

            <div className="Form-group">
                <label>{app.translator.trans('flarum-auth-weibo.admin.weibo_settings.api_secret_label')}</label>
                <input className="FormControl" bidi={this.setting('flarum-auth-weibo.api_secret')}/>
            </div>
        ];
    }
}
