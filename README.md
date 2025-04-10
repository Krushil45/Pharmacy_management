# 💊 Pharmacy Management System (Admin Side Only)

A web-based **Pharmacy Management System** designed for **administrative use** only. It enables pharmacy administrators to manage medicines, stock, customers, suppliers, invoices, and reports efficiently. Built using **HTML**, **CSS**, **JavaScript**, **PHP**, **MySQL**, and **Bootstrap**.

---

## 🧰 Features

- 🧾 **Invoice Management**: Create and print invoices.
- 👥 **Customer Management**: Add and manage customer data.
- 💊 **Medicine Management**: Add, edit, delete medicines.
- 📦 **Stock Tracking**: Manage medicine stock, including **expired** or **out-of-stock** alerts.
- 🚚 **Supplier Management**: Add suppliers and manage medicine purchases.
- 📈 **Reports**:
  - Purchase Report
  - Sales Report
  - Invoice Report
  - All reports are **printable**
- 🔐 **Admin Authentication**:
  - **Sign up** with store name, username, email, password, and address.
  - **Login** using username and password.

---

## 🛠️ Technologies Used

| Frontend         | Backend     | Database  |
|------------------|-------------|-----------|
| HTML, CSS        | PHP         | MySQL     |
| JavaScript       |             |           |
| Bootstrap        |             |           |

---
## 📁 Project Structure Overview

pharmacy-management/ │ ├── bootstrap/ # Bootstrap assets ├── css/ # Custom styles ├── images/ # Images used in the UI ├── js/ # JavaScript files ├── php/ # (Possibly reused PHP includes or handlers) ├── sections/ # Shared layout sections (header/footer) │ ├── add_customer.php ├── add_medicine.php ├── add_purchase.php ├── add_supplier.php ├── change_password.php ├── home.php # Admin Dashboard ├── index.html # Landing page or redirect to login ├── index.php # Entry page (maybe login) ├── login.php ├── logout.php ├── manage_customer.php ├── manage_invoice.php ├── manage_medicine.php ├── manage_medicine_stock.php ├── manage_purchase.php ├── manage_supplier.php ├── my_profile.php ├── new_invoice.php ├── purchase_report.php ├── sales_report.php ├── signup.php ├── pharmacy.sql # MySQL database dump ├── README.md

---

## 🔐 Admin Credentials Flow

### ✅ Sign Up
- Store Name
- Username
- Email
- Password
- Address

### 🔑 Login
- Username
- Password

---

## 🧪 Key Modules

- **Medicine**:
  - Add/Edit/Delete
  - Stock status (expired, out-of-stock)
- **Invoice**:
  - Create and print
- **Suppliers**:
  - Add and manage
- **Reports**:
  - Sales and purchase with print option

---
  Import the Database
  Open phpMyAdmin

  Create a new database (e.g., pharmacy_db)

  Import the provided .sql file (if included)

  Configure Database Connection

  Edit your PHP DB connection file (e.g., db/config.php):

  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "pharmacy_db";

Run the App
Open the project in your local server (e.g., XAMPP, MAMP):
http://localhost/pharmacy-management/index.php

---

📷 Screenshots
![ss3 0](https://github.com/user-attachments/assets/548d915b-cdff-4916-b2e0-3cb2a2768fa7)

---

👨‍💻 Author
Krushil Kapupara
https://www.linkedin.com/in/krushil-kapupara || https://github.com/Krushil45

---

📄 License
Open-source project under the MIT License.

---

Let me know if you'd like to:

- Add environment variables like for DB credentials
- Include `.env`-style support using PHP constants
- Generate sample data for `pharmacy.sql`
- Create a video demo link or animated walkthrough

I’d be happy to help you polish it even more!
