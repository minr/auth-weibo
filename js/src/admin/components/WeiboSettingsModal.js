import { settings } from '@fof-components';
import ExtensionPage from 'flarum/components/ExtensionPage';

const {
    items: { StringItem },
} = settings;

export default class WeiboSettingsModal extends ExtensionPage {
    oninit(vnode) {
        super.oninit(vnode);
        this.setting = this.setting.bind(this);
    }

    content() {
        return [
            <div className="WeiboAuthSettingsPage">
                <div className="container">
                    <div className="Form-group">
                        <StringItem  setting={this.setting}>

                        </StringItem>
                        <label>{app.translator.trans('minr-auth-weibo.admin.weibo_settings.client_id_label')}</label>
                        <input className="FormControl" bidi={this.setting('minr-auth-weibo.client_id')}/>
                    </div>,

                    <div className="Form-group">
                        <label>{app.translator.trans('minr-auth-weibo.admin.weibo_settings.client_secret_label')}</label>
                        <input className="FormControl" bidi={this.setting('minr-auth-weibo.client_secret')}/>
                    </div>
                    {this.submitButton()}
                </div>
            </div>
        ];
    }
}