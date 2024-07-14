TUGAS KELOMPOK PEMROGRAMAN WEB LANJUT ============================
PENUGASAN KELOMPOK
MELANJUTKAN
MEMBUAT RELASI TABEL & CRUD UPLOAD FOTO
Dengan menambahkan FORM LOGIN
TUGAS ANDA (KELOMPOK)
1. Buat Proyek Laravel baru (nama bebas), misal AKADEMIK
2. Buat Database, misal DB_AKADEMIK
3. Buat Tabel MHS, PRODI, MATKUL
4. Susun instruksi untuk melakukan proses CRUD pada Tabel-tabel
tersebut.
Note. Sebagai bahan referensi, lihat dan pelajari kembali Tutorial
mengenai CRUD_Dengan_RELASI_Tabel
PENGUMPULAN HASIL KERJA KELOMPOK
1. COMPRESS FILE KERJA ANDA (ZIP/RAR), SS Bukti
hasil kerja di File MS-WORD/ PDF
2. UPLOAD FILE-FILE HASIL KERJA KE GOOGLE DRIVE
MASING-MASING DI FOLDER FORM LOGIN
3. SHARE LINK GDRIVE PERWAKILAN KELOMPOK (OLEH
KETUA KELOMPOK SAJA) DI GROUP WA LIST TUGAS.
====================================================================
====================================================================
Daftar Anggota Kelompok 2
1. M.Burhanudin Asy'ari		(xxxxxxxx)
2. Muslik			(xxxxxxxx)
3. Moh Rakha Iqbal		(xxxxxxxx)
4. Haris Burhanudin		(xxxxxxxx)
5. Hari Sutrisno		(xxxxxxxx)
6. Muhammad Ridho Sayyidina	(xxxxxxxx)
====================================================================
Tentang Proyek
Menjalankan Program pertama kali:
*harus berurutan
1. Extract folder ke manapun yang kamu mau;
1.5. Buat database dengan nama crud_kelompok
2. cd cmd folder photo-upload-auth;
3. php artisan migrate;

php artisan db:seed --class=ProdiSeeder
php artisan db:seed --class=MatkulSeeder
php artisan db:seed --class=MahasiswaSeeder
7. php artisan serve;
8. Buka browser ketik link localhost sesuai yang tertera di command prompt, mis. localhost:8000
9. Registrasi terlebih dahulu menggunakan format email yang valid dan unik dengan nama usernya.
10. Login menggunakan akun yang sudah teregistrasi.
11. Selesai. Anda bisa membuka menu dashboard.

*TL NOTE: UNTUK NAMA DATABASENYA ADALAH crud_kelompok. Mohon untuk membuat dulu databasenya sebelum memulai tahap 2.