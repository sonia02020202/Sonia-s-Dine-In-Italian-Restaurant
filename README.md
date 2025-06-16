# Sonia-s-Dine-In-Italian-Restaurant
Capstone - Sonia's Fine Dine-In Restaurant is a Dine in restaurant with great quality food

CAPSTONE Project Summary – Sonia’s Fine Dine-In Restaurant
This project is a fully functional PHP-based restaurant website with front-end and back-end components. It includes both static and dynamic content and showcases CRUD (Create, Read, Update, Delete) functionality for restaurant menu items, desserts, and drinks
through an admin dashboard.

🔧 Technologies Used
PHP – Backend scripting and CRUD logic

MySQL – Database storage for items

HTML, Java Script and CSS – Layout and styling

MAMP – Local development environment

Formspree – Used to send reservation form submissions to Outlook

Google Maps Embed API using iframe – Integrated map on Contact page

Infinity Free - For Deployment

_______________________________________________________________________________________


🖥️ Public Pages
index.php – Homepage with logo, image slider and “Book Now” button

menu.php – Dynamically displays food items from the database

desserts.php – Static drinks layout and dynamic desserts section

reservations.php – Custom-designed reservation form with all required fields (name, party size, date, time, phone, email.)

contact.php – Contact info, embedded Google Map, and About Us section, footer informaton

________________________________________________________________________________________


🔐 Admin Area
admin_login.php – Secure login page (username: **** and Password ****)

admin_dashboard.php – Central hub with links to:

Manage Menu Items

Manage Dessert Items

Manage Drink Items

___________________________________________________________________________________________


✅ CRUD Functionality
Each section (menu, desserts, drinks) includes:

add_*_item.php – Add items with name, price, description, category (for drinks), and image upload

manage_*_items.php – View, edit or delete each entry

edit_*_item.php – Update item content with optional new image

delete_*_item.php – Securely delete entries from the database

__________________________________________________________________________________________


🗂️ Database Tables
menu_items: name, description, price, image_path

dessert_items: name, description, price, image

drink_items: name, price, category (wines_teas, pops_juices)

___________________________________________________________________________________________


🔒 Security Features
Password and username are case-sensitive

Sessions required to access any admin pages

10-minute session timeout with auto logout

Admin logout page with friendly goodbye message

Image file handling with validation

Headers included on all admin pages for navigation

____________________________________________________________________________________________


Extra Features
Google Map embedded on the Contact page using iframe

Reservation form connected to Formspree for data retreval directly to the store's contact email and styled with matching layout

Designed for future backend integration (e.g. with Formspree or SMTP email)

Shiny text animation on the logo using CSS - on home page

Full layout and hover consistency across all pages







