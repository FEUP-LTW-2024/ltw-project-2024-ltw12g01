const categoryInput = document.getElementById('category-input');
const categoryOptions = document.getElementById('category-options');

categoryInput.addEventListener('click', () => {
  categoryOptions.style.display = 'block';
});

categoryOptions.addEventListener('click', (e) => {
  if (e.target.tagName === 'OPTION') {
    categoryInput.value = e.target.textContent;
    categoryOptions.style.display = 'none';
  }
});