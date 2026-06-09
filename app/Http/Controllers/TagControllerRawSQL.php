<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TagControllerRawSQL extends Controller
{ 
    public function index(): View
    {
        // Raw SQL untuk mengambil semua tags
        $tags = DB::select('SELECT id, name, color, description, created_at FROM tags ORDER BY created_at DESC');

        return view('tags.raw-sql.index', compact('tags'));
    }
    public function create(): View
    {
        $colors = [
            'red' => 'Merah',
            'blue' => 'Biru',
            'green' => 'Hijau',
            'yellow' => 'Kuning',
            'purple' => 'Ungu',
            'pink' => 'Pink',
            'indigo' => 'Indigo',
            'gray' => 'Abu-abu',
        ];

        return view('tags.raw-sql.create', compact('colors'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:tags,name',
            'color' => 'required|string',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            // Raw SQL untuk INSERT
            $sql = 'INSERT INTO tags (name, color, description, created_at, updated_at) 
                    VALUES (?, ?, ?, NOW(), NOW())';
            
            DB::insert($sql, [
                $validated['name'],
                $validated['color'],
                $validated['description'] ?? null,
            ]);

            return redirect()->route('tags.raw-sql.index')
                ->with('success', 'Tag berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan tag: ' . $e->getMessage());
        }
    }

    public function show($id): View
    {
        // Raw SQL untuk mengambil tag spesifik
        $tags = DB::select('SELECT id, name, color, description, created_at FROM tags WHERE id = ?', [$id]);
        
        if (empty($tags)) {
            abort(404, 'Tag tidak ditemukan');
        }

        $tag = $tags[0];
        
        // Ambil jumlah tasks yang menggunakan tag ini
        $taskCount = DB::select('
            SELECT COUNT(*) as count FROM task_tags WHERE tag_id = ?
        ', [$id])[0]->count;

        return view('tags.raw-sql.show', compact('tag', 'taskCount'));
    }

    public function edit($id): View
    {
        // Raw SQL untuk mengambil tag
        $tags = DB::select('SELECT id, name, color, description, created_at FROM tags WHERE id = ?', [$id]);
        
        if (empty($tags)) {
            abort(404, 'Tag tidak ditemukan');
        }

        $tag = $tags[0];
        
        $colors = [
            'red' => 'Merah',
            'blue' => 'Biru',
            'green' => 'Hijau',
            'yellow' => 'Kuning',
            'purple' => 'Ungu',
            'pink' => 'Pink',
            'indigo' => 'Indigo',
            'gray' => 'Abu-abu',
        ];

        return view('tags.raw-sql.edit', compact('tag', 'colors'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:tags,name,' . $id,
            'color' => 'required|string',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            // Raw SQL untuk UPDATE
            $sql = 'UPDATE tags SET name = ?, color = ?, description = ?, updated_at = NOW() WHERE id = ?';
            
            $updated = DB::update($sql, [
                $validated['name'],
                $validated['color'],
                $validated['description'] ?? null,
                $id,
            ]);

            if ($updated) {
                return redirect()->route('tags.raw-sql.show', $id)
                    ->with('success', 'Tag berhasil diperbarui!');
            } else {
                return back()->with('error', 'Tag tidak ditemukan');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui tag: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Hapus relationship terlebih dahulu
            DB::delete('DELETE FROM task_tags WHERE tag_id = ?', [$id]);

            // Raw SQL untuk DELETE tag
            $deleted = DB::delete('DELETE FROM tags WHERE id = ?', [$id]);

            if ($deleted) {
                return redirect()->route('tags.raw-sql.index')
                    ->with('success', 'Tag berhasil dihapus!');
            } else {
                return back()->with('error', 'Tag tidak ditemukan');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus tag: ' . $e->getMessage());
        }
    }
    public function statistics()
    {
        // Raw SQL untuk mengambil statistik
        $stats = DB::select('
            SELECT 
                COUNT(DISTINCT t.id) as total_tags,
                COUNT(DISTINCT tt.task_id) as total_tasks_tagged,
                t.name,
                t.color,
                COUNT(tt.id) as usage_count
            FROM tags t
            LEFT JOIN task_tags tt ON t.id = tt.tag_id
            GROUP BY t.id, t.name, t.color
            ORDER BY usage_count DESC
        ');

        return response()->json($stats);
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        // Raw SQL dengan LIKE untuk pencarian
        $tags = DB::select('
            SELECT id, name, color FROM tags 
            WHERE name LIKE ? 
            ORDER BY name ASC
            LIMIT 10
        ', ['%' . $query . '%']);

        return response()->json($tags);
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return back()->with('error', 'Pilih minimal 1 tag');
        }
        try {
            // Raw SQL untuk bulk delete
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            
            DB::delete("DELETE FROM task_tags WHERE tag_id IN ($placeholders)", $ids);
            DB::delete("DELETE FROM tags WHERE id IN ($placeholders)", $ids);

            return back()->with('success', count($ids) . ' tag berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus tags: ' . $e->getMessage());
        }
    }
}
