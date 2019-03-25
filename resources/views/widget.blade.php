<style>
    html, body {
        margin: 0px;
        padding: 0px;
    }
</style>

<div id="app">
    <component is="{{ $component }}"
        email="{{ $email }}"
        name="{{ $name }}"
        message="{{ $message }}"
    ></component>
</div>

{{-- resources/js/app.js --}}
<script src="{{ mix('js/app.js') }}"></script>