# Паспорт сервис

## Ключевые URL

1. Авторизация `GET auth/login`. При авторизации доступны следующие опции (как GET параметры):
   1. `origin_path` - URL для определения места откуда пришел пользователь (для логов)
   2. `back_path` - URL куда вернуть пользователя при нажатии кнопки назад на форме
   3. `ret_path` - URL куда вернуть пользователя при успешной авторизации 
2. Выход `GET auth/logout`
3. **WIP**. Выход из всех устройств `GET auth/logout?all=true`

## Токен
Токен представляет собой простой JWT токен, который зашифрован, 
с помощью закрытого ключа, для его расшифровки нужно использовать открытый ключ.

После успешной авторизации, токен возвращается в виде GET параметра:


Токен хранит в себе следующую информацию:
```json
{
    "id": <int>, # USER ID
    "expired_at": <int(UNIX TIMESTAMP)>
}
```

Для расшифровки токена, можно использовать следующую функцию:
```php
public static function decrypt(string $value): stdClass
{
    $file = fopen(config('auth.token.public_key'),'r');
    $raw = fread($file, 8192);
    fclose($file);

    $key = openssl_pkey_get_public($raw);
    if (!$key) {
        throw new Exception('Failed to load public key!');
    }

    return JWT::decode($value, new Key($key, config('auth.token.algo')));
}
```

## Настройки
В `auth.token` находятся настройки для шифрования токена, где:

* `private_key` - путь до закрытого ключа
* `public_key` - путь до открытого ключа
* `passphrase` - пароль от ключа
* `algo` - алгоритм шифрования токена
* `lifetime` - время жизни токена (оно же время жизни вторичной сессии)

Сгенерированные ключи для сервиса лежат в 1pass (https://share.1password.com/s#UEvNF04F9MvhKnL4zpOw4kMUtYGkCitV8oOgtK5L6B0)
