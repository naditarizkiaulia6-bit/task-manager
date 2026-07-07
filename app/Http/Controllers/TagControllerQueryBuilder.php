<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TagControllerQueryBuilder extends Controller
{
    public function index(): View
    {
        // Query Builder untuk mengambil semua tags
        $tags = DB::table('tags')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tags.query-builder.index', compact('tags'));
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

        return view('tags.query-builder.create', compact('colors'));
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
            // Query Builder untuk INSERT
            DB::table('tags')->insert([
                'name' => $validated['name'],
                'color' => $validated['color'],
                'description' => $validated['description'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('tags.query-builder.index')
                ->with('success', 'Tag berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan tag: ' . $e->getMessage());
        }
    }

    public function show($id): View
    {
        // Query Builder untuk mengambil tag spesifik
        $tag = DB::table('tags')
            ->where('id', $id)
            ->first();
        
        if (!$tag) {
            abort(404, 'Tag tidak ditemukan');
        }

        // Query Builder untuk menghitung jumlah tasks
        $taskCount = DB::table('task_tags')
            ->where('tag_id', $id)
            ->count();

        return view('tags.query-builder.show', compact('tag', 'taskCount'));
    }

    public function edit($id): View
    {
        // Query Builder untuk mengambil tag
        $tag = DB::table('tags')
            ->where('id', $id)
            ->first();
        
        if (!$tag) {
            abort(404, 'Tag tidak ditemukan');
        }

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
        return view('tags.query-builder.edit', compact('tag', 'colors'));
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
            // Query Builder untuk UPDATE
            $updated = DB::table('tags')
                ->where('id', $id)
                ->update([
                    'name' => $validated['name'],
                    'color' => $validated['color'],
                    'description' => $validated['description'] ?? null,
                    'updated_at' => now(),
                ]);

            if ($updated) {
                return redirect()->route('tags.query-builder.show', $id)
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
            DB::table('task_tags')
                ->where('tag_id', $id)
                ->delete();

            // Query Builder untuk DELETE
            $deleted = DB::table('tags')
                ->where('id', $id)
                ->delete();

            if ($deleted) {
                return redirect()->route('tags.query-builder.index')
                    ->with('success', 'Tag berhasil dihapus!');
            } else {
                return back()->with('error', 'Tag tidak ditemukan');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus tag: ' . $e->getMessage());
        }
    }
    public function paginated(Request $request)
    {
        // Query Builder dengan pagination
        $tags = DB::table('tags')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tags.query-builder.paginated', compact('tags'));
    }
    public function statistics()
    {
        // Query Builder untuk aggregate functions
        $stats = DB::table('tags')
            ->leftJoin('task_tags', 'tags.id', '=', 'task_tags.tag_id')
            ->select(
                'tags.id',
                'tags.name',
                'tags.color',
                DB::raw('COUNT(DISTINCT task_tags.id) as usage_count'),
                DB::raw('COUNT(DISTINCT task_tags.task_id) as task_count')
            )
            ->groupBy('tags.id', 'tags.name', 'tags.color')
            ->orderBy('usage_count', 'desc')
            ->get();

        return response()->json($stats);
    }
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        // Query Builder dengan LIKE clause
        $tags = DB::table('tags')
            ->where('name', 'like', '%' . $query . '%')
            ->orderBy('name', 'asc')
            ->limit(10)
            ->get();

        return response()->json($tags);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return back()->with('error', 'Pilih minimal 1 tag');
        }
        try {
            // Query Builder untuk bulk delete
            DB::table('task_tags')
                ->whereIn('tag_id', $ids)
                ->delete();

            DB::table('tags')
                ->whereIn('id', $ids)
                ->delete();

            return back()->with('success', count($ids) . ' tag berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus tags: ' . $e->getMessage());
        }
    }

    public function filter(Request $request)
    {
        $query = DB::table('tags');

        // Filter berdasarkan color
        if ($request->filled('color')) {
            $query->where('color', $request->input('color'));
        }
        // Filter berdasarkan search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }
        // Urutkan
        $orderBy = $request->input('order_by', 'created_at');
        $orderDir = $request->input('order', 'desc');
        $query->orderBy($orderBy, $orderDir);

        $tags = $query->get();

        return view('tags.query-builder.filter', compact('tags'));
    }

    public function batchUpdate(Request $request)
    {
        $ids = $request->input('ids', []);
        $color = $request->input('color');

        if (empty($ids) || !$color) {
            return back()->with('error', 'Data tidak valid');
        }

        try {
            // Query Builder untuk batch update
            $updated = DB::table('tags')
                ->whereIn('id', $ids)
                ->update([
                    'color' => $color,
                    'updated_at' => now(),
                ]);

            return back()->with('success', $updated . ' tag berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui tags: ' . $e->getMessage());
        }
    }

    public function withStats()
    {
        // Query Builder dengan join dan group by
        $tags = DB::table('tags')
            ->leftJoin('task_tags', 'tags.id', '=', 'task_tags.tag_id')
            ->select(
                'tags.id',
                'tags.name',
                'tags.color',
                'tags.created_at',
                DB::raw('COUNT(task_tags.id) as total_usage')
            )
            ->groupBy('tags.id', 'tags.name', 'tags.color', 'tags.created_at')
            ->havingRaw('COUNT(task_tags.id) > 0')
            ->get();

        return view('tags.query-builder.with-stats', compact('tags'));
    }
}
