//// create_blog.php ////

// Image preview functionality
document.getElementById('blogImages').addEventListener('change', function (event) {
    const previewContainer = document.getElementById('imagePreviewContainer');
    previewContainer.innerHTML = '';

    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (!file.type.match('image.*')) continue;

        const reader = new FileReader();
        reader.onload = function (e) {
            const previewDiv = document.createElement('div');
            previewDiv.className = 'image-preview-container';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'image-preview';

            const removeBtn = document.createElement('button');
            removeBtn.className = 'remove-image-btn';
            removeBtn.innerHTML = '×';
            removeBtn.onclick = function () {
                previewDiv.remove();
                // Create a new DataTransfer object to update the file input
                const dataTransfer = new DataTransfer();
                const input = document.getElementById('blogImages');

                // Add all files except the one being removed
                for (let j = 0; j < input.files.length; j++) {
                    if (j !== i) {
                        dataTransfer.items.add(input.files[j]);
                    }
                }

                input.files = dataTransfer.files;
                return false;
            };

            previewDiv.appendChild(img);
            previewDiv.appendChild(removeBtn);
            previewContainer.appendChild(previewDiv);
        };
        reader.readAsDataURL(file);
    }
});

// Prevent form resubmission on page refresh
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

//// dashboard.php //// 

// Toggle sidebar on mobile
document.querySelector('.sidebar-toggle').addEventListener('click', function () {
    document.querySelector('.sidebar').classList.toggle('show');
    document.querySelector('.sidebar-overlay').style.display = 'block';
});

// Close sidebar when clicking overlay
document.querySelector('.sidebar-overlay').addEventListener('click', function () {
    document.querySelector('.sidebar').classList.remove('show');
    this.style.display = 'none';
});

// Auto-hide sidebar when clicking a link (mobile)
document.querySelectorAll('.sidebar .nav-link').forEach(link => {
    link.addEventListener('click', function () {
        if (window.innerWidth < 992) {
            document.querySelector('.sidebar').classList.remove('show');
            document.querySelector('.sidebar-overlay').style.display = 'none';
        }
    });
});
