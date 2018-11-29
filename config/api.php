<?php

return [

    'host' => env('PP_API_HOST', ''),

    'partnerName' => env('PP_PARTNER_NAME', ''),

    'authToken' => env('PP_AUTH_TOKEN', ''),

    'useProxy' => env('PP_USE_PROXY', ''),

    'proxyIP' => env('PP_PROXY_IP', ''),



    'linkHost' =>  env('LINK_PP_HOST', ''),

    'linkLang' => env('LINK_PP_LANG', ''),

    'linkRedirect'=> env('LINK_PP_REDIRECT_URI', ''),




    'pp_validate' => env('SEND_PP_ACCOUNT_HOST', ''),

    'pp_partner' => env('SEND_PP_ACCOUNT_PARTNER', ''),

    'pp_accountId' =>env('SEND_PP_ACCOUNT_ACCOUNT', ''),

];