<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'KONONKOULOU'),
    'twitter_consumer_key' => 'c3idEPThKowMGG5kPPPqbzmZt',
    'twitter_consumer_secret' => 'lk49PPIjiq36NdjoBftGIoJsgUSJDOL3z9Gky1QyAJCNO2gaa7',
    'twitter_token' => '1508102518601093122-j9rC5AZXxrdWzvfVHLhx1G013nStpU',
    'twitter_token_secret' => 'KVj023nYjxP76juWoNMZNvpTejkqfPMSVARAG7lif2LaL',
    'reCAPTCHA' => '6LeqXPYeAAAAANdJGpgcLgg9mKMKXxQ6w057m5nf',
    'reCAPTCHA_SECRET' => '6LeqXPYeAAAAAOyzoKcO-6JERUFvceUAa7yVkbfK',
    'facebook_app_id' => '1644783239201398',
    'facebook_page_id' => '103174605632349',
    'facebook_app_secret' => 'c0e3d112a4428dd8cdb3e7b73cd2d3fa',
    'facebook_token' => 'EAAXX6ZCC0gnYBAGylAvTyCGmAnJegbPE0PWePBZCSQ5whYMRyfGXx6frTVmvgUhhU8YVLCul1gZAdY6TCDZAWWLKqmzhZAhrgdJoqIUt8RrbuwIybgsPg3FhJYqj2Lv39os34EEfhvCGLHYZAcYcv28lNpDZCwHlr4PNDrBQBBkkwPaSHQfOEqy77iX5OBAZAcyTZCOG8OZBZAkUDP5pdzJkmeEmd5srZBp6DtZC9zCj9Wd61FYwpBuQCE7VfQl6OgMXiMhsZD',
    'facebook_long_life_access_token' => 'EAAEv8nCokEgBACkXoSpZAt2tP7iRI8TNtGZC63SFugXpmuRPhRlLZAZBULT1mFuCmHCwwuVo2XbkKVKWMeOyD8pqbaDRyjy3bF2vxAfLj3ry3Xh4gOZAqwFZCjmvoxytWjtn50k4ZBmiZB5DDzge1ApoyoWU8j9Pf44l4CZBxr61iGjMETUcMNyyyjZB7fEaR3zFoZD',
    'PAYPAL_MODE' => env('PAYPAL_MODE', 'sandbox'),
    'PAYPAL_SANDBOX_CLIENT_ID' => env('PAYPAL_SANDBOX_CLIENT_ID', 'Ac9z3uXw3Z89tdHaU7GI24kY5gz_9vvMNBQxVaJf-aGkyS2oD-nN5b68dqz2peXKlHAo3f65iskQkYtc'),
    'PAYPAL_SANDBOX_CLIENT_SECRET' => env('PAYPAL_SANDBOX_CLIENT_SECRET', 'ECrD-zw9AucqhBIaoWcRBYkXmI0cYwjYSokVQaPLgXj_4q1u00vUOxGOXmQBdh6Hx7h4dNq7L8xVRLy0'),
    'PAYPAL_LIVE_CLIENT_ID' => env('PAYPAL_LIVE_CLIENT_ID', 'Ab5zJhYOi__Xxm-rRTq-gObZw6vqN2ZM-yytbe0T2sjXoBQurFX9-q_iLP_KU9_S7NuddDRiDoCfMAgP'),
    'PAYPAL_LIVE_CLIENT_SECRET' => env('PAYPAL_LIVE_CLIENT_SECRET', 'EOHlExNyD5JmxmT1xXrGCk2UHNefk7OUM7okReAYsYT6RzjL7B26UNM6AeXJt8V1Urv1JF7yf0Cvtaab'),
    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'fr',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        HepplerDotNet\FlashToastr\FlashServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Arr' => Illuminate\Support\Arr::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'Date' => Illuminate\Support\Facades\Date::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Http' => Illuminate\Support\Facades\Http::class,
        'Js' => Illuminate\Support\Js::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'RateLimiter' => Illuminate\Support\Facades\RateLimiter::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        // 'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'Str' => Illuminate\Support\Str::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Flash' => HepplerDotNet\FlashToastr\Flash::class,

    ],

];
