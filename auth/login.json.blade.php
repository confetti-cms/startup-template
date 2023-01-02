@php
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /** @noinspection PhpUndefinedNamespaceInspection */
    /** @noinspection PhpUndefinedFunctionInspection */
@endphp

@php
    $login = section('auth')->role('developer');

    echo \Login\OauthSettings(
        logo: $login->image('login_logo'),
        color: $login->color('color'),
    );
@endphp
