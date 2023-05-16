<h1 align="center">Selamat datang di SISTEM MONITORING KEAMANAN SEPEDA MOTOR DENGAN KAMERA DAN GPS BERBASIS INTERNET OF THINGS! 👋</h1>

## Latar Belakang:

Website ini menerapkan sistem keamanan pada sepeda motor guna untuk mengatasi tindakan pencurian dengan menggunakan pesan Telegram sebagai media control dan Gps untuk pendeteksi dan web sebagai monitoring saja.

## Fitur tersedia

**Website**

-   Landing Page
-   Login Page
-   Master Data Monitoring
-   Report Data Monitoring

**Alat**

-   Menampilkan Data Latitude, Longitude dan gambar

## Sensor dan Peralatan Pendukung

**Hardware**

-   Nodemcu esp8266
-   Gps Neo 6m
-   Stepdown
-   Sin8001
-   Relay 4 Chanel
-   esp32 cam

**Software**

-   Arduino IDE
-   Visual Studio Code
-   Framework Laravel Versi 10

---

## Release Date

**Release date : 16 Mei 2023**

> Sistem Monitoring Keamanan Sepeda Motor merupakan project open source yang dibuat karena adanya permintaan. dan dapat dikembangkan sewaktu-waktu. Terima kasih!

---

## Default Account for testing

**Admin Default Account**

-   email: admin@gmail.com
-   Password: 12345678

---

## Install

1. **Clone Repository**

```bash
https://github.com/vikarmaulanaarrisyad/monitoring-keamanan-speda-motor-web.git
cd monitoring-keamanan-speda-motor-web
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate --seed
```

4. **Jalankan website**

```bash
php artisan serve
```

## Author

-   Facebook : <a href="https://web.facebook.com/viikar.arrisyad.7/"> Vikar Maulana</a>
-   Instagram : <a href="https://www.instagram.com/vikar_maulana_/"> Vikar Maulana</a>

## Contributing

Contributions, issues and feature requests di persilahkan.
Jangan ragu untuk memeriksa halaman masalah jika Anda ingin berkontribusi. **Berhubung Project ini masih saya kembangkan sendiri, namun banyak fitur yang kalian dapat tambahkan silahkan berkontribusi yaa!**

## License

-   Copyright © 2023 Vikar Maulana.
-   **Sistem Monitoring Keamanan Speda Motor Web is open-sourced software licensed under the MIT license.**
