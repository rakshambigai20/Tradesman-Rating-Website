# Tradesman Rating Website

This is my first website developed as part of my academic coursework. The website allows users to search for tradesmen based on location and trade type. It also includes features like account creation for tradesmen, customer booking, and tradesman rating.

---

## Table of Contents

- [Development Details](#development-details)
- [Application Features & Screenshots](#application-features--screenshots)
  - [1. Register](#1-register)
  - [2. Login Page](#2-login-page)
  - [3. Home Page](#3-home-page)
  - [4. Tradesman Home Page](#4-tradesman-home-page)
  - [5. Tradesman Settings Page](#5-tradesman-settings-page)
    - [5.1 Personal Settings](#51-personal-settings)
    - [5.2 Professional Settings](#52-professional-settings)
  - [6. Booking](#6-booking)
    - [6.1 Make Booking](#61-make-booking)
    - [6.2 Cancel Booking](#62-cancel-booking)
  - [7. Rating](#7-rating)
- [Screenshots](#screenshots)

---

## Development Details

| **Aspect**                | **Details**                   |
|---------------------------|-------------------------------|
| Development Language      | PHP, HTML, CSS, JavaScript    |
| Development Platform      | Visual Studio Code            |
| Data Storage Platform     | MySQL (phpMyAdmin)            |
| Development Environment   | XAMPP                         |

---

## Application Features & Screenshots

### 1. Register
Allows tradesmen to register their profile. After registration, each tradesman is assigned a unique ID.

![Registration Page](https://github.com/user-attachments/assets/46a39c27-2eeb-42df-89aa-2fdd0ea8a9da)


![Registration with unique code](https://github.com/user-attachments/assets/bdffcc07-01e3-46f9-ac9e-676c87a4ac4f)


### 2. Login Page
Allows tradesmen to log in to their accounts.

![Login Page](https://github.com/user-attachments/assets/deb96bd1-1d4e-4944-a2da-68c947191363)


### 3. Home Page
A common home page that allows customers to search for tradesmen. The top bar includes options to redirect to Login or Register.

![Search tradesman](https://github.com/user-attachments/assets/098d2886-87ae-4c2f-acc4-bdc5a8d52694)






![Search trademan_results](https://github.com/user-attachments/assets/1d374f0e-3a81-41e9-b7c0-6328c12e5744)

### 4. Tradesman Home Page
Displays:
- Tradesman's unique code.
- Bookings associated with the tradesman.
- Tradesmen can view booking details and cancel them if needed.

  ![TRadesman Home Page](https://github.com/user-attachments/assets/ad5c1508-7682-4236-85ea-c76fac806860)

### 5. Tradesman Settings Page
#### 5.1 Personal Settings
Manage personal information.

![Personal Details Page](https://github.com/user-attachments/assets/fb268aa4-9281-466e-9813-4c37a9614c79)

#### 5.2 Professional Settings
Tradesmen can:
- Upload proof of previous works.
- Add references to display a professional badge on their profile.

![Professional Details Page](https://github.com/user-attachments/assets/901c4186-198d-4e44-b84c-db96b34ce563)

### 6. Booking
#### 6.1 Make Booking
Customers can:
- Book tradesmen by checking availability and ratings.
- Receive an error if a tradesman is unavailable at the selected time.

![Screenshot 2025-01-24 222658](https://github.com/user-attachments/assets/986b4eff-b28f-45c4-bbce-d428f6426132)


![Screenshot 2025-01-24 222436](https://github.com/user-attachments/assets/a5dc08d2-1756-497a-893e-364e03946609)

#### 6.2 Cancel Booking
Customers can:
- View bookings using their email ID.
- Cancel bookings directly.

![Customer - View Booking Details](https://github.com/user-attachments/assets/b4cbf2c0-02f0-41b2-b1c6-cca49f570247)

### 7. Rating
- Customers can rate tradesmen using a unique ID provided by the tradesman to avoid fake ratings.
- - Tradesmen can view ratings on their account under the booking page.

  ![Rate tradesman](https://github.com/user-attachments/assets/a1765c73-e76d-4ed3-a495-3ffe4d09192d)

### 7. Contact Us Page

![Contact Us](https://github.com/user-attachments/assets/03da1bc3-94ae-4c13-a986-d03c27ad2d30)

---

## Steps to Install and Set Up

1. Download and install XAMPP: [Download XAMPP](https://www.apachefriends.org/download.html)
2. Launch the XAMPP Control Panel.
3. Start the Apache and MySQL services.
4. Navigate to the XAMPP `htdocs` folder:  
   `C:\xampp\htdocs\`
5. Clone the project from GitHub:  
   git clone "https://github.com/rakshambigai20/Tradesman-Rating-Website.git"
6. Open your browser and go to:  
   `http://localhost/phpmyadmin`
7. Create a new database and import the `.sql` file included in the project.
8. Locate the database configuration file:  
   `/Backend/class/dbh.inc`
9. Update the database connection settings to match local setup (Host, Username, Password, Database) 
   
---

## Steps to Run the Application

1. Ensure that Apache and MySQL are running in the XAMPP Control Panel.
2. Open your browser and navigate to:  
   `http://localhost/tradesman_rating/Customer.php`

---

