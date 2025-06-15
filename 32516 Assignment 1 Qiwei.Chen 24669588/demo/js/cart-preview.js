let isRemoveListenerBound = false; 
//Prevent duplicate binding of delete button listener

document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.querySelector(".cart-toggle");
  const cartPreview = document.getElementById("cart-preview");

  toggleButton.addEventListener("click", () => {
    if (cartPreview.classList.contains("show")) {
      cartPreview.classList.remove("show");
      cartPreview.innerHTML = '';
    } else {
      refreshCartPreview();
    }
  });

  if (!isRemoveListenerBound) {
    cartPreview.addEventListener("click", function (e) {
      if (e.target.classList.contains("remove-btn")) {
        const productId = e.target.dataset.id;
        console.log("Click the Delete button", productId);

        fetch("remove_from_cart.php", {
          method: "POST",
          body: new URLSearchParams({ product_id: productId })
        })
          .then(res => res.json())
          .then(data => {
            if (data.status === "success") {
              refreshCartPreview();
            } else {
              alert("Deletion failed：" + data.message);
            }
          });
      }
    });
    isRemoveListenerBound = true;
  }
});

  
  function clearCart() {
    fetch("clear_cart.php", {
      method: "POST"
    })
      .then(res => res.json())
      .then(data => {
        if (data.status === "success") {
          document.querySelector(".cart-float button").click();
        } else {
          alert("Clear failed");
        }
      });
  }
  
  function updateCartPreviewDOM(data) {
    const cartPreview = document.getElementById("cart-preview");
    if (!cartPreview) return;
  
    if (data.items.length > 0) {
      let html = '<div class="cart-item-list">';
      data.items.forEach(item => {
        html += `
          <div class="cart-item-box">
            <span class="item-name">${item.product_name}</span>
            <span class="item-details">x ${item.quantity} = $${item.subtotal}</span>
            <button class="remove-btn" data-id="${item.product_id}">X</button>
          </div>`;
      });
      html += '</div>';
      html += `<p class="cart-total">Total: <strong>$${data.total}</strong></p>`;
      html += `
        <div class="cart-actions">
          <a href="cart.php" class="cart-button">Go to Cart</a>
          <button class="cart-clear-btn" onclick="clearCart()">Clear Cart</button>
        </div>`;
  
      cartPreview.innerHTML = html;
    } else {
      cartPreview.innerHTML = '<p class="empty-msg">Your cart is empty.</p>';
    }
  
    cartPreview.classList.add("show");
  }
//Refresh shopping cart contents (AJAX)
  function refreshCartPreview() {
    fetch("cart_preview.php")
      .then(res => res.json())
      .then(data => {
        console.log("Shopping cart data：", data);  
        updateCartPreviewDOM(data);
      })
      .catch(err => {
        console.error("Refresh preview failed", err);
      });
  }

  