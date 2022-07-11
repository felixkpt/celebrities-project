@include('/admin/templates/header')
<div class="flex flex-col px-3">
    <div class="w-full">
        <h2 class="text-2xl" id="title">{{ $title }}</h2>
    </div>
    <div class="p-3 overflow-y-auto w-full bg-gray-700 rounded-lg shadow-lg">
        @include('/admin/media/components/upload-and-media-inner')
    </div>
</div>
@include('/admin/templates/footer')