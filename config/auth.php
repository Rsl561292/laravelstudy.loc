<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',//група налаштування захисника .... описана нище
        'passwords' => 'users',//група налаштування процесу скидування паролю користувачу
                                // для відновлення .... описана нище
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [//список доступних груп
        'web' => [//налаштування групи вибраного охоронця
            'driver' => 'session',/*який охоронець використовується для вказаної групи
                тобто яким чином кожним запитом буде передаватися інформація чи це запит відсилає
                аутентифікований користува та дані користувача..... у даному випадку це сесії*/
            'provider' => 'users',/*група налаштувань використовуваного провайдера,
                тобто того яким чином будуть витягуватися дані користувача для проходження
                ним аутентифікації .... описана нище*/
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [//група параметрів налаштування провайдера
            'driver' => 'eloquent',/*вказує що буде використовуватися для отримання даних користувача
                у даному випадку це реляційна модель, модель фреймворка.*/
            'model' => App\User::class, /*яка модель буде використовуватись, тобто дана модель
                і є провайдером для вибраного охоронця(guard)*/
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',//використовуваний провайдер для отримання даних про користувача
            'table' => 'password_resets',//таблиця, яка використовується для збросу паролю
            'expire' => 60,
        ],
    ],

];
