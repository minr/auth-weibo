# Flarum-ext-auth-weibo

该插件适用于使用微博（weibo）第三方登录的 Flarum。

## 安装
通过 Composer 安装此包。

```shell
composer require minr/flarum-ext-auth-weibo
```

## 注意 

若要支持中文，请修改核心代码：

- ./vendor/flarum/core/src/User/UserValidator.php

```php
'regex:/^[-_a-zA-Z0-9\x7f-\xff]+$/i',
```

- flarum/core/src/Forum/Auth/Registration.php

```php
/**
 * @param string $username
 * @return $this
 */
public function suggestUsername(string $username): self{
    // $username = preg_replace('/[^a-z0-9-_]/i', '', $username);
    return $this->suggest('username', $username);
}
```