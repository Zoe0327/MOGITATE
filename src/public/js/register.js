document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('image');
    const preview = document.createElement('img');
    preview.style.maxWidth = '200px';
    preview.style.marginTop = '10px';

    input.parentNode.appendChild(preview);

    input.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
});
