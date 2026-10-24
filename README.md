# 🧾 Invoice System

> Create, manage, and print professional invoices with a PHP-based billing application backed by MySQL.

![PHP](https://img.shields.io/badge/PHP-Backend-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-Markup-E34F26?logo=html5&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-4-7952B3?logo=bootstrap&logoColor=white)
![jQuery](https://img.shields.io/badge/jQuery-Frontend-0769AD?logo=jquery&logoColor=white)
![License](https://img.shields.io/badge/License-Not%20Specified-lightgrey)

## 📑 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Architecture](#-architecture)
- [Tech Stack](#-tech-stack)
- [Project Objectives and Scope](#-project-objectives-and-scope)
- [Project Structure](#-project-structure)
- [Prerequisites](#-prerequisites)
- [Installation and Setup](#-installation-and-setup)
- [Usage Guide](#-usage-guide)
- [Database Schema](#-database-schema)
- [Security Considerations](#-security-considerations)
- [Limitations and Future Enhancements](#-limitations-and-future-enhancements)
- [Contributing](#-contributing)
- [License](#-license)
- [Author](#-author)

## 🚀 Overview

### Why

Creating invoices manually can be time-consuming and error-prone. Businesses need a consistent way to record customer information, calculate product totals, retain billing records, and produce printable invoices.

The Invoice System provides a browser-based interface for creating invoices and storing their details in a MySQL database.

### What

This project is a PHP and MySQL invoicing application that allows users to enter invoice and customer details, add multiple product line items, save invoices, view saved records, and generate printable invoice documents.

### How

The application follows a traditional server-rendered PHP architecture:

1. **Input:** Users enter invoice, customer, and product information through an HTML form.
2. **Processing:** PHP receives form submissions and processes invoice data.
3. **Persistence:** MySQL stores invoice headers and their associated product line items.
4. **Retrieval:** The application queries saved invoices and displays them in a table.
5. **Document generation:** FPDF generates a printable invoice containing customer details, itemized products, totals, and the amount in words.

### To Whom

This project is intended for:

- Small businesses that need a basic invoicing workflow.
- Developers learning PHP, MySQL, and server-side form processing.
- Students practicing CRUD operations and relational database integration.
- Developers exploring PDF generation in PHP.

## ✨ Features

- **Create Invoices:** Enter an invoice number, invoice date, and customer information.
- **Multiple Product Items:** Add or remove product rows within an invoice.
- **Automatic Total Calculation:** Calculate line totals from product price and quantity and aggregate the invoice total.
- **MySQL Persistence:** Save invoice headers and their corresponding product records.
- **Saved Invoice Listing:** View invoice numbers, dates, customer names, and grand totals.
- **Printable Invoices:** Generate invoice documents using FPDF.
- **Amount in Words:** Convert the invoice total into words using the `IndianCurrency` class in `word.php`.
- **Date Picker:** Select invoice dates using jQuery UI.
- **Responsive Layout:** Use Bootstrap's grid system and form components.

## 🏗️ Architecture

The application uses a PHP server-side processing model with a MySQL relational database.

```text
                 User / Browser
                       |
                       v
               index.php
          Invoice Entry and Listing
                       |
             HTTP Form Submission
                       |
                       v
                 PHP + MySQLi
                       |
             +---------+---------+
             |                   |
             v                   v
        invoice table      invoice_products
       Invoice Header      Product Line Items
             |                   |
             +---------+---------+
                       |
                       v
                  print.php
                       |
              +--------+--------+
              |                 |
              v                 v
           FPDF PDF       word.php
         Invoice Layout   Amount in Words
              |
              v
       Printable Invoice
```

### Component Responsibilities

| Component | Responsibility |
|---|---|
| `index.php` | Invoice form, product row management, invoice calculations, and saved invoice listing |
| `config.php` | Establishes the MySQL database connection |
| `invoice_db.sql` | Defines the database schema and includes sample records |
| `print.php` | Retrieves invoice data and generates the printable PDF |
| `word.php` | Converts monetary amounts into words |
| `fpdf/` | Contains the FPDF library used for PDF generation |
| `stamp.png` | Provides the stamp image used in the invoice layout |

## 🛠️ Tech Stack

| Technology | Purpose |
|---|---|
| PHP | Server-side processing and invoice management |
| MySQL | Persistent relational data storage |
| MySQLi | Database connectivity and SQL execution |
| HTML5 | Invoice forms and document structure |
| CSS | Presentation and layout |
| Bootstrap 4 | Responsive grid and interface styling |
| jQuery 3.6.0 | Dynamic product rows and browser interactions |
| jQuery UI | Invoice date picker |
| Popper.js | Bootstrap component positioning |
| FPDF | PDF invoice generation |

### Technology Badges

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat&logo=bootstrap&logoColor=white)
![jQuery](https://img.shields.io/badge/jQuery-0769AD?style=flat&logo=jquery&logoColor=white)

The application does not require Node.js or npm for its current PHP-based workflow.

## 🎯 Project Objectives and Scope

### Objectives

- Simplify invoice creation and record keeping.
- Support invoices containing multiple products.
- Calculate item totals and the overall invoice total.
- Store invoice and product data in relational tables.
- Generate printable invoices with customer and billing details.
- Demonstrate PHP database integration and PDF generation.

### In Scope

- Invoice creation and persistence.
- Customer and invoice detail entry.
- Multiple product line items.
- Invoice listing and printing.
- MySQL database integration.
- Amount-to-words conversion.

### Out of Scope

The current implementation does not establish support for:

- User authentication and role-based access control.
- Online payments or payment gateway integration.
- Tax configuration and comprehensive tax reporting.
- Inventory synchronization.
- Email delivery of invoices.
- Recurring billing.
- Cloud hosting or multi-user access controls.

## 📂 Project Structure

```text
INVOICE-SYSTEM/
├── fpdf/             # FPDF library files
├── config.php        # MySQL connection configuration
├── index.php         # Invoice form and saved invoice listing
├── invoice_db.sql    # Database schema and sample data
├── print.php         # Invoice PDF generation
├── tcpdf.php         # PDF-related library file
├── word.php          # Amount-to-words conversion
├── stamp.png         # Invoice stamp image
└── .gitattributes    # Git file handling configuration
```

**Note:** The repository also references `delete_invoice.php` from the invoice deletion interface, but that file is not listed in the current repository root. The deletion workflow therefore needs to be verified or completed before use.

## 💻 Prerequisites

Install the following before running the project:

- PHP with the `mysqli` extension enabled.
- MySQL or a compatible MariaDB server.
- Apache or another web server configured to execute PHP.
- A browser such as Chrome, Firefox, or Edge.
- Git, if cloning the repository.

[ XAMPP](https://www.apachefriends.org/) is a convenient local development option because it bundles Apache, PHP, and MySQL-compatible database services.

## ⚙️ Installation and Setup

### 1. Clone the Repository

```bash
git clone https://github.com/pratikabhang/INVOICE-SYSTEM.git
cd INVOICE-SYSTEM
```

### 2. Configure the Local Web Server

If using XAMPP, place the project folder inside the web root, typically:

```text
C:\xampp\htdocs\INVOICE-SYSTEM
```

Start Apache and MySQL from the XAMPP Control Panel.

For Linux installations, use the appropriate document root configured for your Apache or PHP environment.

### 3. Create the Database

Open phpMyAdmin at:

[http://localhost/phpmyadmin](http://localhost/phpmyadmin)

Import the `invoice_db.sql` file included in the repository.

The SQL file defines the `invoice_db` database and the following tables:

- `invoice`
- `invoice_products`

**Important:** The SQL dump includes sample invoice records. Review the data before using it in a real environment.

Alternatively, create and import the database using the MySQL command line:

```bash
mysql -u root -p < invoice_db.sql
```

Use the database credentials appropriate for your installation.

### 4. Configure the Database Connection

The existing `config.php` connects to MySQL using the following local development settings:

```php
<?php
$con = mysqli_connect("localhost", "root", "", "invoice_db");
?>
```

For local development, these settings assume:

- Host: `localhost`
- Username: `root`
- Password: empty
- Database: `invoice_db`

If your MySQL configuration differs, update `config.php` accordingly.

For production, use a dedicated database user with a strong password and restricted privileges. Do not expose production credentials in public source control.

### 5. Launch the Application

With Apache and MySQL running, open:

[http://localhost/INVOICE-SYSTEM/](http://localhost/INVOICE-SYSTEM/)

The invoice creation form and saved invoice listing should load if the PHP application and database are configured correctly.

No separate frontend build step or npm installation is required.

## ▶️ Usage Guide

### 1. Create an Invoice

Open the application and complete the invoice form.

Enter:

- Invoice number
- Invoice date
- Customer name
- Customer address
- Customer contact number

The current form labels the contact number field as **Mobile No.**, although the database column is named `CCITY`.

### 2. Add Products

Enter the product details in the product table:

| Field | Description |
|---|---|
| Product | Product or service name |
| Price | Price per unit |
| Quantity | Number of units |
| Total | Line-item total |

Use **+ Add More** to insert additional product rows.

The JavaScript calculations update line totals and the grand total when the price or quantity changes.

### 3. Save the Invoice

Click **Save Invoice** to submit the invoice.

The application inserts the invoice header into the `invoice` table and its product line items into `invoice_products`.

After successful insertion, the application displays a link to print the invoice.

### 4. View Saved Invoices

Scroll to the **Saved Invoices** section to view existing invoice records.

The listing displays:

- Invoice number
- Invoice date
- Customer name
- Grand total
- Available actions

### 5. Print an Invoice

Click **Print** beside an invoice.

The application opens `print.php` with the invoice's internal database ID.

Example URL:

```text
http://localhost/INVOICE-SYSTEM/print.php?id=11
```

The ID shown above is illustrative; use the ID of an actual saved invoice.

The generated document includes invoice details, customer information, product line items, total amount, amount in words, and the configured stamp image.

### 6. Delete an Invoice

The interface includes a Delete button with a confirmation prompt. However, the current JavaScript calls `delete_invoice.php`, which is absent from the listed repository files.

Implement and test that endpoint before relying on invoice deletion.

## 🗄️ Database Schema

The database uses two primary tables to represent an invoice and its associated line items.

### `invoice`

Stores the invoice header and customer information.

| Column | Description |
|---|---|
| `SID` | Internal invoice record ID and primary key |
| `INVOICE_NO` | Invoice number |
| `INVOICE_DATE` | Invoice date |
| `CNAME` | Customer name |
| `CADDRESS` | Customer address |
| `CCITY` | Customer contact value, currently used for the mobile number |
| `GRAND_TOTAL` | Invoice grand total |

### `invoice_products`

Stores the products associated with an invoice.

| Column | Description |
|---|---|
| `ID` | Product record ID and primary key |
| `SID` | Associated invoice record ID |
| `PNAME` | Product name |
| `PRICE` | Unit price |
| `QTY` | Quantity |
| `TOTAL` | Line-item total |

The `SID` field connects product records to the corresponding invoice.

## 🔐 Security Considerations

The current codebase is suitable as a learning project but needs additional hardening before production use.

Recommended improvements:

- **Database credentials:** Replace the hardcoded root connection with environment-specific credentials and a least-privilege database user.
- **Prepared statements:** Use parameterized queries for all database operations. The invoice creation flow currently constructs SQL using interpolated values.
- **Input validation:** Validate invoice numbers, dates, quantities, prices, and customer fields on the server.
- **Output escaping:** Escape database values before rendering them into HTML to reduce cross-site scripting risk.
- **Transactions:** Save invoice headers and product rows within a database transaction so partial invoices can be rolled back.
- **CSRF protection:** Protect state-changing requests against cross-site request forgery.
- **Error handling:** Avoid exposing SQL errors, database details, or filesystem paths to end users.
- **PDF generation:** Validate invoice IDs and safely handle missing records and invalid input.
- **Dependency maintenance:** Review the bundled PDF library and externally loaded JavaScript and CSS dependencies for supported versions and security updates.

Do not use real customer data in a public demo environment.

## 🔮 Limitations and Future Enhancements

Potential improvements include:

- Complete and secure the missing invoice deletion endpoint.
- Add invoice editing and duplicate invoice prevention.
- Introduce invoice numbering rules and validation.
- Add tax, discounts, shipping, and configurable currency handling.
- Improve database schema naming, including replacing `CCITY` with a more accurate contact-number field.
- Add database transactions for invoice creation.
- Add authentication and access control.
- Add search, filtering, and pagination to the saved invoice list.
- Improve PDF layout customization and company branding.
- Add automated tests for invoice calculations and database operations.
- Move secrets into environment-based configuration.
- Add a backup and restore workflow for the database.

These items are recommendations, not claims about existing functionality.

## 🤝 Contributing

Contributions, bug reports, and suggestions are welcome.

### Contribution Workflow

1. Fork the repository.
2. Clone your fork:

   ```bash
   git clone https://github.com/<your-username>/INVOICE-SYSTEM.git
   cd INVOICE-SYSTEM
   ```

3. Create a feature branch:

   ```bash
   git checkout -b feature/your-feature-name
   ```

4. Make focused changes to the relevant PHP, SQL, or frontend files.
5. Test invoice creation, calculations, database persistence, and PDF output.
6. Commit your changes:

   ```bash
   git add .
   git commit -m "Improve invoice handling"
   ```

7. Push your branch:

   ```bash
   git push origin feature/your-feature-name
   ```

8. Open a pull request describing the changes and testing performed.

### Contribution Guidelines

- Follow the existing code style.
- Validate all user input.
- Avoid committing database passwords or customer information.
- Include relevant SQL changes when modifying the schema.
- Document new configuration options and dependencies.
- Test both successful and unsuccessful operations.

## 📄 License

No `LICENSE` file is listed in the current repository root. The project's license is therefore **not specified**.

Add an appropriate license file and update this section before distributing or reusing the project.

## 👨‍💻 Author

**Pratik Abhang**

- GitHub: [@pratikabhang](https://github.com/pratikabhang)
- Repository: [INVOICE-SYSTEM](https://github.com/pratikabhang/INVOICE-SYSTEM)

---

⭐ If you find this project useful, consider starring the repository.

*Built with PHP, MySQL, Bootstrap, jQuery, and FPDF.*
