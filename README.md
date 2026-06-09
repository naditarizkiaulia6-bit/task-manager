# Laravel CRUD Menggunakan Raw SQL dan Query Builder

## Deskripsi

Project ini dibuat untuk memenuhi tugas Framework Laravel dengan mengimplementasikan operasi CRUD (Create, Read, Update, Delete) menggunakan dua teknik akses database yang berbeda, yaitu:

1. Raw SQL
2. Query Builder

Studi kasus yang digunakan adalah pengelolaan data Tag pada aplikasi Task Manager.

## Tujuan

* Memahami penggunaan Raw SQL pada Laravel.
* Memahami penggunaan Query Builder pada Laravel.
* Membandingkan cara kerja kedua teknik dalam melakukan operasi CRUD.
* Mengimplementasikan CRUD pada framework Laravel.

## Teknologi yang Digunakan

* Laravel 12
* PHP 8.2
* MySQL
* Blade Template
* Tailwind CSS

## Implementasi CRUD

### 1. Raw SQL

CRUD dilakukan menggunakan query SQL secara langsung melalui class `DB`.

Contoh:

```php
DB::select("SELECT * FROM tags");

DB::insert(
    "INSERT INTO tags(name, color) VALUES (?, ?)",
    [$name, $color]
);

DB::update(
    "UPDATE tags SET name = ?, color = ? WHERE id = ?",
    [$name, $color, $id]
);

DB::delete(
    "DELETE FROM tags WHERE id = ?",
    [$id]
);
```

Controller:

```text
TagControllerRawSQL.php
```

### 2. Query Builder

CRUD dilakukan menggunakan Query Builder Laravel.

Contoh:

```php
DB::table('tags')->get();

DB::table('tags')->insert([
    'name' => $name,
    'color' => $color
]);

DB::table('tags')
    ->where('id', $id)
    ->update([
        'name' => $name
    ]);

DB::table('tags')
    ->where('id', $id)
    ->delete();
```

Controller:

```text
TagControllerQueryBuilder.php
```

## Struktur Project

```text
app/
 └── Http/
     └── Controllers/
         ├── TagControllerRawSQL.php
         └── TagControllerQueryBuilder.php

resources/
 └── views/

routes/
 └── web.php
```

## Fitur

* Menampilkan data tag
* Menambah data tag
* Mengubah data tag
* Menghapus data tag
* Pencarian data tag
* Statistik penggunaan tag

## Cara Menjalankan

1. Clone repository

```bash
git clone <repository-url>
```

2. Install dependency

```bash
composer install
```

3. Copy file environment

```bash
cp .env.example .env
```

4. Generate key

```bash
php artisan key:generate
```

5. Konfigurasi database pada file `.env`

6. Jalankan migrasi

```bash
php artisan migrate
```

7. Jalankan aplikasi

```bash
php artisan serve
```

8. Akses melalui browser

```text
http://localhost:8000
```

## Kesimpulan

Project ini menunjukkan bahwa Laravel menyediakan beberapa cara untuk berinteraksi dengan database. Raw SQL memberikan kontrol penuh terhadap query SQL, sedangkan Query Builder menawarkan sintaks yang lebih sederhana, aman, dan mudah dibaca.
