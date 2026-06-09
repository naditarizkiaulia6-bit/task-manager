@extends('layouts.app')

@section('page_title', 'CRUD Comparison - Raw SQL vs Query Builder')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-2">CRUD Implementation Comparison</h2>
        <p class="text-slate-600">Perbandingan langsung antara Raw SQL dan Query Builder untuk operasi CRUD</p>
    </div>

    <!-- Navigation -->
    <div class="flex gap-2 mb-8 overflow-x-auto">
        <a href="#create" class="px-4 py-2 bg-indigo-500 text-white rounded-lg font-medium">CREATE</a>
        <a href="#read" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg font-medium hover:bg-slate-300">READ</a>
        <a href="#update" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg font-medium hover:bg-slate-300">UPDATE</a>
        <a href="#delete" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg font-medium hover:bg-slate-300">DELETE</a>
        <a href="#advanced" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg font-medium hover:bg-slate-300">ADVANCED</a>
    </div>

    <!-- CREATE Section -->
    <div id="create" class="bg-white rounded-xl shadow-sm p-8 mb-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-6">1. CREATE (Insert New Record)</h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Raw SQL -->
            <div class="border border-indigo-200 rounded-lg overflow-hidden">
                <div class="bg-indigo-50 px-4 py-3 border-b border-indigo-200">
                    <h4 class="font-bold text-indigo-900">🔴 Raw SQL</h4>
                </div>
                <div class="p-4">
                    <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>
// Controller method
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|unique:tags',
        'color' => 'required',
    ]);

    $sql = 'INSERT INTO tags 
            (name, color, description, created_at, updated_at) 
            VALUES (?, ?, ?, NOW(), NOW())';
    
    DB::insert($sql, [
        $validated['name'],
        $validated['color'],
        $validated['description'],
    ]);
}
                    </code></pre>
                    <div class="mt-4 p-3 bg-yellow-50 rounded text-sm text-yellow-800">
                        <strong>⚠️ Note:</strong> Gunakan placeholder (?) untuk mencegah SQL injection
                    </div>
                </div>
            </div>

            <!-- Query Builder -->
            <div class="border border-green-200 rounded-lg overflow-hidden">
                <div class="bg-green-50 px-4 py-3 border-b border-green-200">
                    <h4 class="font-bold text-green-900">✅ Query Builder</h4>
                </div>
                <div class="p-4">
                    <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>
