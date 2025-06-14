document.addEventListener("DOMContentLoaded", () => {
    // Add event listeners to "Add to Cart" buttons
    const addToCartButtons = document.querySelectorAll(".add-to-cart");

    addToCartButtons.forEach(button => {
        button.addEventListener("click", () => {
            const productName = button.getAttribute("data-product");
            const productPrice = button.getAttribute("data-price");

            // Save product to local storage cart
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.push({ name: productName, price: productPrice });
            localStorage.setItem("cart", JSON.stringify(cart));

            alert(`${productName} added to cart!`);
        });
    });
});

