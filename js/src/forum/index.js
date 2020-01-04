import { extend } from 'flarum/extend';
import app from 'flarum/app';
import LogInButtons from 'flarum/components/LogInButtons';
import LogInButton from 'flarum/components/LogInButton';

app.initializers.add('minr-auth-weibo', () => {
  extend(LogInButtons.prototype, 'items', function(items) {
    items.add('weibo',
        <LogInButton
            className="Button LogInButton--weibo"
            icon="fab fa-weibo"
            path="/auth/weibo">
          {app.translator.trans('minr-auth-weibo.forum.log_in.with_weibo_button')}
        </LogInButton>
    );
  });
});