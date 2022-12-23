# Catatan Untuk Menjalankan Project

## Pastikan php yg terinstal minimal versi `8.0`

#
### Buat Database di localhost / phpmyadmin 
```bash
CREATE DATABASE `lab_kimia` /*!40100 DEFAULT CHARACTER SET utf8mb4 */
```
#
### Jalankan syntax ini di terminal editor code (ex. Vscode) untuk menggenerate table 

```bash
php artisan migrate:fresh
```

#
### Jalankan Seeder (Dummy Data)
```bash
php artisan db:seed
```

#
### Test dan jalankan Aplikasi 
```bash
php artisan serve
```
