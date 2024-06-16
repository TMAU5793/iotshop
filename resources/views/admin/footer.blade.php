<!-- Bootstrap core JavaScript-->
<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('assets/js/sb-admin-2.min.js') }}"></script>

<script src="https://cdn.tiny.cloud/1/vi7ggidcim5bkvy3fd4k7qnjktkycdkidysawlyjdkjz03nn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
<script>
    
    function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.display-thumbnail').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        }
    }

    tinymce.init({
        selector: '.tinymce-editer',
        images_upload_url: "{{ route('tinymce.upload') }}",
        image_class_list: [
            {title: 'img-responsive', value: 'img-responsive'},
        ],
        height: 500,
        setup: function (editor) {
        editor.on('init change', function () {
            editor.save();
        });
        },
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',

        image_title: true,
        automatic_uploads: true,
        relative_urls : false,
        remove_script_host : false,
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), { title: file.name });
            };
        };
        input.click();
        }
    });
</script>