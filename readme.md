
## Description

ERSA (elektronik arsip) adalah aplikasi pengarsipan surat.

## feature
1. Multi User (admin, petugas)
2. scan directly from the scanner
3. integration with Filepond JS

## Installation

1. First clone or download this repository:
```bash
git clone https://github.com/subhandp/ersa.git
```
2. Enter directory project `cd ersa`
3. Execute `composer install` to install the dependencies.
4. Setting the database configuration, rename `.env.example` to `.env` and open file at project root directory
```bash
DB_DATABASE=**your_db_name**
DB_USERNAME=**your_db_user**
DB_PASSWORD=**password**
```
5. Run the following command at the terminal:
```bash
 php artisan migrate:fresh --seed
```
7. Run laravel
```bash
php artisan serve
```

default admin user : 419322 <br>
default password : 123456

default pengguna user : 419333<br>
default password : 123456

## Pengembangan selanjutnya
1. Ubah Template ke Admin LTE Terbaru
2. Upgrade ke Laravel 9
3. Integrasi dengan Mobile App (Flutter)
