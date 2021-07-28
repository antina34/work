<?php

return [

    /*
    |--------------------------------------------------------------------------
    | BitPay connection credentials
    |--------------------------------------------------------------------------
    |
    | Client token can be found using the documentation from
    | https://github.com/bitpay/php-bitpay-light-client/blob/master/GUIDE.md#getting-your-client-token
    |
    */

    'client_token' => env('BIT_PAY_CLIENT_TOKEN', 'Gi7u2udHprUW353NHhtRRpcxA6xEoTSqLd5NsfWLBogh'),
    'client_env' => env('BIT_PAY_CLIENT_ENV', 'Test'),
    'invoice_path' => env('BIT_PAY_INVOICE_PATH', 'https://test.bitpay.com/invoice?id='),
];
