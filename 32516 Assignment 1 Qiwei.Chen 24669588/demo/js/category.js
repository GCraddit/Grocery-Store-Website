document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".cart-form").forEach(form => {
        const addBtn = form.querySelector(".add-to-cart-btn");
        const controls = form.querySelector(".cart-controls");
        const qtyInput = form.querySelector(".quantity-input");
        const minusBtn = form.querySelector(".decrease-btn");
        const plusBtn = form.querySelector(".increase-btn");
        // Out of stock button
        const parentCard = form.closest(".product-card");
        if (parentCard && parentCard.classList.contains("out-of-stock")) {
            addBtn.disabled = true;
            addBtn.textContent = "Out of Stock";
            addBtn.classList.add("disabled");
            controls.style.opacity = "0.5";
            controls.querySelectorAll("button").forEach(btn => btn.disabled = true);
            qtyInput.disabled = true;
            return; 
        }

        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(form);

            fetch("add_to_cart.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    refreshCartPreview();
                } else {
                    alert("Add failed: " + data.message);
                }
            })
            .catch(err => {
                console.error("Add Error:", err);
                alert("Failed to add to cart.");
            });
        });

        plusBtn.addEventListener("click", () => {
            let qty = parseInt(qtyInput.value);
            qtyInput.value = qty + 1;
        });

        minusBtn.addEventListener("click", () => {
            let qty = parseInt(qtyInput.value);
            if (qty > 1) {
                qtyInput.value = qty - 1;
            } else {
                alert("The quantity cannot be less than 1");
            }
        });
    });
});
