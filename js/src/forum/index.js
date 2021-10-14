import { extend } from 'flarum/extend';
import app from 'flarum/app';
import LogInButtons from 'flarum/components/LogInButtons';
import LogInButton from 'flarum/components/LogInButton';
import SettingsPage from 'flarum/components/SettingsPage';
import Button from "flarum/common/components/Button";
import App from './components/App';
import UnBindModal from "./components/UnBindModal";
import BindModal from "./components/BindModal";

app.initializers.add('minr-auth-weibo', () => {
    extend(SettingsPage.prototype, 'accountItems', (items) => {
        const {
            data: {
                attributes: {
                    WeiboAuth: {
                        isBind = false
                    },
                },
            },
        } = app.session.user;

        items.add('WeiboAuthBind',
            <Button className={`Button WeiboAuthButton--${isBind ? 'danger' : 'success'}`}
                    icon="fab fa-weibo"
                    path={`/auth/${name}`}
                    onclick={(componentClass, attrs) => app.modal.show(isBind ? UnBindModal : BindModal, attrs)}>
                {app.translator.trans(`minr-auth-weibo.forum.buttons.${isBind ? 'unbind' : 'bind'}`)}
            </Button>)
    })

    extend(LogInButtons.prototype, 'items', (items) => {
        items.add('WeiboAuth',
            <LogInButton
                className="Button LogInButton--weibo"
                icon="fab fa-weibo"
                path="/auth/weibo">
              {app.translator.trans('minr-auth-weibo.forum.buttons.with_weibo_button')}
            </LogInButton>
        );
    });
});

app.weibo = new App();