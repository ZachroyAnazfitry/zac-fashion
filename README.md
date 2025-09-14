# Zac Fashion

**Zac Fashion** is an e-commerce website built using the Laravel framework, MySQL database, and modern front-end technologies. The goal of this project is to deliver a user-friendly online platform where customers can seamlessly browse and purchase fashion products.

---

## 🚀 Project Overview

Zac Fashion is designed to provide an engaging and smooth online shopping experience with features such as product browsing, search and filtering, shopping cart, and a secure checkout process.

### **Key Features**

- **User Registration & Authentication:**  
  Secure sign-up and login for customers.

- **Product Browsing:**  
  Users can view products by category, search, and filter by price or brand.

- **Shopping Cart:**  
  Add, update, or remove products from the cart.

- **Order Management:**  
  Place orders and view order history.

- **Admin Dashboard:**  
  Manage inventory, products, categories, and customer orders.

- **Responsive Design:**  
  Optimized for mobile and desktop devices.

---

## 🛠️ Tech Stack

- **Backend:** Laravel (PHP)
- **Database:** MySQL
- **Frontend:** HTML, CSS, SCSS, JavaScript, Blade templating
- **Other:** Responsive design, Admin panel

---

## 📸 Screenshots

<!-- Add your screenshots here -->
<p align="center">
  <img src="screenshots/homepage.png" alt="Home Page" width="600"/>
  <br>
  <img src="screenshots/products.png" alt="Products Page" width="600"/>
  <br>
  <img src="screenshots/cart.png" alt="Cart Page" width="600"/>
</p>

---

## ⚙️ Setup & Installation

```bash
# 1. Clone the repository
git clone https://github.com/ZachroyAnazfitry/zac-fashion.git

# 2. Install dependencies
cd zac-fashion
composer install
npm install

# 3. Copy .env file and set your environment variables
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Run migrations and seeders
php artisan migrate --seed

# 6. Start the development server
php artisan serve

# 7. (Optional) Compile frontend assets
npm run dev
```

---

## 📝 Usage

1. Register as a new user or log in.
2. Browse products, add them to your cart, and proceed to checkout.
3. Admin users can access the dashboard to manage products, inventory, and orders.

---

## 👨‍💻 Contributing

Contributions are welcome! Please open an issue or pull request for suggestions, bug reports, or improvements.

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

## 💡 Acknowledgments

- Laravel Documentation
- Open Source Community

---

**Project by [ZachroyAnazfitry](https://github.com/ZachroyAnazfitry)**
