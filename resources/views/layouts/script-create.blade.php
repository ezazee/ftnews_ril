<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('select-label-category');
        const subcategorySelect = document.getElementById('select-label-subcategory');

        categorySelect.addEventListener('change', function() {
            const categoryId = this.value;

            subcategorySelect.innerHTML = '<option value="" selected>Loading...</option>';
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
                        subcategorySelect.innerHTML =
                            '<option value="" selected>Select a subcategory</option>';
                        if (data.length > 0) {
                            data.forEach(subcategory => {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.nama_sub_kategori;
                                subcategorySelect.appendChild(option);
                            });
                            subcategorySelect.disabled = false;
                        } else {
                            subcategorySelect.innerHTML =
                                '<option value="" selected>No subcategories found</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching subcategories:', error);
                        subcategorySelect.innerHTML =
                            '<option value="" selected>No subcategories found</option>';
                    });
            } else {
                subcategorySelect.innerHTML =
                    '<option value="" selected>Select a category first</option>';
            }
        });
    });
</script>

<script>
    let selectedImage = null; // Variabel untuk menyimpan gambar yang dipilih sebelumnya

    function selectImage(imgElement) {
        // Jika ada gambar yang dipilih sebelumnya, hapus kelas 'selected'
        if (selectedImage) {
            selectedImage.classList.remove('border-4', 'border-blue-500');
        }

        // Simpan gambar yang baru diklik sebagai gambar yang dipilih
        selectedImage = imgElement;

        // Tambahkan kelas 'selected' ke gambar yang baru dipilih
        imgElement.classList.add('border-4', 'border-blue-500');
    }
</script>

<script src="{{ asset('assets/js/quill.min.js') }}"></script>
<script>
    var BlockEmbed = Quill.import('blots/block/embed');

    class ImageBlot extends BlockEmbed {
        static create(value) {
            let node = super.create();

            if (value.image) {
                let img = document.createElement('img');
                img.setAttribute('src', value.image); 
                let caption = document.createElement('i');
                caption.innerText = value.caption || ''; 

                node.innerHTML = `[caption]<img src="${value.image}" /> <i>${caption.innerText}</i>[/caption]`;
            }

            return node;
        }

        static value(node) {
            let img = node.querySelector('img');
            let caption = node.querySelector('i');
            return {
                image: img ? img.getAttribute('src') : '', 
                caption: caption ? caption.innerText : ''
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
                                alert('Gambar harus kurang dari 2 MB.');
                                return;
                            }

                            var reader = new FileReader();

                            reader.onload = (e) => {
                                var range = quill.getSelection();
                                var caption = prompt('Masukkan caption (biarkan kosong jika tidak ada):');

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

    // Nonaktifkan ImageBlot saat paste
    quill.clipboard.addMatcher(Node.ELEMENT_NODE, function(node, delta) {
        // Cek jika konten yang di-paste memiliki banyak paragraf
        if (delta.ops.length > 10) {
            // Hapus blok embed untuk teks panjang
            delta.ops = delta.ops.filter(op => !op.insert.imageWithCaption);
        }
        return delta;
    });

    document.getElementById('contentForm').addEventListener('submit', function() {
        var editorContent = document.querySelector('#snow-editor .ql-editor').innerHTML;
        document.getElementById('editor-content').value = editorContent;
    });
</script>



<script>
    function convertSocialMediaLink(url) {
        let regex = /https:\/\/www\.instagram\.com\/(p|reel|tv)\/([^\/?]+)\//;
        let match = url.match(regex);
        if (match) {
            const postId = match[2]; // Extract post or reel ID
            return `https://www.instagram.com/p/${postId}/embed`; // Always return /p/{postId}/embed format
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


<script>
    function selectImage(imageName, caption) {
        document.getElementById('selected-image-name').textContent = imageName;

        const previewImage = document.getElementById('selected-image-preview');
        previewImage.src = "{{ asset('storage') }}/" + imageName;

        const captionInput = document.getElementById('image-caption-input');
        if (caption && caption.trim() !== '') {
            captionInput.value = caption;
        } else {
            captionInput.value = '';
            captionInput.placeholder = "Enter Image Caption";
        }
    }
</script>


<script>
    const input = document.getElementById('input');
    const gallery = document.getElementById('gallery');
    const emptyMessage = document.getElementById('empty');

    input.addEventListener('change', () => {
        const files = input.files;
        gallery.innerHTML = '';

        if (files.length > 0) {
            Array.from(files).forEach(file => {
                const listItem = document.createElement('li');

                const image = document.createElement('img');
                image.src = URL.createObjectURL(file);
                image.alt = file.name;
                image.className = 'w-full h-36 object-cover object-center rounded';

                listItem.appendChild(image);
                gallery.appendChild(listItem);
            });
            emptyMessage.style.display = 'none';
        } else {
            emptyMessage.style.display = 'flex';
        }
    });
</script>

<script>
    let lastCheckedIndex = null;

function toggleCheckbox(index) {
    // Jika ada gambar sebelumnya yang dipilih, hilangkan highlight dan uncheck checkbox
    if (lastCheckedIndex !== null && lastCheckedIndex !== index) {
        const lastCheckbox = document.getElementById('checkbox-' + lastCheckedIndex);
        const lastImage = document.getElementById('image-' + lastCheckedIndex);
        lastCheckbox.checked = false;
        lastImage.classList.remove('ring-4', 'ring-blue-500', 'opacity-75');
    }

    // Toggle checkbox yang dipilih
    const checkbox = document.getElementById('checkbox-' + index);
    checkbox.checked = !checkbox.checked;
    highlightImage(index);

    // Simpan index terakhir yang dipilih
    if (checkbox.checked) {
        lastCheckedIndex = index;
    } else {
        lastCheckedIndex = null;
    }
}

function highlightImage(index) {
    const checkbox = document.getElementById('checkbox-' + index);
    const image = document.getElementById('image-' + index);

    if (checkbox.checked) {
        image.classList.add('ring-4', 'ring-blue-500', 'opacity-75');
    } else {
        image.classList.remove('ring-4', 'ring-blue-500', 'opacity-75');
    }
}


document.getElementById('image-caption-input').addEventListener('focus', function(event) {
    event.preventDefault();
});


function filterImages() {
        const searchInput = document.getElementById('search-input').value.toLowerCase();
        const images = document.querySelectorAll('#image-grid > div');

        images.forEach(image => {
            const imageName = image.querySelector('p').textContent.toLowerCase();
            if (imageName.includes(searchInput)) {
                image.style.display = '';
            } else {
                image.style.display = 'none';
            }
        });
    }
</script>
