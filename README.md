# Паспорт сервис

## Ключевые URL

1. Авторизация `GET auth/login`. При авторизации доступны следующие опции (как GET параметры):
   1. `origin_path` - URL для определения места откуда пришел пользователь (для логов)
   2. `back_path` - URL куда вернуть пользователя при нажатии кнопки назад на форме
   3. `ret_path` - URL куда вернуть пользователя при успешной авторизации (по умолчанию yellowimages.com, **является обязательным**)
2. Выход `GET auth/logout`
3. **WIP**. Выход из всех устройств `GET auth/logout?all=true`

## Токен
Токен представляет собой простой JWT токен, который зашифрован, 
с помощью закрытого ключа, для его расшифровки нужно использовать открытый ключ.

После успешной авторизации, токен возвращается в виде GET параметра:
```json
https://yellowimages.com/?yi_passport_auth_token=eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpZCI6MjAwMDI3LCJleHBpcmVkX2F0IjoxNjU1ODEwNzIyfQ.mH953hrmB3Ochv-ctd1qPKntIUkeKFgjbLwdQv9q5rdPzfl9cvC2UaqazFvV-XdaAIUF0hpbTuSJcR7M8PVucpo7NdhYa5A4NKVChisYcKnsdgUOeZ5MLYLS8IYDtOvGAxviHMFa-IeoX0mn4rsS-GC_anl7C0bx2dmXsq06L32XTuoByt5djyPqlVHFh8eM71TRqFnH3kYqAfu0Q3zuAwsDCrnz6RTXFL2r27RS7Xz_jQ_DZiDYZCPKBJqlWdA1eviS7Ib1SyFAzWxfq2RUoKUqWn9sYSccfc9D8iETYBWifsaFHUtDIJABkkGRw5rdlNZr_8kKfqFNBnQg8bVfjA
```

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
