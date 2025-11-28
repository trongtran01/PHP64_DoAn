<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Hiển thị danh sách tin tức
     */
    public function index()
    {
        $data = News::getAllPaginated(10); // Phân trang 10 bản ghi
        return view('admin.news.index', compact('data'));
    }

    /**
     * Hiển thị form tạo tin tức
     */
    public function create()
    {
        $action = route('admin.news.store');
        return view('admin.news.form', compact('action'));
    }

    /**
     * Xử lý tạo tin tức
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'hot' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name','description','content']);
        $data['hot'] = $request->has('hot') ? 1 : 0;
        $file = $request->file('photo');

        News::saveNews($data, $file);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    /**
     * Hiển thị form cập nhật
     */
    public function edit($id)
    {
        $record = News::findOrFail($id);
        $action = route('admin.news.update', $id);
        return view('admin.news.form', compact('record', 'action'));
    }

    /**
     * Xử lý cập nhật tin tức
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'hot' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name','description','content']);
        $data['hot'] = $request->has('hot') ? 1 : 0;
        $file = $request->file('photo');

        News::saveNews($data, $file, $id);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    /**
     * Xóa tin tức
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->deleteNews();

        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}
