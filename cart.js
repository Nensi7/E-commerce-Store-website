document.addEventListener("DOMContentLoaded", () => {
    // Function to update the cart summary (total items and total price)
    function updateCartSummary() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        let totalItems = 0;
        let totalPrice = 0;

        cart.forEach(item => {
            totalItems++;
            totalPrice += parseFloat(item.price);
        });

        document.getElementById("total-items").textContent = totalItems;
        document.getElementById("total-price").textContent = totalPrice.toFixed(2);
    }

    // Handle "Remove from Cart" button click
    const removeButtons = document.querySelectorAll(".remove-from-cart");

    removeButtons.forEach(button => {
        button.addEventListener("click", (e) => {
            const index = e.target.getAttribute("data-index");
            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            // Remove the item from the cart array
            cart.splice(index, 1);

            // Update the cart in localStorage
            localStorage.setItem("cart", JSON.stringify(cart));

            // Refresh the page to update the cart display
            window.location.reload();
        });
    });

    // Initialize the cart summary
    updateCartSummary();
});
