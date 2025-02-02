@extends('website.layouts.blank')

@section('head_title', 'Login')

@section('content')
    <!-- The next screen will be on Auth0 -->
@endsection
@pushonce('end_of_body_login')
<script>
    // Get redirect url
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '{{ getServiceApi() }}/confetti-cms/auth/login', true);
    xhr.responseType = 'json';
    xhr.setRequestHeader('Accept', 'application/json');
    xhr.onload = function () {
        let status = xhr.status;
        if (status === 200) {
            let date = new Date();
            date.setTime(date.getTime() + (10 * 60 * 1000));
            let expires = "; expires=" + date.toUTCString();
            document.cookie = "state=" + xhr.response["state"] + expires + "; path=/";
            // set cookie to redirect to this page after login
            document.cookie = "redirect_after_login=/login-callback; path=/";
            window.location.href = xhr.response["redirect_url"];
        } else {
            console.error(status, xhr.response);
        }
    };
    xhr.send()
    console.log("request send");
</script>
@endpushonce