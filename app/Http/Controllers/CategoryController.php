<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            } else {
                $iconPath = 'images/icon-category-default.png';
            }

            $validated['slug'] = Str::slug($validated['name']);
            Log::channel('CategoryController')->info('Data yang akan disimpan:', $validated);

            $category = Category::create($validated);
        });

        Alert::success('Success', 'Kategori berhasil dibuat!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("admin.categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
  
     public function update(UpdateCategoryRequest $request, Category $category)

    {
        try {
            DB::transaction(function () use ($request, $category) {
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'icon' => 'nullable|image',
                ]);

                if ($request->hasFile('icon')) {
                    $iconPath = $request->file('icon')->store('icons', 'public');
                    $validated['icon'] = $iconPath;
                }

                $validated['slug'] = Str::slug($validated['name']);
                Log::channel('CategoryController')->info('Data yang akan diperbarui:', $validated);

                $category->update($validated);
            });

            Alert::success('Success', 'Kategori berhasil diperbarui!');
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui kategori. ' . $e->getMessage());
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category) {
            DB::transaction(function () use ($category) {
                // Hapus ikon dari penyimpanan
                if ($category->icon) {
                    Storage::disk('public')->delete($category->icon);
                }
                $category->delete();
            });
    
            Alert::success('Success', 'Kategori berhasil dihapus!');
            return redirect()->route('admin.categories.index');
        } else {
            Alert::error('Error', 'Kategori tidak ditemukan!');
            return redirect()->route('admin.categories.index');
        }
    }
    
}
