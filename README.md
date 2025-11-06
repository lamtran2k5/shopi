## How to run 
- docker compose up --build
- docker compose exec php-fpm sh  
     composer install
- docker compose exec php-fpm composer require laravel/breeze
- docker compose exec php-fpm composer require laravel/sanctum
- docker compose exec php-fpm php artisan migrate --seed

## About project 
This is an e‑commerce website developed using PHP Laravel, featuring both a shopping system for customers and an admin management dashboard for store owners. To enhance security, the application is deployed behind an Nginx Web Application Firewall (WAF) powered by ModSecurity with the OWASP Core Rule Set (CRS). This setup helps protect against common web attacks such as SQL injection, cross‑site scripting (XSS), and path traversal, ensuring safer transactions and a more resilient platform

### Sections
- [Home](#home)
- [All product](#all-product)
- [Product](#product)
- [Cart](#cart)
- [Order](#order)
- [Order detail](#order-detail)
- [Admin](#admin)

---

<h4 id="home">Home</h4>
<img width="1884" height="862" alt="Home Screenshot" src="https://github.com/user-attachments/assets/59999f2b-86bd-47df-9ce1-c09530d48b15" />

---

<h4 id="all-product">All product</h4>
<img width="1914" height="866" alt="All Product Screenshot" src="https://github.com/user-attachments/assets/4762855e-edb2-444b-949a-5a7bd9bf0bc8" />

---

<h4 id="product">Product</h4>
<img width="1913" height="865" alt="Product Screenshot" src="https://github.com/user-attachments/assets/a61ec32a-f98e-48f8-aae3-4513b864dcef" />

---

<h4 id="cart">Cart</h4>
<img width="1889" height="854" alt="Cart Screenshot" src="https://github.com/user-attachments/assets/a5d885b6-6611-4404-8672-9697eaa7c07b" />

---

<h4 id="order">Order</h4>
<img width="1909" height="867" alt="Order Screenshot" src="https://github.com/user-attachments/assets/6fbb3ca9-4266-4b66-9998-df5f7659663c" />

---
<h4 id="order-detail">Order Detail</h4>
<img width="1919" height="862" alt="Screenshot 2025-11-05 121047" src="https://github.com/user-attachments/assets/0ab4e549-add5-4040-8692-89a180dac6b0" />

---

<h4 id="admin">Admin</h4>
<img width="1911" height="869" alt="Admin Screenshot" src="https://github.com/user-attachments/assets/b35acdbb-6801-4cb7-a89e-7c5eed11643a" />







