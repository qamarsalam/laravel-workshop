# Laravel Beginner Workshop

Welcome! 👋 This repository contains the code for our beginner-friendly Laravel workshop.

During this workshop, we will learn how Laravel connects routes, views, controllers, and databases through a practical exercise.

## 🎯 What You Will Learn

By the end of this workshop, you will understand how to:

- Create a page using a Blade view.
- Define a route in `routes/web.php`.
- Display a page in the browser.
- Submit a form to a Laravel controller.
- Validate user input.
- Save submitted information into a database.
- Retrieve saved records from the database.

## 🛠️ Requirements

Before starting, install:

- PHP
- Composer
- Git
- Visual Studio Code (or another code editor)

Make sure PHP and Composer are available in your terminal:

```bash
php -v
composer -V
```

## 🚀 1. Download the Project

Clone this repository:

```bash
git clone YOUR_REPOSITORY_URL
```

Enter the project folder:

```bash
cd YOUR_PROJECT_FOLDER
```

Replace the placeholders with your actual GitHub repository URL and folder name.

## ⚙️ 2. Install and Configure Laravel

Install the PHP dependencies:

```bash
composer install
```

Create your local environment file:

**Windows PowerShell:**

```powershell
Copy-Item .env.example .env
```

**macOS / Linux:**

```bash
cp .env.example .env
```

Generate your application key:

```bash
php artisan key:generate
```

Configure your database in `.env` before continuing.

## 🗄️ 3. Prepare the Database

Run the migrations:

```bash
php artisan migrate
```

Migrations create the database tables defined by the project.

To view the database records, use the database tool configured for the workshop, such as SQLite's database viewer or phpMyAdmin for MySQL.

## ▶️ 4. Start the Development Server

Run:

```bash
php artisan serve
```

Open the URL displayed in your terminal, usually:

[http://127.0.0.1:8000](http://127.0.0.1:8000)

Keep the terminal running while you use the application. Press `Ctrl + C` to stop the server.

## 📝 5. Workshop Exercise: Create a Contact Page

### Part A — Create the view

Create a file at:

`resources/views/contact.blade.php`

Add a simple HTML page with a contact form containing:

- Name
- Email
- Message
- Submit button

### Part B — Add the route

Open:

`routes/web.php`

Add a route that displays the Contact page.

Visit:

[http://127.0.0.1:8000/contact](http://127.0.0.1:8000/contact)

### Part C — See how things are saved in a create information

We will learn how to:

1. Create a database migration table.
2. How a controller receive the submitted form.
3. Validate the submitted information.
4. Verify that the record exists in the database.

## 🔍 6. How Does Laravel Save Data?

The basic flow is:

**Form → POST route → Controller → Model → Database**

- **Form:** The user enters contact information.
- **Route:** Laravel directs the submitted request to the correct method.
- **Controller:** Validates the information and decides what to do.
- **Model:** Represents the database record.
- **Database:** Stores the submitted information.
