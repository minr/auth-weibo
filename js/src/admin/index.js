import app from 'flarum/app';

import WeiboSettingsModal from './components/WeiboSettingsModal';

app.initializers.add('flarum-auth-weibo', () => {
  app.extensionSettings['flarum-auth-weibo'] = () => app.modal.show(new WeiboSettingsModal());
});
