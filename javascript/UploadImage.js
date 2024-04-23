function triggerFileInput() {
    document.getElementById('hiddenInput').click();
    console.log('triggered');
}

function handleImageUpload(event) {
    console.log('handling image upload');
    const files = event.target.files;
    const borderDiv = document.querySelector('.border');

    const uploadedImagesDiv = borderDiv.querySelector('.uploaded-images');
    uploadedImagesDiv.innerHTML = '';

    for (const file of files) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);

        uploadedImagesDiv.appendChild(img);
    }

}


