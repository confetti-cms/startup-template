@extends('website.layouts.blank')
@section('content')
    <div class="hidden container flex h-screen font-body js-loading">
        <div class="m-auto w-96 p-6">
            <h1 id="model-title" class="text-3xl font-semibold text-gray-800 text-center">Redirect to login...</h1>
        </div>
    </div>
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
                document.cookie = "redirect_after_login=" + window.location.href + "; path=/";
                window.location.href = xhr.response["redirect_url"];
            } else {
                console.error(status, xhr.response);
            }
        };
        xhr.send()
        console.log("request send");

        // Show loading bar after 1 second
        setTimeout(() => {
            document.querySelector('.js-loading').classList.remove('hidden');
        }, 3000);
    </script>
@endpushonce

