document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("update-form");
  const cartBody = document.getElementById("cart-body");
  const cartTotal = document.getElementById("cart-total");

  function refreshCartUI(data) {
    data.items.forEach(item => {
      const row = document.querySelector(`tr[data-product-id='${item.id}']`);
      if (row) {
        row.querySelector(".subtotal").textContent = "$" + item.subtotal;
        row.querySelector(`input[name='quantities[${item.id}]']`).value = item.quantity;
      }
    });
    cartTotal.textContent = "$" + data.total;

    if (data.items.length === 0 || data.empty) {
      cartBody.innerHTML = '<tr><td colspan="5">Your cart is empty.</td></tr>';
      cartTotal.textContent = "$0.00";
    }
  }

  form.addEventListener("submit", function(e) {
    // Preventing the default behavior of an event
    e.preventDefault(); 
    const formData = new FormData(form);

    fetch("update_cart.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === "success") {
        refreshCartUI(data);
      } else {
        alert(" Update failed: " + data.message);
      }
    })
    .catch(err => {
      console.error("Failed to update cart:", err);
    });
  });

  document.querySelectorAll(".btn-remove").forEach(button => {
    button.addEventListener("click", () => {
      const productId = button.dataset.id;

      fetch("remove_from_cart.php", {
        method: "POST",
        body: new URLSearchParams({ product_id: productId })
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === "success") {
          const row = document.querySelector(`tr[data-product-id='${productId}']`);
          if (row) row.remove();
          form.dispatchEvent(new Event("submit")); // ✅ 或改为 refreshCart()
        } else {
          alert("❌ Remove failed: " + data.message);
        }
      });
    });
  });
});

