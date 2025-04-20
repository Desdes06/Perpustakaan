<p align="center"><img src="public\img\logo.png" width="400" alt="Laravel Logo"></p>

<!-- <p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p> -->

## PERPUS

Perpus merupakan sebuah aplikasi perpustakaan online yang memberikan akses kepada pengguna untuk meminjam dan membaca buku secara online, dan mempermudah dalam mengelola data perpustakan.

<!-- - [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting). -->


## Latar Belakang

Seringkali pembaca buku ingin membaca buku secara praktis dan gratis untuk beberapa buku, perpus hadir untuk memenuhi keinginan tersebut dengan memberikan akses sewa buku selama 5 hari.

## Tujuan 

Mempermudah mengelola buku perpustakaan membuatnya menjadi lebih efisien dan memberi akses kepada pengguna untuk meminjam buku secara online seperti trial buku selama 5 hari.

## Peran Dalam Aplikasi

Role : 

*	anggota
*	admin

## Fitur 

* Anggota :
    * registrasi dan login
    * meminjam buku
    * mengembalikan buku
    * melihat list buku yang di pinjam oleh sendiri
    * membaca buku yang di pinjam secara online dan gratis
    * melihat rincian buku
    * mencari buku berdasarkan judul, kategori dan penulis
    * melihat profile sendiri
    * melihat riwayat buku yang sudah pernah di pinjam

* Admin :
    * menambah, mengedit menghapus list buku yang dapat di baca
    * melihat jumlah dan rincian anggota yg terdaftar
    * melihat buku yang di pinjam oleh anggota 
    * melihat rekap buku yang di pinjam perbulannya oleh anggota
    * melihat rekap buku yang sudah di kembalikan
    * melihat rekap jumlah buku yang ada pada aplikasi
    * sortir daftar buku berdasarkan kategori, dan penulis, judul

## Tools 

Tools yang di gunakan :
*	desain wireframe (Figma)
*   Asset icon (bootsrap)
*	css (Tailwind css versi 3.4.14 dan flowbite untuk component dan js) 
*	framework (Laravel 11)
*	web server (Laragon)
*	database (mySQL)
*	versi Node (node versi v21.6.1)
*	package export pdf (barryvdh/laravel-dompdf)
*	package export exel (maatwebsite/exel)
*	php (PHP versi 8.4.3)
*   email (goodle smtp)

## Build 

```
composer install
```

```
copy paste .env dan hapus .example atau hapus saja .example
```

## Run  

```
php artisan serve
```

```
npm run dev
```
##  CSS 

```
npm install
```

##  DB RUN Seeder

```
php artisan db:seed --class=Roleseeder
```
```
php artisan db:seed --class=Adminseeder
```
```
php artisan db:seed --class=Kategoriseeder
```
```
php artisan db:seed --class=Penerbitseeder
```
## Migrasi database

Sebelum menjalan migrasi command terlebih dahulu code yang ada di 
```
Perpustakaan\app\Providers\ViewServiceProvider.php
```

Lalu jalan kan migrasi dengam peritah 
```
php artisan migrate
```



<!-- ## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
