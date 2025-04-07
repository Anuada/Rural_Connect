const showImage = (event) => {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}