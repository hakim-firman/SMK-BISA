
# ![SMK-BISA](https://i.ibb.co.com/Yy4WpQX/banner.png)
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
8. **Pencarian Data pada Datatable:** Memungkinkan pengguna untuk mencari dan memfilter data dengan cepat di tabel berdasarkan kata kunci atau kriteria tertentu.


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

6. **Migration Database**
    ```bash
    php artisan migrate
7. **Seed Database**
    ```bash
    php artisan db:seed
8. **Serve the Application**
    ```bash
    php artisan serve

Aplikasi Anda sekarang dapat diakses di http://localhost:8000.

## Akun
- Email:admin@gmail.com
- Password:admin

# Site

### Login
![](https://i.ibb.co.com/fDK19CJ/login.png)

### Dahboard
![](https://i.ibb.co.com/K7V8QTQ/dashboard.png)

### Siswa
![](https://i.ibb.co.com/vYP3rx6/siswa.png)
![](https://i.ibb.co.com/HG6GGDg/siswa-filter.png)
### Guru
![](https://i.ibb.co.com/TBRbz4N/guru.png)
![](https://i.ibb.co.com/v3fcGhQ/guru-filter.png)

### Siswa
![](https://i.ibb.co.com/ph4c65t/kelas.png)



