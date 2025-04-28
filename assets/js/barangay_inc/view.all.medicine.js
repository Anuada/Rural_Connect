const productCardEl = document.querySelectorAll('.product-card');

productCardEl.forEach(product => {
    product.addEventListener('click', () => {
        const link = product.getAttribute('data-redirect');
        window.location.href = link;
    });
});