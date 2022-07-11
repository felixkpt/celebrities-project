<div class="media-modal-wrapper">
    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col p-1 mt-16 overflow-y-auto w-11/12 md:w-10/12 media-modal bg-gray-700 rounded-lg shadow-lg">
            <div class="flex justify-end w-full">
                <span title="Close">
                    <svg class="w-6 h-6 close text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </span>
            </div>
            @include('/admin/media/components/upload-and-media-inner')
        </div>
    </div>
</div>
<script>
    var wrapper = document.getElementsByClassName('media-modal-wrapper')[0];
    wrapper.addEventListener('click', function (event) {
        var self = event.target.closest('.media-modal');
        if (!self) {
            wrapper.classList.add('hidden')
        }
    })
    document.querySelector('.media-modal-wrapper .close').addEventListener('click', function () {
        wrapper.classList.add('hidden')
    })
</script>
<style>
    .media-modal-wrapper {
        position: fixed;
        overflow-y: auto;
        z-index: 110;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow-y: hidden;
        background-color: #000000a6;
        transition: all .5s ease;
    }
    .media-modal {
        opacity: 1;
        z-index: 120;
        height: 80vh;
    }
</style>
