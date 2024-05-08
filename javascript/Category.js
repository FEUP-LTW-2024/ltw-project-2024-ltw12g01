
let newContentVisible = false;
let selectedItem = null;


function hideCategoryOnClick(svgElement) {
    svgElement.addEventListener('click', function() {
        const parentDiv = svgElement.closest('.new-content');
        
        if (parentDiv) {
            
            parentDiv.style.display = 'none';
            
            document.body.style.overflowY = 'auto';
            
            newContentVisible = false;
        }
    });
}

function handleSaveClick() {
    const saveButton = document.querySelector('.new-content .content .btn-category');
    const category_div = saveButton.closest('.new-content');
    const placeholder = document.querySelector('-choose-cat input::placeholder');

    console.log(category_div);

    saveButton.addEventListener('click', function() {
        const category_input = document.querySelector('.choose-cat input');
        const category_content = selectedItem.textContent;

        console.log(category_content);
        category_input.placeholder = category_content;
        
        document.body.style.overflowY = 'auto'
        category_div.style.display = 'none';

        
});
}

function handleListClick() {
    
    
    const listItems = document.querySelectorAll('.new-content .content ul li');
    const saveButton = document.querySelector('.new-content .content .btn-category');
    
    listItems.forEach((listItem) => {
        listItem.addEventListener('click', function() {
             if (selectedItem) {
                selectedItem.style.backgroundColor = ''; 
            }
            
            
            listItem.style.backgroundColor = '#e8e8e8';
            
            saveButton.classList.remove('animate-rotate');
            void saveButton.offsetWidth;
            saveButton.classList.add('animate-rotate');
           
            selectedItem = listItem;
            
        });
    });
}


function handleClick() {
    const chooseCat = document.querySelectorAll('.choose-cat input, .choose-cat svg');
    const backColor = document.querySelector('.sell');

    chooseCat.forEach((element) => {
        element.addEventListener('click', function() {
            if (!newContentVisible) {
                
                const category = `
                    <div class="new-content">
                        <div class="categoryHeader">
                            <span>Category</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                            </svg>
                        </div>
                        <div class="content">
                        <ul>
                <!-- Each list item includes a checkbox with a value to be submitted -->
                <li>
                    <input type="checkbox" name="category" value="Women"> Women
                </li>
                <li>
                    <input type="checkbox" name="category" value="Men"> Men
                </li>
                <li>
                    <input type="checkbox" name="category" value="Kids"> Kids
                </li>
                <li>
                    <input type="checkbox" name="category" value="Sneakers"> Sneakers
                </li>
                <li>
                    <input type="checkbox" name="category" value="Shoes"> Shoes
                </li>
            </ul>
                        <button class="btn-category">Save</button>
                        </div>
                    </div>
                `;       
                
                document.body.insertAdjacentHTML('beforeend', category);
                const svgElement = document.querySelector('.new-content .categoryHeader svg');
                
                handleListClick();
                handleSaveClick();   
                hideCategoryOnClick(svgElement);

                newContentVisible = true;
                document.body.style.overflowY = 'hidden';
            }
        });
    });
}


handleClick();
