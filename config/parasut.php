<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Client ID
    |--------------------------------------------------------------------------
    |
    | Client ID value given to you by Parachute, this value is used in both
    | authorization_code and password input formats and is mandatory.
    |
    */
    'client_id' => env('PARASUT_CLIENT_ID', ''),

    /*
    |--------------------------------------------------------------------------
    | Client Secret
    |--------------------------------------------------------------------------
    |
    | Client Secret value given to you by Parachute, this value is used in
    | authorization_code input formats and is mandatory if you use authorization_code flow.
    |
    */
    'client_secret' => env('PARASUT_CLIENT_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Redirect Url
    |--------------------------------------------------------------------------
    | Redirect URL used in the OAuth flow to redirect users back to your application
    | after they have authenticated. If not specified, a default value is used.
    |
    */
    'redirect_url' => env('PARASUT_REDIRECT_URL', 'urn:ietf:wg:oauth:2.0:oob'),

    /*
    |--------------------------------------------------------------------------
    | Username
    |--------------------------------------------------------------------------
    |
    | The username used for the password grant type. This is required for
    | authentication when using the password grant type.
    |
    */
    'username' => env('PARASUT_USERNAME', ''),

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | The password used for the password grant type. This is required for
    | authentication when using the password grant type.
    |
    */
    'password' => env('PARASUT_PASSWORD', ''),

];

