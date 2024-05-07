const productElements = document.querySelectorAll('.product');

productElements.forEach((productElement) => {
  productElement.addEventListener('click', (event) => {
    const productId = event.target.dataset.productId;
    const quantity = event.target.dataset.quantity;

    fetch('../actions/action_cart.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ productId, quantity }),
    })
      .then((response) => response.json())
      .then((data) => {
        const cartElement = document.getElementById('cart');
        cartElement.innerHTML = '';
        data.products.forEach((product) => {
          const productElement = document.createElement('div');
          productElement.innerHTML = `
            <p>${product.name}</p>
            <p>Quantity: ${product.quantity}</p>
            <p>Price: ${product.price}</p>
          `;
          cartElement.appendChild(productElement);
        });
      });
  });
});