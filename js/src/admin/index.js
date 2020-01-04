import WeiboSettingsModal from './components/WeiboSettingsModal';

app.initializers.add('minr-auth-weibo', () => {
  app.extensionSettings['minr-auth-weibo'] = () => app.modal.show(new WeiboSettingsModal());
});