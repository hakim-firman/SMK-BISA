
# ![WebApp](https://iharsh234.github.io/WebApp/images/demo/demo_landing.JPG)
# SMK-BISA : Basis Informasi Siswa Dan Akademik
<table>
<tr>
<td>
 SMK-BISA adalah sistem manajemen informasi yang sedang dalam tahap pengembangan untuk SMK. Proyek ini bertujuan untuk menyederhanakan pengelolaan data akademik dengan fitur CRUD (Create, Read, Update, Delete) untuk siswa, guru, dan kelas.
</td>
</tr>
</table>


## Fitur Utama
1. **Registrasi:** Fitur pendaftaran pengguna untuk akses sistem.
2. **Login dan Logout:** Fitur autentikasi untuk keamanan akses.
3. **Manage Siswa (CRUD):** Mengelola data siswa dengan fungsi Create, Read, Update, dan Delete.
4. **Manage Kelas (CRUD):** Mengelola informasi kelas dengan fungsi CRUD.
5. **Manage Guru (CRUD):** Mengelola data guru dengan fungsi CRUD.
6. **Daftar Siswa Berdasarkan Kelas:** Menampilkan daftar siswa yang terdaftar di setiap kelas.
7. **Daftar Guru Berdasarkan Kelas:** Menampilkan daftar guru yang mengajar di setiap kelas.
8. **Daftar Siswa, Kelas, dan Guru:** Menampilkan informasi lengkap mengenai siswa, kelas, dan guru.

# Panduan Instalasi 
Berikut adalah langkah-langkah untuk menginstal dan mengkonfigurasi proyek Laravel:

## Prerequisites

Pastikan Anda telah menginstal hal berikut di sistem Anda:
- **PHP** (versi 8.1 atau lebih tinggi)
- **Composer** (untuk manajer dependensi PHP)
- **MySQL** atau database lain yang didukung Laravel

## Langkah-langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/helloworld-hkm/SMK-BISA.git
   cd SMK-BISA
2. **Install Dependencies**
   ```bash
 composer install

3. **Copy .env File**
   ```bash
   cp .env.example .env
4. **Generate Application Key**
   ```bash
   php artisan key:generate
5. **Configure Environment**
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db-smkbisa
    DB_USERNAME=root
    DB_PASSWORD=

6. **Generate Application Key**
    ```bash
    php artisan migrate
7. **Seed Database**
    ```bash
    php artisan db:seed
8. **Serve the Application**
    ```bash
    php artisan serve

Aplikasi Anda sekarang dapat diakses di http://localhost:8000.
    








# Site

### Login
Currently it is working on all NSE (India) Stocks, BSE (India) Stocks Symbol will be added soon.

![](https://iharsh234.github.io/WebApp/images/demo/web_app_face.JPG)

### Dahboard
![](https://iharsh234.github.io/WebApp/images/demo/demo_query.JPG)

### Kelas
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart1.JPG)
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart2.JPG)
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart3.JPG)
### Guru
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart1.JPG)
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart2.JPG)
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart3.JPG)
### Siswa
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart1.JPG)
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart2.JPG)
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart3.JPG)



