import WeiboSettingsModal from './components/WeiboSettingsModal';

app.initializers.add('minr-auth-weibo', () => {
  app.extensionData.for('minr-auth-weibo').registerPage(WeiboSettingsModal)
});