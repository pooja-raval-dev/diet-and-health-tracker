# Diet & Health Tracker 🥗

## 📌 Project Overview

Diet & Health Tracker is a web-based application that helps users monitor their daily health activities and receive personalized diet plans.
The system allows users to record health data such as sleep hours, calories intake, water consumption, and mood level.
An admin can analyze the user's health records and assign a suitable diet plan.

This project was developed as a **Mini Project** for the BCA program.

---

## 🚀 Technologies Used

* PHP
* MySQL
* HTML
* CSS
* Bootstrap
* JavaScript
* AJAX

---

## 👤 User Panel Features

* User Registration & Login
* Dashboard with profile details
* Update personal health information
* Add daily health records
* View saved health records
* Receive diet plan from admin
* Delete account option
* Logout functionality

---

## 🛠 Admin Panel Features

* Secure admin login
* View all registered users
* Access user profile details
* View user health records
* Create diet plans for users
* Update or delete diet plans

---

## 🗂 Pages in the Website

### Public Pages

* Home Page
* About Us
* Contact Us

### Client Side

* Register Page
* Login Page
* Dashboard
* My Profile
* Health Records
* Diet Plans
* Logout

### Admin Side

* Admin Login
* View User Profiles
* View Health Records
* Add / Update Diet Plan
* Logout

---

## 🗄 Database Structure

**Database Name:** `diet_tracker_db`

### Tables

**1. admin_login**

* admin_id (Primary Key)
* admin_email (Unique)
* admin_password
* name

**2. users**

* id (Primary Key)
* name
* email (Unique)
* phone
* password
* created_at
* age
* gender
* height
* weight
* goal

**3. health_logs**

* health_id (Primary Key)
* id (Foreign Key from users table)
* date
* sleep_hours
* calories
* water_intake
* mood_level
* notes

**4. diet_plans**

* diet_id (Primary Key)
* user_id (Foreign Key from users table)
* breakfast
* lunch
* snacks
* dinner
* notes
* created_at

---

## ⚙ How the System Works

### User Side

1. User visits the website homepage.
2. User registers an account with name, email, phone, and password.
3. After login, the user accesses the dashboard.
4. User updates profile details like age, gender, height, weight, and goal.
5. User adds daily health records including sleep hours, calories intake, water intake, mood level, and notes.
6. Health records are stored and displayed on the same page.
7. Admin reviews the data and assigns a personalized diet plan.
8. User can view the assigned diet plan and follow it in their routine.

### Admin Side

1. Admin logs in using credentials stored in the database.
2. Admin views all registered users.
3. Admin checks each user's profile and health records.
4. Based on the records, the admin creates a suitable diet plan.
5. The diet plan becomes visible to the specific user.

---

## 📋 Project Functionalities

* Data Insertion
* Data Updation
* Data Deletion
* Form Validation
* Responsive Design

---

👥 Team
- Krishna Katariya
- Pooja Raval
- Mayur Devganiya

---

## 📌 Note

This project was developed for educational purposes as part of the BCA curriculum.

