# aplikasi-mahasiswa

Nama  : Muhammad Fadhilah
NPM   : 19630063
Kelas : 3P TI Reg Pagi BJM


Basis Data : mahasiswa

Tabel :

1. mahasiswa

 Strukturnya : 
  1. npm (varchar 8) primary
  2. nama (varchar 100) 
  3. tempat_lahir (varchar 50)
  4. tanggal_lahir (date)
  5. jenis_kelamin (enum ['L','P'])
  6. alamat (text)
  7. kode_pos (varchar 5)

2. user

 strukturnya :
  1. id (int) primary + Auto increment
  2. username (varchar 50)
  3. password (varchar 255)
