function triggerFileInput() {
    document.getElementById('hiddenInput').click();
    console.log('triggered');
}

function handleImageDragAndDrop() {
    const dropArea = document.querySelector('.border');
    dragText = dropArea.querySelector("p");
    
    let file; 
    //if user Drag file over drag area
    dropArea.addEventListener("dragover",(event)=>  {
        event.preventDefault();
        dropArea.classList.add("active");
        dragText.textContent = "Release to Upload File";

    });

    //if user leave dragged file from DragArea
    dropArea.addEventListener("dragleave",(event)=>  {
        event.preventDefault();
        dropArea.classList.remove("active");
        dragText.textContent = "Drag and Drop file here";
    });

    //if user drop file on DragArea
    dropArea.addEventListener("drop",(event)=>  {
        event.preventDefault();

        //getting user select file and [0] this means if user select 
        //multiple files then we'll select only the first one 
        file = event.dataTransfer.files[0];
        let fileType = file.type;
        console.log(fileType);

        let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
        if(validExtensions.includes(fileType)){
            let fileReader = new FileReader(); //creating new FileReader object
            fileReader.onload = ()=>{
                let fileURL = fileReader.result; //passing user file source in fileURL variable
                let imgTag = `<img src="${fileURL}" alt="">`; //creating an img tag and passing user selected file source inside src attribute
                dropArea.innerHTML = imgTag; //adding that created img tag inside dropArea container
            }
            fileReader.readAsDataURL(file);
        }else{
            alert("This is not an image file");
            dropArea.classList.remove("active");
        }
    });
}

function handleImageUpload() {
    const image_input = document.querySelector('#hiddenInput');

    image_input.addEventListener("change", function() {
        const reader = new FileReader();

        reader.addEventListener("load", ()=> {
            const uploaded_image = reader.result;

            const xhr = new XMLHttpRequest();

            const url = '../actions/actions_image.php';

            const formData = new FormData();
            formData.append('image', uploaded_image);

            xhr.open('POST', url, true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Image uploaded successfully.');
                } else {
                    console.error('Image upload failed.');
                }
            };

            xhr.onerror = function() {
                console.error('Error occurred while uploading image.');
            };

            xhr.send(formData);

            document.querySelector('.border').style.backgroundImage = `url(${uploaded_image})`;
            const Display_none = document.querySelectorAll('.border * '); 
            Display_none.forEach(element => {
                element.style.display = 'none';
            });
        });

        reader.readAsDataURL(this.files[0]);
    });
}



handleImageUpload();

handleImageDragAndDrop();
