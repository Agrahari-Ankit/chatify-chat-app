<style>
    .dropzone {
        /* height: 50px; */
        min-height: 0;
        padding: 0;
    }
    .dropzone .dz-preview {
        display: none;
    }
    .dz-default.dz-message{
        display: none;
    }
</style>

<div class="messenger-sendCard">
    <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data" class="dropzone">
        @csrf
        <label for="fileInput"><span class="fas fa-plus-circle"></span></label>
        <input type="file" id="fileInput" class="upload-attachment" name="file" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}, .{{implode(', .',config('chatify.attachments.allowed_files'))}}" style="display: none;" />
        <button class="emoji-button"></span><span class="fas fa-smile"></span></button>
        <textarea readonly='readonly' name="message" id="message" class="m-send app-scroll" placeholder="Type a message.."></textarea>
        <button type="submit" class="send-button" id="submitButton" disabled='disabled'><span class="fas fa-paper-plane"></span></button>
    </form>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        Dropzone.options.messageForm = {
            autoProcessQueue: false,
            init: function () {
                console.log("Dropzone initialized");
                this.on("error", function (file, message) {
                    console.error("Dropzone error:", message);
                });
                var myDropzone = this;
                document.getElementById("message-form").addEventListener("dragover", function (e) {
                    e.preventDefault();
                    document.getElementById("message-form").classList.add("dragover");
                });

                document.getElementById("message-form").addEventListener("dragleave", function () {
                    document.getElementById("message-form").classList.remove("dragover");
                });

                document.getElementById("message-form").addEventListener("drop", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    document.getElementById("message-form").classList.remove("dragover");
                    var fileInput = document.getElementById("fileInput");
                    fileInput.files = e.dataTransfer.files;
                    var event = new Event('change', { bubbles: true });
                    fileInput.dispatchEvent(event);
                });

                document.getElementById("submitButton").addEventListener("click", function (e) {
                    myDropzone.processQueue();
                });

                myDropzone.on("addedfile", function () {
                    document.getElementById("submitButton").removeAttribute("disabled");
                });

                myDropzone.on("success", function (file, response) {
                    console.log(response.success);
                    console.log(response);
                });

                myDropzone.on("error", function (file, response) {
                    myDropzone.removeFile(file);
                    console.log(response);
                    return false;
                });
            },
            maxFilesize: 12,
            maxFiles: 10,
            resizeQuality: 1.0,
            acceptedFiles: ".jpeg,.jpg,.png,.webp",
            addRemoveLinks: false,
            timeout: 60000,
            // dictDefaultMessage: "Drop your files here or click to upload",
            // dictFallbackMessage: "Your browser doesn't support drag and drop file uploads.",
            // dictInvalidFileType: "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.",
        };
    });

    document.addEventListener('paste', async (e) => {
        e.preventDefault();
        const fileInput = document.getElementById("fileInput");

        if (!fileInput) {
            console.error('File input element not found.');
            return;
        }

        const clipboardData = e.clipboardData || window.clipboardData;

        if (!clipboardData) {
            console.error('Clipboard data not available.');
            return;
        }

    if (clipboardData.files && clipboardData.files.length > 0) {
        Array.from(clipboardData.files).forEach(async (file) => {
            console.log('Pasted file type:', file.type);
            if (file.type.startsWith('image/')) {
                console.log('Adding image file to file input:', file);
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                const event = new Event('change', { bubbles: true });
                fileInput.dispatchEvent(event);

                document.getElementById("submitButton").removeAttribute("disabled");
            }
        });
    }  
    });
    document.getElementById("message").addEventListener('paste', function (e) {
    e.preventDefault();

    const fileInput = document.getElementById("fileInput");

    if (!fileInput) {
        console.error('File input element not found.');
        return;
    }

    const clipboardData = e.clipboardData || window.clipboardData;

    if (!clipboardData) {
        console.error('Clipboard data not available.');
        return;
    }

    if (clipboardData.types.includes('text/plain')) {
        // Handle pasted text
        const pastedText = clipboardData.getData('text/plain');
        const textarea = document.getElementById("message");

        if (textarea) {
            textarea.value = pastedText;
            autosize.update(textarea); // Manually trigger autosize after setting the value
        } else {
            console.error('Textarea element not found.');
        }
    }
});

document.getElementById("message").addEventListener('input', function () {
    autosize.update(this); // Manually trigger autosize on input changes
});
</script>
