<?php $image_name = $image_name ?? @$name; ?>
<div class="">
    <div class="max-w-2xl rounded-lg shadow-xl bg-gray-50">
        <div class="m-4">
            <div class="flex items-center justify-center w-full h-64">
                <div class="mx-auto" style="width:180px;height:180px;overflow:hidden;">
                    <label id="preview"
                        class="flex flex-col w-full border-4 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300"
                        style="height:inherit;background-image: url('{{ @$image }}');background-repeat: no-repeat;background-size: cover;">
                        <div class="flex flex-col items-center justify-center pt-7">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                Attach image</p>
                        </div>
                        <input type="file" name="{{ $image_name ?? 'image' }}" class="opacity-0" id="imageInput" accept="image/*" />
                    </label>
                </div>
            </div>
        </div>
    </div>
</div> 
<script>
    const image_input = document.querySelector("#imageInput");
    image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        const uploaded_image = reader.result;
        document.querySelector("#preview").style.backgroundImage = `url(${uploaded_image})`;
    });
    reader.readAsDataURL(this.files[0]);
    });
</script>