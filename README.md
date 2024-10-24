## Instalasi Proyek

### Langkah 1: Clone Proyek Laravel
```bash
git clone https://github.com/mrcelino/PPW2-Authentication.git
```

### Langkah 2: Masuk ke Direktori Proyek
```bash
cd PPW2-Authentication
```

### Langkah 3: Instal Dependensi
```bash
composer install
```

### Langkah 4: Konfigurasi Environment
1. Ubah nama file `.env.example` menjadi `.env`.
2. Sesuaikan pengaturan database pada file `.env`.

### Langkah 5: Generate Key Aplikasi
```bash
php artisan key:generate
```

### Langkah 6: Migrate database
Mulai database server kemudian jalan perintah berikut 
```bash
php artisan migrate
```

### Langkah 7: Konfigurasi Vite
1. Jalankan perintah berikut 
```bash
npm i 
```
2. Kemudian jalankan perintah berikut
```bash
npm run dev
```
3. Buka terminal baru dan jalankan perintah (jalankan jika proyek telah selesai total)
```bash
npm run build
```

### Langkah 8: Jalankan Aplikasi
```bash
php artisan serve
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
