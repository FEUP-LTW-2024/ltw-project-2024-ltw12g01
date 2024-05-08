// Select the delete button element
const deleteButton = document.getElementById('deleteButton');

// Add a click event listener to the delete button
deleteButton.addEventListener('click', function() {
    // Action to perform (delete the div element)
    const itemToDelete = document.getElementById('itemToDelete');
    itemToDelete.remove();

    // JavaScript code to execute after the action (optional)
    console.log('Delete button clicked');
    alert('Item deleted successfully!');
});