// Controller method
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|unique:tags',
        'color' => 'required',
    ]);

    DB::table('tags')->insert([
        'name' => $validated['name'],
        'color' => $validated['color'],
        'description' => $validated['description'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
                    </code></pre>
                    <div class="mt-4 p-3 bg-green-50 rounded text-sm text-green-800">
                        <strong>✅ Benefit:</strong> Built-in SQL injection protection, readable
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- READ Section -->
    <div id="read" class="bg-white rounded-xl shadow-sm p-8 mb-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-6">2. READ (Fetch Records)</h3>

        <div class="space-y-8">
            <!-- Read All -->
            <div>
                <h4 class="text-lg font-semibold text-slate-900 mb-4">Read All Records</h4>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="border border-indigo-200 rounded-lg overflow-hidden">
                        <div class="bg-indigo-50 px-4 py-3 border-b border-indigo-200">
                            <h5 class="font-bold text-indigo-900">Raw SQL</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
$tags = DB::select(
    'SELECT * FROM tags ORDER BY created_at DESC'
);
                            </code></pre>
                        </div>
                    </div>

                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 px-4 py-3 border-b border-green-200">
                            <h5 class="font-bold text-green-900">Query Builder</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
$tags = DB::table('tags')
    ->orderBy('created_at', 'desc')
    ->get();
                            </code></pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Read Single -->
            <div>
                <h4 class="text-lg font-semibold text-slate-900 mb-4">Read Single Record</h4>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="border border-indigo-200 rounded-lg overflow-hidden">
                        <div class="bg-indigo-50 px-4 py-3 border-b border-indigo-200">
                            <h5 class="font-bold text-indigo-900">Raw SQL</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
$tags = DB::select(
    'SELECT * FROM tags WHERE id = ?',
    [$id]
);
$tag = $tags[0] ?? null;
                            </code></pre>
                        </div>
                    </div>

                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 px-4 py-3 border-b border-green-200">
                            <h5 class="font-bold text-green-900">Query Builder</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
$tag = DB::table('tags')
    ->where('id', $id)
    ->first();
                            </code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- UPDATE Section -->
    <div id="update" class="bg-white rounded-xl shadow-sm p-8 mb-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-6">3. UPDATE (Modify Records)</h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="border border-indigo-200 rounded-lg overflow-hidden">
                <div class="bg-indigo-50 px-4 py-3 border-b border-indigo-200">
                    <h4 class="font-bold text-indigo-900">🔴 Raw SQL</h4>
                </div>
                <div class="p-4">
                    <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>
$sql = 'UPDATE tags 
        SET name = ?, color = ?, 
            updated_at = NOW() 
        WHERE id = ?';

$updated = DB::update($sql, [
    $validated['name'],
    $validated['color'],
    $id,
]);

if ($updated) {
    // Success
}
                    </code></pre>
                </div>
            </div>

            <div class="border border-green-200 rounded-lg overflow-hidden">
                <div class="bg-green-50 px-4 py-3 border-b border-green-200">
                    <h4 class="font-bold text-green-900">✅ Query Builder</h4>
                </div>
                <div class="p-4">
                    <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>
$updated = DB::table('tags')
    ->where('id', $id)
    ->update([
        'name' => $validated['name'],
        'color' => $validated['color'],
        'updated_at' => now(),
    ]);

if ($updated) {
    // Success
}
                    </code></pre>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE Section -->
    <div id="delete" class="bg-white rounded-xl shadow-sm p-8 mb-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-6">4. DELETE (Remove Records)</h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="border border-indigo-200 rounded-lg overflow-hidden">
                <div class="bg-indigo-50 px-4 py-3 border-b border-indigo-200">
                    <h4 class="font-bold text-indigo-900">🔴 Raw SQL</h4>
                </div>
                <div class="p-4">
                    <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>
// Delete related records first
DB::delete(
    'DELETE FROM task_tags WHERE tag_id = ?',
    [$id]
);

// Delete the record
$deleted = DB::delete(
    'DELETE FROM tags WHERE id = ?',
    [$id]
);

if ($deleted) {
    // Success
}
                    </code></pre>
                </div>
            </div>

            <div class="border border-green-200 rounded-lg overflow-hidden">
                <div class="bg-green-50 px-4 py-3 border-b border-green-200">
                    <h4 class="font-bold text-green-900">✅ Query Builder</h4>
                </div>
                <div class="p-4">
                    <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-sm overflow-x-auto"><code>
// Delete related records first
DB::table('task_tags')
    ->where('tag_id', $id)
    ->delete();

// Delete the record
$deleted = DB::table('tags')
    ->where('id', $id)
    ->delete();

if ($deleted) {
    // Success
}
                    </code></pre>
                </div>
            </div>
        </div>
    </div>

    <!-- ADVANCED Section -->
    <div id="advanced" class="bg-white rounded-xl shadow-sm p-8 mb-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-6">5. ADVANCED Operations</h3>

        <div class="space-y-8">
            <!-- Bulk Operations -->
            <div>
                <h4 class="text-lg font-semibold text-slate-900 mb-4">Bulk Delete</h4>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="border border-indigo-200 rounded-lg overflow-hidden">
                        <div class="bg-indigo-50 px-4 py-3 border-b border-indigo-200">
                            <h5 class="font-bold text-indigo-900">Raw SQL</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
$placeholders = implode(',', 
    array_fill(0, count($ids), '?')
);

DB::delete(
    "DELETE FROM tags WHERE id IN ($placeholders)",
    $ids
);
                            </code></pre>
                        </div>
                    </div>

                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 px-4 py-3 border-b border-green-200">
                            <h5 class="font-bold text-green-900">Query Builder</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
DB::table('tags')
    ->whereIn('id', $ids)
    ->delete();
                            </code></pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div>
                <h4 class="text-lg font-semibold text-slate-900 mb-4">Search with LIKE</h4>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="border border-indigo-200 rounded-lg overflow-hidden">
                        <div class="bg-indigo-50 px-4 py-3 border-b border-indigo-200">
                            <h5 class="font-bold text-indigo-900">Raw SQL</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
$tags = DB::select('
    SELECT * FROM tags 
    WHERE name LIKE ? 
    ORDER BY name ASC',
    ['%' . $search . '%']
);
                            </code></pre>
                        </div>
                    </div>

                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 px-4 py-3 border-b border-green-200">
                            <h5 class="font-bold text-green-900">Query Builder</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
$tags = DB::table('tags')
    ->where('name', 'like', '%' . $search . '%')
    ->orderBy('name')
    ->get();
                            </code></pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Complex Join -->
            <div>
                <h4 class="text-lg font-semibold text-slate-900 mb-4">Complex Query with JOIN</h4>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="border border-indigo-200 rounded-lg overflow-hidden">
                        <div class="bg-indigo-50 px-4 py-3 border-b border-indigo-200">
                            <h5 class="font-bold text-indigo-900">Raw SQL</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
$stats = DB::select('
    SELECT t.*, COUNT(tt.id) usage
    FROM tags t
    LEFT JOIN task_tags tt ON t.id = tt.tag_id
    GROUP BY t.id
    ORDER BY usage DESC'
);
                            </code></pre>
                        </div>
                    </div>

                    <div class="border border-green-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 px-4 py-3 border-b border-green-200">
                            <h5 class="font-bold text-green-900">Query Builder</h5>
                        </div>
                        <div class="p-4">
                            <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs overflow-x-auto"><code>
$stats = DB::table('tags')
    ->leftJoin('task_tags', 
        'tags.id', '=', 'task_tags.tag_id')
    ->select('tags.*', 
        DB::raw('COUNT(task_tags.id) usage'))
    ->groupBy('tags.id')
    ->orderBy('usage', 'desc')
    ->get();
                            </code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Table -->
    <div class="bg-white rounded-xl shadow-sm p-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-6">Ringkasan Perbandingan</h3>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-300 bg-slate-50">
                        <th class="px-4 py-3 text-left font-semibold text-slate-900">Aspek</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-900">Raw SQL</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-900">Query Builder</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <tr>
                        <td class="px-4 py-3 font-medium">Readability</td>
                        <td class="px-4 py-3">⭐⭐ Sulit dibaca</td>
                        <td class="px-4 py-3">⭐⭐⭐⭐⭐ Sangat readable</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 font-medium">Performance</td>
                        <td class="px-4 py-3">⭐⭐⭐⭐⭐ Cepat</td>
                        <td class="px-4 py-3">⭐⭐⭐⭐ Cepat</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 font-medium">Security</td>
                        <td class="px-4 py-3">⭐⭐ Harus hati-hati</td>
                        <td class="px-4 py-3">⭐⭐⭐⭐⭐ Built-in</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 font-medium">Flexibility</td>
                        <td class="px-4 py-3">⭐⭐⭐⭐⭐ Penuh kontrol</td>
                        <td class="px-4 py-3">⭐⭐⭐ Terbatas</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 font-medium">Maintainability</td>
                        <td class="px-4 py-3">⭐⭐ Sulit</td>
                        <td class="px-4 py-3">⭐⭐⭐⭐⭐ Mudah</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
            <p class="text-sm text-green-800">
                <strong>✅ Rekomendasi:</strong> Gunakan <strong>Query Builder</strong> untuk 90% kasus, 
                gunakan <strong>Raw SQL</strong> hanya jika query sangat kompleks dan perlu performa maksimal.
            </p>
        </div>
    </div>

    <!-- Access Links -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('tags.raw-sql.index') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-lg transition-colors text-center font-medium">
            🔴 Coba Raw SQL CRUD
        </a>
        <a href="{{ route('tags.query-builder.index') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition-colors text-center font-medium">
            ✅ Coba Query Builder CRUD
        </a>
    </div>
@endsection
