# 🔧 CRUD dengan 2 Teknik: Raw SQL vs Query Builder

Dokumentasi lengkap untuk implementasi CRUD menggunakan dua teknik berbeda.

---

## 📚 DAFTAR ISI

1. [Pengenalan](#pengenalan)
2. [Raw SQL CRUD](#raw-sql-crud)
3. [Query Builder CRUD](#query-builder-crud)
4. [Perbandingan](#perbandingan)
5. [Kapan Menggunakan Mana](#kapan-menggunakan-mana)
6. [Keamanan](#keamanan)

---

## Pengenalan

### Apa itu CRUD?

**CRUD** = Create, Read, Update, Delete

- **Create**: Menambah data baru ke database
- **Read**: Membaca/mengambil data dari database
- **Update**: Mengubah data yang sudah ada
- **Delete**: Menghapus data dari database

### 2 Teknik yang Diimplementasikan

#### 1. Raw SQL
```php
DB::select()    // SELECT
DB::insert()    // INSERT
DB::update()    // UPDATE
DB::delete()    // DELETE
```

#### 2. Query Builder
```php
DB::table('tags')->get()           // SELECT
DB::table('tags')->insert()        // INSERT
DB::table('tags')->update()        // UPDATE
DB::table('tags')->delete()        // DELETE
```

---

## Raw SQL CRUD

### Lokasi
```
Controller: app/Http/Controllers/TagControllerRawSQL.php
Views: resources/views/tags/raw-sql/
Routes: tags/raw-sql/*
```

### 1. CREATE (Raw SQL)

**File**: `TagControllerRawSQL@store()`

```php
$sql = 'INSERT INTO tags (name, color, description, created_at, updated_at) 
        VALUES (?, ?, ?, NOW(), NOW())';

DB::insert($sql, [
    $validated['name'],
    $validated['color'],
    $validated['description'] ?? null,
]);
```

**Penjelasan:**
- `?` adalah placeholder untuk parameter (aman dari SQL injection)
- Parameter array `[...]` berisi nilai-nilai yang akan diinsert
- `NOW()` function untuk timestamp otomatis

**URL**: `POST /tags/raw-sql`

---

### 2. READ (Raw SQL)

**File**: `TagControllerRawSQL@index()` dan `@show()`

#### Read Semua Data
```php
$tags = DB::select('SELECT id, name, color, description, created_at FROM tags 
                    ORDER BY created_at DESC');
```

#### Read Data Spesifik
```php
$tags = DB::select('SELECT id, name, color, description, created_at 
                    FROM tags WHERE id = ?', [$id]);
```

**URL:**
- List: `GET /tags/raw-sql`
- Detail: `GET /tags/raw-sql/{id}`

---

### 3. UPDATE (Raw SQL)

**File**: `TagControllerRawSQL@update()`

```php
$sql = 'UPDATE tags 
        SET name = ?, color = ?, description = ?, updated_at = NOW() 
        WHERE id = ?';

$updated = DB::update($sql, [
    $validated['name'],
    $validated['color'],
    $validated['description'] ?? null,
    $id,
]);

if ($updated) {
    // Update berhasil
}
```

**Penjelasan:**
- `$updated` berisi jumlah row yang teraffect
- Check jumlah row untuk validasi

**URL**: `PUT /tags/raw-sql/{id}`

---

### 4. DELETE (Raw SQL)

**File**: `TagControllerRawSQL@destroy()`

```php
// Hapus relationship terlebih dahulu
DB::delete('DELETE FROM task_tags WHERE tag_id = ?', [$id]);

// Hapus tag
$deleted = DB::delete('DELETE FROM tags WHERE id = ?', [$id]);

if ($deleted) {
    // Berhasil dihapus
}
```

**URL**: `DELETE /tags/raw-sql/{id}`

---

### Advanced Features (Raw SQL)

#### Search dengan LIKE
```php
$tags = DB::select('
    SELECT id, name, color FROM tags 
    WHERE name LIKE ? 
    ORDER BY name ASC
    LIMIT 10
', ['%' . $query . '%']);
```

#### Bulk Delete
```php
$placeholders = implode(',', array_fill(0, count($ids), '?'));
DB::delete("DELETE FROM task_tags WHERE tag_id IN ($placeholders)", $ids);
DB::delete("DELETE FROM tags WHERE id IN ($placeholders)", $ids);
```

#### Statistics dengan JOIN
```php
$stats = DB::select('
    SELECT 
        COUNT(DISTINCT t.id) as total_tags,
        t.name,
        COUNT(tt.id) as usage_count
    FROM tags t
    LEFT JOIN task_tags tt ON t.id = tt.tag_id
    GROUP BY t.id, t.name
    ORDER BY usage_count DESC
');
```

---

## Query Builder CRUD

### Lokasi
```
Controller: app/Http/Controllers/TagControllerQueryBuilder.php
Views: resources/views/tags/query-builder/
Routes: tags/query-builder/*
```

### 1. CREATE (Query Builder)

**File**: `TagControllerQueryBuilder@store()`

```php
DB::table('tags')->insert([
    'name' => $validated['name'],
    'color' => $validated['color'],
    'description' => $validated['description'] ?? null,
    'created_at' => now(),
    'updated_at' => now(),
]);
```

**Penjelasan:**
- Method chaining yang readable
- Array associative untuk kolom
- `now()` helper function Laravel

**URL**: `POST /tags/query-builder`

---

### 2. READ (Query Builder)

**File**: `TagControllerQueryBuilder@index()` dan `@show()`

#### Read Semua Data dengan Ordering
```php
$tags = DB::table('tags')
    ->orderBy('created_at', 'desc')
    ->get();
```

#### Read Data Spesifik
```php
$tag = DB::table('tags')
    ->where('id', $id)
    ->first();
```

#### Read dengan Multiple Conditions
```php
$tags = DB::table('tags')
    ->where('color', $color)
    ->where('name', 'like', '%' . $search . '%')
    ->get();
```

**URL:**
- List: `GET /tags/query-builder`
- Detail: `GET /tags/query-builder/{id}`

---

### 3. UPDATE (Query Builder)

**File**: `TagControllerQueryBuilder@update()`

```php
$updated = DB::table('tags')
    ->where('id', $id)
    ->update([
        'name' => $validated['name'],
        'color' => $validated['color'],
        'description' => $validated['description'] ?? null,
        'updated_at' => now(),
    ]);
```

**Penjelasan:**
- `->where()` untuk kondisi
- `->update()` dengan array kolom-nilai
- Return jumlah row yang updated

**URL**: `PUT /tags/query-builder/{id}`

---

### 4. DELETE (Query Builder)

**File**: `TagControllerQueryBuilder@destroy()`

```php
// Hapus relationship
DB::table('task_tags')
    ->where('tag_id', $id)
    ->delete();

// Hapus tag
$deleted = DB::table('tags')
    ->where('id', $id)
    ->delete();
```

**URL**: `DELETE /tags/query-builder/{id}`

---

### Advanced Features (Query Builder)

#### Pagination
```php
$tags = DB::table('tags')
    ->orderBy('created_at', 'desc')
    ->paginate(10);
```

#### Complex Join dengan Aggregation
```php
$tags = DB::table('tags')
    ->leftJoin('task_tags', 'tags.id', '=', 'task_tags.tag_id')
    ->select(
        'tags.id',
        'tags.name',
        'tags.color',
        DB::raw('COUNT(task_tags.id) as usage_count')
    )
    ->groupBy('tags.id', 'tags.name', 'tags.color')
    ->havingRaw('COUNT(task_tags.id) > 0')
    ->get();
```

#### Bulk Operations
```php
// Bulk Delete
DB::table('tags')
    ->whereIn('id', $ids)
    ->delete();

// Bulk Update
DB::table('tags')
    ->whereIn('id', $ids)
    ->update(['color' => $color, 'updated_at' => now()]);
```

#### Advanced Filtering
```php
$query = DB::table('tags');

if ($request->filled('color')) {
    $query->where('color', $request->input('color'));
}

if ($request->filled('search')) {
    $query->where('name', 'like', '%' . $request->input('search') . '%');
}

$tags = $query->orderBy('created_at', 'desc')->get();
```

---

## Perbandingan

### Tabel Perbandingan

| Aspek | Raw SQL | Query Builder |
|-------|---------|---------------|
| **Readability** | ❌ Kurang mudah dibaca | ✅ Sangat readable |
| **Flexibility** | ✅ Penuh kontrol | ⚠️ Terbatas untuk kompleks |
| **Security** | ⚠️ Harus hati-hati | ✅ Built-in protection |
| **Performance** | ✅ Lebih cepat | ⚠️ Sedikit lebih lambat |
| **Database Agnostic** | ❌ Spesifik database | ✅ Multi-database |
| **Maintainability** | ❌ Sulit di-maintain | ✅ Mudah di-maintain |
| **Learning Curve** | ❌ Steep | ✅ Moderate |
| **Complex Queries** | ✅ Lebih mudah | ⚠️ Perlu DB::raw() |

---

## Kapan Menggunakan Mana?

### Gunakan Raw SQL Jika:
```
✅ Query sangat kompleks & sulit dengan Query Builder
✅ Perlu performa maksimal
✅ Query spesifik database (stored procedures, dll)
✅ Sudah experienced dengan SQL
✅ Query jarang berubah
```

### Gunakan Query Builder Jika:
```
✅ Query standard CRUD
✅ Perlu maintenance mudah & readable code
✅ Multi-database support
✅ Team development (konsistensi)
✅ Proteksi SQL injection penting
✅ Perubahan query sering
```

### Rekomendasi Umum:
```
90% Kasus: Query Builder ✅
10% Kasus: Raw SQL ⚠️ (hanya jika perlu)
```

---

## Keamanan

### SQL Injection Prevention

#### ❌ TIDAK AMAN (Raw SQL tanpa parameter):
```php
// JANGAN LAKUKAN INI!
$query = "SELECT * FROM tags WHERE name = '" . $search . "'";
DB::select($query);
```

#### ✅ AMAN (Raw SQL dengan parameter):
```php
// Gunakan placeholder (?)
$tags = DB::select('
    SELECT * FROM tags WHERE name = ?
', [$search]);
```

#### ✅ AMAN (Query Builder):
```php
// Query Builder otomatis handle
$tags = DB::table('tags')
    ->where('name', $search)
    ->get();
```

### Best Practices

1. **Selalu gunakan parameter binding**
```php
// Benar
DB::select('SELECT * FROM tags WHERE id = ?', [$id]);

// Benar (Query Builder)
DB::table('tags')->where('id', $id)->get();
```

2. **Validasi input**
```php
$validated = $request->validate([
    'name' => 'required|string|max:50|unique:tags,name',
]);
```

3. **Gunakan prepared statements**
```php
// Query Builder menggunakan ini otomatis
// Raw SQL: gunakan placeholder (?)
```

---

## Implementasi di Aplikasi

### Struktur Folder
```
app/Http/Controllers/
├── TagControllerRawSQL.php        (Raw SQL implementation)
└── TagControllerQueryBuilder.php  (Query Builder implementation)

resources/views/tags/
├── raw-sql/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── show.blade.php
│   └── edit.blade.php
└── query-builder/
    ├── index.blade.php
    ├── create.blade.php
    ├── show.blade.php
    └── edit.blade.php

database/
├── migrations/
│   └── 2024_01_04_000000_create_tags_table.php
└── seeders/
    └── TagSeeder.php
```

### Database Schema
```php
Schema::create('tags', function (Blueprint $table) {
    $table->id();
    $table->string('name', 50)->unique();
    $table->string('color', 20);
    $table->string('description', 255)->nullable();
    $table->timestamps();
});

Schema::create('task_tags', function (Blueprint $table) {
    $table->id();
    $table->foreignId('task_id')->constrained()->onDelete('cascade');
    $table->foreignId('tag_id')->constrained()->onDelete('cascade');
    $table->timestamps();
    $table->unique(['task_id', 'tag_id']);
});
```

---

## Akses URL

### Raw SQL Endpoints
```
GET  /tags/raw-sql              (List)
GET  /tags/raw-sql/create       (Create form)
POST /tags/raw-sql              (Store)
GET  /tags/raw-sql/{id}         (Show detail)
GET  /tags/raw-sql/{id}/edit    (Edit form)
PUT  /tags/raw-sql/{id}         (Update)
DELETE /tags/raw-sql/{id}       (Delete)
```

### Query Builder Endpoints
```
GET  /tags/query-builder              (List)
GET  /tags/query-builder/create       (Create form)
POST /tags/query-builder              (Store)
GET  /tags/query-builder/{id}         (Show detail)
GET  /tags/query-builder/{id}/edit    (Edit form)
PUT  /tags/query-builder/{id}         (Update)
DELETE /tags/query-builder/{id}       (Delete)
```

---

## Testing

### Cara Test

1. **Login** ke aplikasi
2. **Raw SQL**: http://localhost:8000/tags/raw-sql
3. **Query Builder**: http://localhost:8000/tags/query-builder
4. **Test CRUD**:
   - ✅ Create: Klik "Tambah Tag"
   - ✅ Read: Lihat list & detail
   - ✅ Update: Klik Edit & ubah
   - ✅ Delete: Klik Delete

### Sample Data
Database sudah di-seed dengan 8 sample tags:
- Frontend (Blue)
- Backend (Purple)
- Database (Indigo)
- Testing (Green)
- Urgent (Red)
- Documentation (Gray)
- Design (Pink)
- Optimization (Yellow)

---

## Performance Considerations

### Raw SQL
- ✅ Lebih cepat untuk simple operations
- ✅ Lebih fleksibel untuk complex queries
- ⚠️ Perlu di-optimize manual

### Query Builder
- ✅ Consistent performance
- ✅ Automatic query optimization
- ⚠️ Sedikit overhead

### Benchmark (Approximate)
```
Raw SQL: 1ms untuk 100 records
Query Builder: 1.5ms untuk 100 records
Perbedaan: Negligible untuk aplikasi normal
```

---

## Kesimpulan

| Teknik | Cocok Untuk | Rekomendasi |
|--------|------------|-------------|
| **Raw SQL** | Complex queries, high performance | Gunakan jika perlu, tapi hati-hati SQL injection |
| **Query Builder** | Standard CRUD, maintainability | ✅ Pilihan utama untuk 90% kasus |

---

## Resources

- [Laravel Query Builder Docs](https://laravel.com/docs/database/query-builder)
- [Laravel Raw SQL Docs](https://laravel.com/docs/database/queries)
- [SQL Injection Prevention](https://owasp.org/www-community/attacks/SQL_Injection)

---

**Version**: 1.0.0  
**Last Updated**: June 9, 2026  
**Status**: ✅ Complete
