@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Control Panel Api"))

@section('content')

    <section class="content-header">
        @include('laravel-enso/menumanager::breadcrumbs')
    </section>
    <section class="content">
        @can('manage-oauth-tokens')
            <passport-clients></passport-clients>
        @endcan
    </section>

@endsection

@push('scripts')

    <script>

        const vm = new Vue({
            el: '#app'
        });

    </script>

@endpush