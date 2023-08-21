# MedCodeProx
MedCodeProx is an opensource Medical Coding Training platform based on PHP Laravel. It enables admin to update ICD, CPT, HCPCS codes and offers users to explore and lookup codes with respective short and long descriptions. 

# Features
Features of MedCodeProx are as follows:
- User Management
- Customer Management
- ICD10 Code and Order Management
- HCPCS Code and Order Management
- CPT Code and Order Management

# Requirements
- PHP >= 7.4
    ```
    sudo apt-get install php
    sudo apt-get install php7.4-dom
    sudo apt-get install php7.0-curl
    sudo apt-get install php7.4-mysql
    ```
- Composer >= 1.0
    ```
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
```
- Laravel >= 8.0 (Would be installed when running composer install)
- MySQL
    - `sudo apt install mysql-server` (no deafult password so keep it blank in the env)

# Installation
To install MedCodeProx in your server, follow the below steps:

1. Clone the repository with **git clone** / Download and extract the files from the repository **MedCodeProx**
2. Copy *.env.example file* to *.env*
3. Edit the *.env* file with the details such as app url, app name, database credentials, mail, and other credentials wherever needed.
4. Run **composer install** or **php composer.phar install**
5. Remove the specific packages from *composer.json* if any error occurs
6. Go to the *config* folder and open *database.php*. Rewrite charset to **'utf8'** and collation to **'utf8_unicode_ci'**
7. Run **php artisan key:generate**
8. Run **php artisan migrate --seed**
*Note: Seed is mandatory as it will create the first admin user.*
9. For file or image attachments, run **php artisan storage:link** command
    1. if you facing permssion issue then change `DB_HOST` to `localhost`.
10. Start php server with the **php artisan serve** command
11. Launch the main **URL**.
12. To log in to adminpanel, go to **/login** URL and log in with credentials
*Username: admin@admin.com*
*Password: password*
13. For other users, email address is user's email and password is user's password

# Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

# License
This project is licensed under an MIT license.
