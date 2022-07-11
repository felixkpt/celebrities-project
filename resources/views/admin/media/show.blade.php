@include('/admin/templates/header')    
<div class="flex flex-col items-center px-3">
    <script>
        singleMedia = true
    </script>
    <?php $single_media = true; $media_item = $media; ?>
    @include('/admin/media/components/show')
</div>
@include('/admin/templates/footer')