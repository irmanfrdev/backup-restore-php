**About**

Contoh penggunaan fitur backup database ke file *.sql dan restore database dari file *.sql menggunakan PHP native

**Instalasi**

- Buat folder 'backup' (untuk menampung file hasil backup)
- Buat folder 'restore' (untuk menampung file saat restore)

**Fitur**
- PHP Native (support PHP 7)
- Backup database MySQL/MariaDB ke file *.sql
- Restore database MySQL/MariaDB dari file *.sql
- Support foreign key constraint

**Catatan**

- Kodenya memang gak *clean* tapi berjalan dengan baik, berhasil backup dan juga restore, kalau ada kesempatan nanti dirapikan lagi

**Todo**
- Pada saat backup, file *.sql yang dihasilkan jadi double (ada 2 file backup)