<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Kurikulum Backend

# Menjalankan proyek

```
   git clone 
```
```
   cd project
```
```
   composer install
```
```
   setup env, database
```
```
   php artisan key:generate
```
```
   php artisan migrate:fresh --seed
```

# Guide

### Generate API Controller
Membuat custom api controller, ganti **Name** dengan nama controller sesuai modul
```
   php artisan make:controller --type=baseapi Api/NameController
```
Controller ini meng-extend custom class **BaseApiController** yang sudah disesuaikan untuk kebutuhan response dll.

### Generate Repository

Membuat file repository
```
php artisan make:repository NamaFolder/NamaRepository
```
Repository digunakan untuk mengolah data sebelum dikembalikan ke controller, tujuan utamanya agar fungsi di dalam bisa direuse kembali

### Generate Seeder

Generate seeder untuk data uji coba atau kebutuhan awal
```
php artisan make:seeder NamaSeeder
```
Usahakan ketika migrate:fresh --seed dijalankan tidak ada data seeder yang duplikat atau error

### Generate Form Request

Membuat file request
```
php artisan make:request NamaFolder/NamaRequest
```
Request digunakan untuk mengolah aturan validasi dikembalikan ke controller, tujuan utamanya agar fungsi di dalam bisa direuse kembali

### Translation

Semua text/pesan yang ada di sistem, harap di daftarkan di dalam file sesuai fungsinya.
```
lang/en
```
dan
```
lang/id
```

### Trait

```
app/Traits
```

### Debug/Generate OpenAPI

```
php artisan l5-swagger:generate
```

### Generate Access Token
```
php artisan passport:install
```

```
php artisan passport:client --personal
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
