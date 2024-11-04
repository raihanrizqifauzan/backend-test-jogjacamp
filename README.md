
# Klinik API
REST API untuk manajemen layanan klinik menggunakan Laravel. Ditujukan sebagai jawaban test Backend Jogjacamp.

### Persyaratan :
- PHP 8.x
- Composer
- MySQL

### Instalasi :
- Download project dari Link yang telah diberikan
- Setelah di download dan di unzip, masuk ke directory project, install dependensi dengan cara mengetikkan `composer install`
- Salin file .env.example menjadi .env dan sesuaikan konfigurasi database.
- Migrasi Database `php artisan migrate`
- Instal dan Konfigurasi L5-Swagger : 
    - `php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"` 
    - `php artisan l5-swagger:generate`
- Akses Swagger UI : http://localhost:8000/api/documentation
- Menjalankan Queue : `php artisan queue:work`
- Menjalankan Aplikasi : `php artisan serve`
- Menjalankan Unit Test : `php artisan test`


