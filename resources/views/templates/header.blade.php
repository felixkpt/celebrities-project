<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? \SiteInfo::description() }}">
    <title>{{ $title ?? \SiteInfo::title() }}</title>
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css?v=').date('Y.m.d-H:i:s') }}">
    <script src="{{ asset('js/script.js?v=').Str::random(10) }}" async></script>
    <script src="{{ asset('js/flowbite.js') }}"></script>
    @if ($_SERVER['HTTP_HOST'] != 'localhost' && (!Auth::user() || !Auth::user()->hasRole('Admin')))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TW0XE13E2C"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-TW0XE13E2C');
    </script>
    @endif
    @if (isset($require_editor) && $require_editor)
    <script src="{{ asset('admin/js/script.js?v=').Str::random(10) }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('summernote/styles.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @endif
</head>

<body class="bg-[#b3a1b317] dark" style="margin: 0;padding:0;" id="app">
    @include('/templates/nav')
    <!-- Start sidenav + content -->
    <div class="flex flex-wrap w-full mt-3 px-1 sm:px-2 lg:px-4">
        <main class="w-full @if(!isset($hide_sidebar) || !$hide_sidebar) md:w-9/12 pr-1 @endif">
            <div class="px-2">
                <h1>{{ $title }}</h1>
                <hr class="border-t border-gray-400">
            </div>
            @if(!isset($notification_type) || $notification_type != 'none')
            @if(isset($notification_type) && $notification_type == 'toast')
            @include('/components/notifications/toast')
            @else
            @include('/components/notifications/inline')
            @endif
            @endif