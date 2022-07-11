<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>{{ $title ?? \SiteInfo::title() }}</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css?v=').date('Y.m.d-H:i:s') }}">
    <script src="{{ asset('admin/js/flowbite.js') }}"></script>
    <script>
        url = <?php echo json_encode(url('')) ?> + '/';
        asset = <?php echo json_encode(asset('')) ?>;
        fullUrl = <?php echo json_encode(\request()->fullUrl()) ?>;
        const siteInfo = {
            url: url,
            admin_url: url + 'admin',
            asset: asset,
            fullUrl: fullUrl
        }
    </script>
    <script src="{{ asset('admin/js/script.js?v=').Str::random(10) }}"></script>
    @if (isset($require_editor) && $require_editor)
    <script src="{{ asset('admin/js/script.js?v=').Str::random(10) }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('summernote/styles.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @endif
</head>

<body class="bg-blue-50 dark" style="margin: 0;padding:0;" id="app">
    @include('/admin/templates/nav')
    <!-- Start sidenav + content -->
    <div class="flex flex-row dark:bg-gray-600 min-h-screen">
        @if(!isset($hide_sidebar) || !$hide_sidebar)
        <div id="left-nav-menu" class="z-40 hidden lg:flex fixed lg:relative flex-col bg-gray-800 max-w-max">
            @include('/admin/templates/sidebar')
        </div>
        @endif
        <div class="flex-auto">
            <div class="flex flex-col justify-between">
                <main class="flex flex-col overflow-x-hidden">
                    @include('/admin/templates/breadcrums')
                    @if(!isset($notification_type) || $notification_type != 'none')
                    @if(isset($notification_type) && $notification_type == 'inline')
                    @include('/admin/components/notifications/inline')
                    @else
                    @include('/admin/components/notifications/toast')
                    @endif
                    @endif