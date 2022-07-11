<div style="width:180px;height:180px;overflow:hidden;" class="mx-auto">
    <label id="image_url_label" class="transition-ease duration-500 w-full bg-[#ebf5ffcf] hover:bg-gray-400 text-gray-600 hover:text-gray-200 p-4 flex flex-col justify-center w-full border-4 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300"
                        style="height:inherit;background-image: url('{{ $image }}');background-repeat: no-repeat;background-size: cover;">
        <span class="inner w-full bg-[#ebf5ffcf] text-center font-medium py-2 px-3 rounded mr-2" >{{ isset($label) ? $label : 'Choose logo' }}</span>
    </label>
</div>
<input type="hidden" id="image_url" name="image_url">
<?php $quickUploader = true; ?>
<script>
    const quickUploader = true
</script>
@include('/admin/media/components/upload-and-media')
<script>
    var wrapper = document.querySelector('.media-modal-wrapper')
    wrapper.classList.add('hidden')
    const showMedia = document.getElementById('image_url_label')
    showMedia.addEventListener('click', function () {
        wrapper.classList.toggle('hidden')
    })
</script>
