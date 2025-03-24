function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();

    reader.onload = function () {
        const preview = document.getElementById('profile-preview');
        preview.src = reader.result;
    }

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}
