<div class="flex flex-col">
    <div class="grid items-center justify-center" id="drop-area-wrapper">
        <label for="fileElem" class="flex flex-wrap w-full items-center h-full bg-teal-100" id="drop-area">
        <div class="text-center">
            <form class="my-form">
                @csrf
                <p>Upload multiple images with the file dialog or by dragging and dropping images onto the dashed region</p>
                <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
                <label class="button" for="fileElem">Select some files</label>
            </form>
            <div class="flex flex-wrap justify-center w-full">
                <div id="gallery">
                </div>
            </div>
        </div>
        </label>
    </div>
</div>
<div class="flex w-full">
    <div id="uploadMessage"></div>
    <progress id="uploadProgress" class="hidden" value="35" max="100"></progress>
</div>
<style>

</style>
<script>
    let dropArea = document.getElementById('drop-area')

    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false)
    })

    function preventDefaults (e) {
    e.preventDefault()
    e.stopPropagation()
    }

    ;['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false)
    })

    ;['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false)
    })

    function highlight(e) {
    dropArea.classList.add('highlight')
    }

    function unhighlight(e) {
    dropArea.classList.remove('highlight')
    }

    dropArea.addEventListener('drop', handleDrop, false)

    function handleDrop(e) {
    let dt = e.dataTransfer
    let files = dt.files

    handleFiles(files)
    }


    function handleFiles(files) {
        files = [...files]
        files.forEach(previewFile)
    }

    function uploadFile(file, uploadNode) {
        // console.log(uploadNode)
        var token = document.getElementsByName('_token')[0].value
        let uploadProgress = uploadNode.querySelector('.progress')
        let uploadMessage = uploadNode.querySelector(`.message`)
        
        let link = uploadNode.querySelector('a')
        
        var url = siteInfo.url+'admin/media'
        var xhr = new XMLHttpRequest()
        var formData = new FormData()

        xhr.upload.onloadstart = function (event) {
            uploadProgress.classList.remove('hidden')
            uploadProgress.value = 0
            uploadProgress.max = event.total
            uploadMessage.textContent = 'Uploading...'
        }
        
        xhr.upload.progress = function (event) {
            uploadProgress.value = event.loaded
            uploadProgress.max = event.total
        }
        
        xhr.addEventListener('readystatechange', function() {
            
            if (xhr.readyState == 4 && xhr.status == 200) {
               
                // console.log(xhr)
                const item = xhr.responseText
                const itemParsed = JSON.parse(item)
                if (typeof itemParsed.error === 'undefined') {
                    // Done. Inform the user
                    uploadProgress.value = uploadProgress.max
                    uploadMessage.textContent = ''
                    
                    if (typeof quickUploader !== 'undefined' && quickUploader == true) {
                        updateNewMedia(item, link)
                    }

                 }else{
                    // Error. Inform the user
                    uploadMessage.textContent = itemParsed.error
                    link.classList.remove('busy')
                    link.classList.add('not-allowed')
                }

            }
            else if (xhr.readyState == 4 && xhr.status != 200) {
                // Error. Inform the user
                uploadMessage.textContent = 'Failed'
                link.classList.remove('busy')
                link.classList.add('not-allowed')
            }
        })


        xhr.open('POST', url, true)
        formData.append('file', file)
        formData.append('_token', token)
        xhr.send(formData)
    }

    function updateNewMedia(item, link) {
        link.setAttribute('href', `${siteInfo.url}admin/media/${JSON.parse(item).id}`)
        link.setAttribute('data', item)
        link.classList.remove('busy')
        link.classList.add(`single-image`)

    }

    function previewFile(file) {
        let reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onloadend = function() {
            
            if (typeof quickUploader !== 'undefined' && quickUploader == true) {
                uploadFile(file, quickUploaderFn(reader))
            }else {
            // creating div and adding class & id
            let div = document.createElement('div')
            div.classList.add('upload-preview', 'p-1', 'flex', 'flex-col', 'justify-between')
            
            let imageWrapper = document.createElement('div')
            imageWrapper.style = "height:180px;width:180px;overflow:hidden"
            imageWrapper.classList.add('mx-auto')
            let img = document.createElement('img')
            img.src = reader.result
            img.style = `width:100%;height:100%!important`
            imageWrapper.appendChild(img)
            
            div.appendChild(imageWrapper)
            
            let messageProgressWrapper = document.createElement('div')
            messageProgressWrapper.classList.add('w-full')

            let message = document.createElement('div');
            message.classList.add('message')
            messageProgressWrapper.append(message)

            let progress = document.createElement('progress');
            progress.classList.add('progress')
            messageProgressWrapper.append(progress)
            div.append(messageProgressWrapper)

            document.getElementById('gallery').appendChild(div)
            
            uploadFile(file, div)
        }

        }
    }

    function quickUploaderFn(reader) {

        uploadSection.classList.add('hidden')
        mediaSection.classList.remove('hidden')
        
        let item = document.createElement('div')
        item.classList.add('flex', 'flex-col', 'bg-gray-400', 'single-image-parent')
        
        let imageWrapper = document.createElement('div')
        imageWrapper.style = "height:180px;width:180px;overflow:hidden"
        imageWrapper.classList.add('mx-auto')
        let link = document.createElement('a')
        link.setAttribute('href', '#')
        link.classList.add('busy')
        link.setAttribute('data', '')
        link.classList.add(`block`, `md:w-full`, `h-full`)
        
        let img = document.createElement('img')
        img.style = `width:100%;height:100%!important`
        img.src = reader.result
        
        link.append(img)
        imageWrapper.append(link)
        item.append(imageWrapper)

        let messageProgressWrapper = document.createElement('div')
        messageProgressWrapper.style = "width:180px;"
        messageProgressWrapper.classList.add('mx-auto', 'text-center')

        let message = document.createElement('div');
        message.classList.add('message')
        messageProgressWrapper.append(message)

        let progress = document.createElement('progress');
        progress.classList.add('progress')
        messageProgressWrapper.append(progress)
        item.append(messageProgressWrapper)

        document.querySelector("#mediaSection").querySelector('#content').prepend(item);
        return item
    }
</script>
<style>
    #drop-area-wrapper {
        min-height: 300px;
        margin: 10px auto;
        
    }
    #drop-area {
        border: 2px dashed #ccc;
        border-radius: 20px;
        font-family: sans-serif;
        padding: 20px;
        
    }
    #drop-area.highlight {
    border-color: purple;
    }
    p {
    margin-top: 0;
    }
    .my-form {
    margin-bottom: 10px;
    }
    #gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 10px;
    }
    #gallery img {
    width: 150px;
    margin-bottom: 10px;
    margin-right: 10px;
    vertical-align: middle;
    }
    .button {
    display: inline-block;
    padding: 10px;
    background: #ccc;
    cursor: pointer;
    border-radius: 5px;
    border: 1px solid #ccc;
    }
    .button:hover {
    background: #ddd;
    }
    #fileElem {
    display: none;
    }
</style>