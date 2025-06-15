GCStore - Online Grocery Shopping Website  
==========================================

👨‍💻 Developed by: [Your Name]  
🗓️  Semester: Autumn 2025  
📁  Project: Assignment 1 (PHP + MySQL)

------------------------------
📌 How to Run the Project:
------------------------------

1. Install XAMPP and run Apache + MySQL.
2. Copy the entire folder `Assignment1` into `C:\xampp\htdocs\`.
3. Open phpMyAdmin (http://localhost/phpmyadmin):
   - Create a new database: `assignment1`
   - Click the database > Import
   - Choose `export.sql` file and click **Go**

4. Open browser and go to:
   👉 http://localhost/Assignment1/index.php

------------------------------
🛒 Features Implemented:
------------------------------

✔ Browse products by category  
✔ Add to cart / Remove / Update quantity  
✔ Floating mini cart preview  
✔ Order confirmation with address + email + phone  
✔ Real-time stock checking before placing order  
✔ Automatic stock deduction after purchase  
✔ Product detail page  
✔ Search and filter support  
✔ Cart UI updates without page reload  
✔ Input validation and error handling  
✔ About / Help / Contact pages included

------------------------------
📝 Notes:
------------------------------

- Cart session lifetime is set to 20 minutes
- Only orders within Australia (address includes 'Australia') are accepted
- State dropdown supports NSW, VIC, QLD, WA, SA, TAS, ACT, NT, Others
- Order success page includes icons and UI styling (see `css/product.css`)
- All PHP, CSS, and JS code are modular and separated

------------------------------
📦 Files:
------------------------------

- `index.php`         → Home page  
- `cart.php`          → Cart page  
- `product.php`       → Product detail page  
- `process_order.php` → Order confirmation logic  
- `delivery.php`      → Delivery form  
- `export.sql`        → MySQL database dump  
- `readme.txt`        → This file  