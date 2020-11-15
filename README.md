# Event Scheduler
> This Event Scheduler website is created with Codeigniter, Bootstrap and MySQL.

## Table of Contents
* [General info](#general-into)
* [Features](#features)
* [Technologies](#technologies)
* [Status](#status)
* [Contact](#contact)

## General info 
This web project aims to use PHP to create a dynamic website, with the consideration of the data encryption. 

Users are able to sign up with their email address, with a confirmantion email send to their email address, and they can log in with correct username, email and password. Considering the user pricacy, users have to confirm their email address first in order to login the website, and all the passwords are encrypted with hash function and are stored in the MySQL database.

In this website, users can add events on the calendar, remove and search them dynamically. 

Users are able to update their profile details, including profile images and upload multiple images to generate their own gallery. 

Event Scheduler also supports online payment with Stripe to join the website membership. 
## Features
### Sign Up & Login Page
- [Cookies](https://developer.mozilla.org/en-US/docs/Web/HTTP/Cookies) - HTTP Cookies stores information on users' hard disk and keep users logged-in.
- [Session](https://developer.mozilla.org/en-US/docs/Web/HTTP/Session) - HTTP Session controls users log in and logout and reflect the user’s login status.
- Web Security - Captcha and password encryption.

![Login Page](./Screenshot/sign.png?raw=true)

![Login Page](https://github.com/YangchenchenLi/wis_project/blob/main/Screenshot/login.png?raw=true)

### Calendar Page & Ajax Search Page
- [jQuery - Ajax](https://www.w3schools.com/xml/ajax_intro.asp) - Ajax provides rapid browser-server interactions.

![Login Page](./Screenshot/add_calendar_event.png?raw=true)

![Login Page](./Screenshot/calendar.png?raw=true)

![Login Page](./Screenshot/ajax_search1.png?raw=true)

![Login Page](./Screenshot/ajax_search2.png?raw=true)

### User Profile Page
![Login Page](./Screenshot/profile.png?raw=true)

### File upload Page

![Login Page](./Screenshot/multifiles_upload.png?raw=true)

![Login Page](./Screenshot/file_upload.png?raw=true)

### Online Payment Page & PDF Generation
- [Stripe](https://stripe.com/docs/api) - Online Payment Integration.

![Login Page](./Screenshot/online_payment.png?raw=true)

![Login Page](./Screenshot/payment_transaction.png?raw=true)

![Login Page](./Screenshot/generate_pdf.png?raw=true)
### Database Design
![Login Page](./Screenshot/database_design.png?raw=true)

## Technologies 
- [CodeIgniter](https://codeigniter.com/) - PHP MVC framework. 
- [jQuery - Ajax](https://www.w3schools.com/xml/ajax_intro.asp) - Ajax provides rapid browser-server interactions.
- [Bootstrap](https://getbootstrap.com/) - Extensive list of components and Bundled Javascript plugins. 

## Status
This project was developed for one of my university courses. It finised to meet the course requirment, but is still _in progress_ now. 
## Contact 
Created by [Yangchenchen Li](https://github.com/YangchenchenLi) - feel free to contact me!










