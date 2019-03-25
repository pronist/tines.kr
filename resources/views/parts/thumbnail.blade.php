<app-main
    component         = "{{ $component }}"
    :thumbnails       = "{{ json_encode($thumbnails) }}"
    :added_parameters = "{{ 
        isset($added_parameters)
            ? json_encode(array_merge($added_parameters))
            : json_encode([])
    }}"
    token             = "{{ session()->get('token')?: null }}"
    request_url       = "{{ isset($request_url)? $request_url: null }}"
    start             = "{{ config('api.start') + config('api.count') }}"
    count             = "{{ config('api.count') }}"
    email             = "{{ $auth->check()? $auth->user()->email: null }}"
></app-main>