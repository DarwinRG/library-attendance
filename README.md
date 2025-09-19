# 📚 PanpacificU Library Attendance System

A comprehensive web-based attendance management system for Panpacific University Library.

## ✨ Features

- 🆔 Student check-in and check-out via Student ID
- 📝 Attendance logging with date, time, and purpose
- 🔍 Purpose selection (Research, Study, Computer Access, etc.)
- 🔐 Admin panel for attendance management
- 👥 Student and purpose management (add, edit, delete)
- 📊 Attendance reports and export
- 🕒 Timezone support

## 🛠️ Technologies Used

- 🖥️ PHP (backend)
- 🗄️ MySQL (database)
- 🎨 Bootstrap, jQuery, JavaScript (frontend)

## 📁 Folder Structure

- `attendance.php` — Handles attendance check-in/out
- `admin/` — Admin dashboard and management modules
- `db/library.sql` — Database schema and sample data
- `images/` — Profile and logo images
- `bower_components/`, `plugins/` — Frontend libraries

## 💾 Database Structure

Main tables:
- `students`: Student records (ID, reference number, name, program, year level)
- `attendance`: Attendance logs (student, date, time in/out, purpose)
- `purposes`: List of attendance purposes
- `admin`: Admin user accounts
- `settings`: System settings (e.g., timezone)

See `db/library.sql` for full schema and sample data.

## ⚙️ Setup Instructions

1. Import `db/library.sql` into your MySQL server.
2. Configure database connection in `conn.php` and `admin/includes/conn.php`.
3. Deploy the project in your PHP server (e.g., XAMPP, Docker).
4. Access the main system via `index.php` and the admin panel via `admin/index.php`.

## 📋 Usage

- **👨‍🎓 Student:** Enter Student ID, select status (Check In/Out), and choose purpose.
- **👨‍💼 Admin:** Login to manage students, purposes, view attendance logs, and generate reports.

## 📜 License

This project is licensed under the [Apache License 2.0](https://www.apache.org/licenses/LICENSE-2.0). See the [LICENSE](LICENSE) file in this repository for more details.
