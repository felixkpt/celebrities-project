<?php use Illuminate\Support\Facades\Request; ?>
<div class="w-full flex flex-col justify-center bg-gray-500 rounded" id="show-media">
    @if (!isset($single_media))
    <div class="flex justify-end w-full mb-2">
        <span title="Close" class="close">
            <svg  class="w-6 h-6  text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </span>
    </div>
    @endif
    <div class="flex flex-col w-full p-2">
        <div class="flex">
            <label class="text-gray-50 border-2 border-gray-100 mr-2 py-1 px-2 rounded" for="text" id="copy" data-purpose="{{ isset($purpose) ? $purpose : 'Copy' }}">Copy</label>
            <input class="w-full rounded" type="readonly" id="text" value="{{ isset($media_item) ? asset($media_item->url) : '' }}">
        </div>
        <div class="flex justify-center mt-2">
            <div class="flex flex-col justify-center md:w-2/3">
                <div class="flex w-full justify-center" style="min-height: 80px ;">
                    <img style="width: auto;" src="{{ isset($media_item) ? asset($media_item->url) : '' }}" alt="" id="image">
                </div>
                <div class="flex flex-col justify-center w-full bg-gray-200 rounded mt-2 px-1">
                    <div class="flex w-full justify-center">
                        <p class="text-gray-600 font-normal">Image type: <span id="type">{{ isset($media_item) ? $media_item->mime : '' }}</span></p>
                    </div>
                    <div class="flex w-full justify-center">
                        <p class="text-gray-600 font-normal">Image size: <span id="size">{{ isset($media_item) ? $media_item->size : '' }}</span></p>
                    </div>
                    <div class="flex w-full justify-center">
                        <p class="text-gray-500 font-normal">Uploaded <span id="uploaded">{{ isset($media_item) ? $media->created_at->diffForHumans() : '' }}</span> by <span class="text-sky-500" id="author"><a href="{{ isset($media_item) ? url('admin/media?author='.$media->author->slug) : '' }}">{{ isset($media_item) ? $media->author->name : '' }}</a></span></p>
                    </div>
                </div>
                <div class="flex w-full justify-between mt-2">
                    <a href="{{ isset($media_item) ? asset($media_item->url) : '#' }}" id="link" class="bg-blue-500 text-gray-100 font-bold hover:bg-blue-700 pointer rounded-lg p-1 mr-1" target="_blank">View full image</a>
                    <form action="{{ isset($media_item) ? url('admin/media/'.$media_item->id) : '' }}" method="post" class="flex">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="redirect" value="" id="redirect">
                        <button class="bg-red-600 text-gray-100 font-bold hover:bg-red-800 pointer rounded-lg p-1">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function singleImage(item) {
    item = JSON.parse(item)
   
    document.getElementById('currentMediaSectionModal').classList.remove('hidden')

    document.querySelector('#currentMediaSectionModal #text').value = item.url
    document.querySelector('#currentMediaSectionModal #text').select()

    document.querySelector('#currentMediaSectionModal #link').setAttribute('href', item.url)
    document.querySelector('#currentMediaSectionModal #image').setAttribute('src', item.url)
    document.querySelector('#currentMediaSectionModal #type').innerHTML = item.type;
    document.querySelector('#currentMediaSectionModal #size').innerHTML = item.size;
    let date = new Date(item.created_at)
    let time = date.toLocaleTimeString();
    date = date.toLocaleDateString();
    document.querySelector('#currentMediaSectionModal #uploaded').textContent = ' on '+date+' at '+time;
    document.querySelector('#currentMediaSectionModal #author a').textContent = item.author.name;
    document.querySelector('#currentMediaSectionModal #author a').setAttribute('href', `${siteInfo.url}admin/media?author=${item.author.slug}`);
    document.querySelector('#currentMediaSectionModal form').setAttribute('action', `${siteInfo.url}admin/media/${item.id}`)
    document.querySelector('#currentMediaSectionModal #redirect').value = siteInfo.fullUrl;
    
}

const copy = document.querySelector('#show-media #copy');
copy.style = 'border-color:#ccc'
let source = document.querySelector('#show-media #text')

if (typeof quickUploader !== 'undefined' && quickUploader == true) {
    const purpose = copy.getAttribute('data-purpose');
    copy.innerHTML = purpose;
    copy.addEventListener('click', function () { 

        if (purpose == 'Use' && (imageUrlSection = document.getElementById('image_url'))) {
            imageUrlSection.value = source.value
            document.getElementById('image_url_label').style.backgroundImage = `url(${source.value})`
            document.getElementById('currentMediaSectionModal').classList.add('hidden')
            document.getElementsByClassName('media-modal-wrapper')[0].classList.add('hidden')
        }

    })

}else {
    copy.addEventListener('click', function () { 
        source.select()
        navigator.clipboard.writeText(source.value)
        
        let initial = copy.textContent
        copy.textContent = 'Copied!'
        copy.style = 'border-color:green'
        setTimeout(() => {
            copy.textContent = initial;
            copy.style = 'border-color:lightgray'
        }, 3000) 
    })

}

if (typeof singleMedia === 'undefined') {
        // Closing the modal block code
        var wrapperItem = document.querySelector('.media-modal-wrapper-item')
    wrapperItem.addEventListener('click', function (event) {
        var self = event.target.closest('.media-modal-item')
        if (!self) {
            wrapperItem.classList.add('hidden')
        }
    })
    document.querySelector('.media-modal-wrapper-item .close').addEventListener('click', function () {
        wrapperItem.classList.add('hidden')
    })
}

</script>
<style>
    .media-modal-wrapper-item {
        position: fixed;
        z-index: 130;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: #000000a6;
    }
    .media-modal-item {
        opacity: 1;
        overflow: auto;
    }
</style>
