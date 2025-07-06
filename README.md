# QuicklyWeb CMS

A lightweight, modular, open-source CMS built with PHP and MySQL.

## ✨ Features

- Clean SEO-friendly URLs
- Dynamic theme system with Bootstrap
- Admin panel with TinyMCE page editing
- User registration and login
- Fully responsive design
- Dynamic menu with support for subpages
- Easy-to-customize with modular file structure

## 🚀 Installation

1. Clone the repository or download the ZIP
2. Import the `cms.sql` database structure
3. Update `config/config.php` with your database settings
4. Upload to your hosting (PHP 8.0+ recommended)
5. Visit `/cms/auth/register.php` to create your admin account

## 🧠 Theme Development

Themes live inside `/themes/`. The default theme includes:
- `index.php` for layout
- `header.php` and `footer.php`
- `style.css` for styling

## 📁 Folder Structure

- `/admin/` – Admin dashboard and controls
- `/auth/` – User login and registration
- `/core/` – Core CMS logic (auth, db, init)
- `/templates/` – Shared layouts and views
- `/themes/` – Theme folders

## 🔐 Security

- Session-based authentication
- CSRF and XSS-safe by design
- Prepared SQL statements

## 📜 License

See `LICENSE` for details. This CMS is open-source but controlled by its author.

---

Built and maintained by [Murat Anur](https://github.com/quicklyweb)
