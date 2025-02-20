<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('select-label-category');
        const subcategorySelect = document.getElementById('select-label-subcategory');

        categorySelect.addEventListener('change', function() {
            const categoryId = this.value;

            subcategorySelect.innerHTML = '<option selected>Loading...</option>';
            subcategorySelect.disabled = true;

            if (categoryId) {
                fetch(`/get-subcategories/${categoryId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        subcategorySelect.innerHTML = '<option selected>Select a subcategory</option>';
                        if (data.length > 0) {
                            data.forEach(subcategory => {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.nama_sub_kategori;
                                subcategorySelect.appendChild(option);
                            });
                            subcategorySelect.disabled = false;
                        } else {
                            subcategorySelect.innerHTML = '<option selected>No subcategories found</option>';
                        }
                    })
                    .catch(error => {
                        subcategorySelect.innerHTML = '<option selected>No subcategories found</option>';
                    });
            } else {
                subcategorySelect.innerHTML = '<option selected>Select a category first</option>';
            }
        });
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tagSearchInput = document.getElementById('tag-search');
            var addTagBtn = document.getElementById('add-tag-btn');
            var tagsContainer = document.getElementById('tags-container');

            function reorderTags() {
                var tags = Array.from(tagsContainer.querySelectorAll('.tag-item'));
                var checkedTags = tags.filter(tag => tag.querySelector('input').checked);
                var uncheckedTags = tags.filter(tag => !tag.querySelector('input').checked);
                tagsContainer.innerHTML = '';
                checkedTags.forEach(tag => tagsContainer.appendChild(tag));
                uncheckedTags.forEach(tag => tagsContainer.appendChild(tag));
            }

            tagSearchInput.addEventListener('keyup', function() {
                var searchQuery = this.value.toLowerCase();
                var tags = document.querySelectorAll('#tags-container .tag-item');
                var tagFound = false;

                tags.forEach(function(tag) {
                    var tagName = tag.querySelector('label').innerText.toLowerCase();
                    if (tagName.includes(searchQuery)) {
                        tag.style.display = 'flex';
                        tagFound = true;
                    } else {
                        tag.style.display = 'none';
                    }
                });

                if (!tagFound && searchQuery !== '') {
                    addTagBtn.style.display = 'inline-flex';
                } else {
                    addTagBtn.style.display = 'none';
                }
            });

            addTagBtn.addEventListener('click', function() {
                var newTag = tagSearchInput.value.trim();

                if (newTag !== '') {
                    fetch('{{ route('tags.addtag') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            nama_tags: newTag
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            var newTagItem = document.createElement('div');
                            newTagItem.classList.add('tag-item', 'flex', 'items-center');
                            newTagItem.innerHTML = `
                                <input type="checkbox" id="tag-${data.id}" name="tags[]" value="${data.id}" class="form-checkbox" checked>
                                <label for="tag-${data.id}" class="ml-2">${data.nama_tags}</label>
                            `;
                            tagsContainer.appendChild(newTagItem);

                            reorderTags();

                            tagSearchInput.value = '';
                            addTagBtn.style.display = 'none';
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while adding the tag.');
                    });
                }
            });

            tagsContainer.addEventListener('change', function(event) {
                if (event.target.matches('input[type="checkbox"]')) {
                    reorderTags();
                }
            });
        });
</script>

<script src="{{ asset('assets/js/quill.min.js') }}"></script>

<script>
    var BlockEmbed = Quill.import('blots/block/embed');

    class ImageBlot extends BlockEmbed {
        static create(value) {
            let node = super.create();

            // Create the necessary HTML structure
            let img = document.createElement('img');
            img.setAttribute('src', value.image); // Use 'image' for base64 or other data

            let caption = document.createElement('i');
            caption.innerText = value.caption || ''; // Leave empty if no caption is provided

            // Wrap everything inside a custom element to resemble the [caption] shortcode format
            node.innerHTML = `[caption]<img src="${value.image}" /> <i>${caption.innerText}</i>[/caption]`;

            return node;
        }

        static value(node) {
            // Extract image src and caption text from the node
            let img = node.querySelector('img');
            let caption = node.querySelector('i');
            return {
                image: img ? img.getAttribute('src') : '', // Storing 'image' instead of 'url'
                caption: caption ? caption.innerText : '' // This will be empty if no caption is provided
            };
        }
    }

    ImageBlot.blotName = 'imageWithCaption';
    ImageBlot.tagName = 'div';
    Quill.register(ImageBlot);

    var quill = new Quill('#snow-editor', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: [
                    [{ 'size': [] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub' }, { 'script': 'super' }],
                    [{ 'header': 1 }, { 'header': 2 }, 'blockquote', 'code-block'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                    ['direction', { 'align': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ],
                handlers: {
                    image: function() {
                        var fileInput = document.createElement('input');
                        fileInput.setAttribute('type', 'file');
                        fileInput.setAttribute('accept', 'image/*');
                        fileInput.click();

                        fileInput.onchange = () => {
                            var file = fileInput.files[0];

                            if (file.size > 2 * 1024 * 1024) {
                                alert('Image harus kurang dari 2 MB.');
                                return;
                            }

                            var reader = new FileReader();

                            reader.onload = (e) => {
                                var range = quill.getSelection();
                                var caption = prompt('Enter caption (leave blank for none):');

                                var imageName = file.name;
                                var existingImages = document.querySelectorAll('img[src^="data:image"]');
                                var imageCount = 0;

                                existingImages.forEach((img) => {
                                    if (img.src === e.target.result) {
                                        imageCount++;
                                    }
                                });

                                if (imageCount > 0) {
                                    var fileExtension = imageName.split('.').pop();
                                    imageName = imageName.replace(`.${fileExtension}`, `(${imageCount}).${fileExtension}`);
                                }

                                quill.insertEmbed(range.index, 'imageWithCaption', {
                                    image: e.target.result,
                                    caption: caption
                                });
                            };

                            reader.readAsDataURL(file); 
                        };
                    }
                }
            }
        }
    });

    // Load the existing content into the Quill editor
    var existingContent = document.getElementById('editor-content').value;
    quill.clipboard.dangerouslyPasteHTML(existingContent);

    document.getElementById('contentForm').addEventListener('submit', function() {
        var editorContent = document.querySelector('#snow-editor .ql-editor').innerHTML;

        // Store the editor content into the hidden input field for database storage
        document.getElementById('editor-content').value = editorContent;
    });
</script>

<script>
    function convertSocialMediaLink(url) {
        let regex = /https:\/\/www\.instagram\.com\/(p|reel|tv)\/([^\/?]+)\//;
        let match = url.match(regex);
        if (match) {
            const postId = match[2];  // Extract post or reel ID
            return `https://www.instagram.com/p/${postId}/embed`;  // Always return /p/{postId}/embed format
        }

        regex = /https:\/\/www\.tiktok\.com\/@[^\/]+\/video\/([^\/?]+)/;
        match = url.match(regex);
        if (match) {
            const videoId = match[1];
            return `https://www.tiktok.com/embed/v2/${videoId}`;
        }

        regex = /https:\/\/x\.com\/[^\/]+\/status\/([^\/?]+)/;
        match = url.match(regex);
        if (match) {
            const tweetId = match[1];
            return `https://platform.twitter.com/embed/Tweet.html?id=${tweetId}`;
        }

        regex = /https:\/\/www\.youtube\.com\/watch\?v=([^\/&?]+)/;
        match = url.match(regex);
        if (match) {
            const videoId = match[1];
            return `https://www.youtube.com/embed/${videoId}`;
        }

        throw new Error('URL tidak valid atau tidak didukung.');
    }

    function insertVideo() {
        const url = document.getElementById('video-url').value;

        try {
            const embedUrl = convertSocialMediaLink(url);

            document.getElementById('embed-url').value = embedUrl;
            document.getElementById('embed-container').style.display = 'block';
        } catch (error) {
            alert(`Error: ${error.message}`);
        }
    }

    function copyEmbedUrl() {
        const embedUrlInput = document.getElementById('embed-url');

        embedUrlInput.select();
        embedUrlInput.setSelectionRange(0, 99999);

        document.execCommand("copy");
        alert("Embed URL copied to clipboard: " + embedUrlInput.value);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var statusRadios = document.querySelectorAll('input[name="status"]');
        var scheduleFields = document.getElementById('schedule-fields');

        function updateFieldsVisibility() {
            var selectedStatus = document.querySelector('input[name="status"]:checked').value;

            if (selectedStatus === 'schedule') {
                scheduleFields.style.display = 'grid';
            } else {
                scheduleFields.style.display = 'none';
            }
        }
        updateFieldsVisibility();
        statusRadios.forEach(function(radio) {
            radio.addEventListener('change', updateFieldsVisibility);
        });
    });
</script>


<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';

        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const card = document.createElement('div');
                card.classList.add('card', 'm-2', 'border', 'shadow-sm', 'text-center', 'rounded');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('card-img-top');
                img.style.height = '200px';
                img.style.objectFit = 'cover';

                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body');

                const cardTitle = document.createElement('h5');
                cardTitle.classList.add('card-title');

                cardBody.appendChild(cardTitle);
                card.appendChild(img);
                card.appendChild(cardBody);
                imagePreview.appendChild(card);
            };

            reader.readAsDataURL(file);
        }
    });
    </script>
