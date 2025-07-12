# 💊 Pharmacy Management System (Admin Side Only)

<p align="center">
  <img src="https://img.shields.io/badge/Frontend-HTML%2FCSS%2FJS-blue?style=for-the-badge&logo=html5" />
  <img src="https://img.shields.io/badge/Backend-PHP-green?style=for-the-badge&logo=php" />
  <img src="https://img.shields.io/badge/Database-MySQL-yellow?style=for-the-badge&logo=mysql" />
  <img src="https://img.shields.io/badge/Status-Admin%20Only-orange?style=for-the-badge" />
</p>

> A web-based Pharmacy Management System designed for **admin-side operations only**. This project allows pharmacy administrators to manage medicines, stock, customers, suppliers, invoices, and reports effectively.

---

## 🚀 Overview

**Pharmacy Management System** is a PHP + MySQL-based CRUD application used by pharmacy admins to:

- Manage medicine inventory
- Handle customers and suppliers
- Track purchases/sales
- Generate invoices and reports
- Authenticate admins securely

---

## 🧩 Key Features

- 🧾 **Invoice Management** – Create, view, and print invoices  
- 👥 **Customer Management** – Add and manage customer records  
- 💊 **Medicine CRUD** – Add, edit, delete, and track stock  
- 🚚 **Suppliers** – Add suppliers and log purchases  
- 📦 **Stock Alerts** – Expired and out-of-stock indicators  
- 📈 **Reports** – Printable reports for purchases, sales, and invoices  
- 🔐 **Admin Authentication** – Secure Sign Up and Login

---

## 🛠️ Tech Stack

| Layer      | Technologies Used                  |
|------------|------------------------------------|
| Frontend   | HTML, CSS, JavaScript, Bootstrap   |
| Backend    | PHP (Core PHP, no frameworks)      |
| Database   | MySQL                              |
| Tools      | XAMPP, phpMyAdmin                  |

---

## 📁 Project Structure Overview

```txt
pharmacy-management/
├── bootstrap/                # Bootstrap assets
├── css/                      # Custom stylesheets
├── images/                   # UI images
├── js/                       # JavaScript files
├── php/                      # Optional PHP handlers
├── sections/                 # Reusable components (header/footer)
├── add_customer.php
├── add_medicine.php
├── add_purchase.php
├── add_supplier.php
├── change_password.php
├── home.php                  # Admin dashboard
├── index.html
├── index.php                 # Login entry point
├── login.php
├── logout.php
├── manage_customer.php
├── manage_invoice.php
├── manage_medicine.php
├── manage_medicine_stock.php
├── manage_purchase.php
├── manage_supplier.php
├── my_profile.php
├── new_invoice.php
├── purchase_report.php
├── sales_report.php
├── signup.php
├── pharmacy.sql              # MySQL DB dump
└── README.md

```
---

### 🔐 Admin Access Flow
📝 Sign Up
Store Name

Username

Email

Password

Address

🔐 Login
Username

Password

---

### 🧪 Usage Flow
✅ Sign Up as a pharmacy admin

🔐 Login to your dashboard

➕ Add medicines, customers, and suppliers

🧾 Create invoices, manage purchases and sales

📈 Generate and print reports

⚠️ Monitor stock levels, expired/out-of-stock alerts

---

### ⚙️ How to Run the Project Locally
✅ Requirements
XAMPP / MAMP / WAMP (local PHP & MySQL server)

Browser & Internet connection

---

### 🔧 Steps

Move Project to Server Directory

# Move the entire folder to:

C:/xampp/htdocs/pharmacy-management/

Start Apache and MySQL in XAMPP

Import the Database

Open phpMyAdmin

Create a database (e.g., pharmacy)

Import pharmacy.sql file

---

### Configure DB Connection (if needed)

$host = "localhost";

$user = "root";

$pass = "";

$db   = "pharmacy";

Run the Application

--- 
# Open in browser:

http://localhost/pharmacy-management/index.php

📷 Screenshots
![ss3 0](https://github.com/user-attachments/assets/548d915b-cdff-4916-b2e0-3cb2a2768fa7)
🏠 Dashboard

---

## 📄 License

This project is licensed under the **MIT License © 2025**

> "Connecting Minds, Building Futures."

---

## 👤 Author

**Kapupara Krushil**  
📧 Email: [krusilkapupara456@gmail.com](mailto:krusilkapupara456@gmail.com)  
🔗 GitHub: [@Krushil45](https://github.com/Krushil45)  
🔗 LinkedIn: [krushil-kapupara](https://www.linkedin.com/in/krushil-kapupara)

---

## 🤝 Contributions

We welcome contributions of all types:
💡 Ideas | 🐛 Bug Fixes | 📖 Docs | 💻 Code

### To contribute:

1. **Fork** this repository  
2. **Create** a feature branch  
3. **Make changes** and commit  
4. **Submit** a Pull Request (PR)  

Let’s build something impactful together! 🚀


