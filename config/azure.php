<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Azure AD OAuth2
    |--------------------------------------------------------------------------
    |
    | Configuración para autenticación con Microsoft Azure AD (OAuth 2.0).
    | redirect_uri debe coincidir exactamente con el registrado en la app de Azure.
    |
    */

    'tenant_id' => env('AZURE_TENANT_ID'),
    'client_id' => env('AZURE_CLIENT_ID'),
    'client_secret' => env('AZURE_CLIENT_SECRET'),
    'redirect_uri' => rtrim(env('APP_URL'), '/') . '/auth/azure/callback',

    'authorize_url' => 'https://login.microsoftonline.com/%s/oauth2/v2.0/authorize',
    'token_url' => 'https://login.microsoftonline.com/%s/oauth2/v2.0/token',

    'scopes' => 'openid profile email',

];
