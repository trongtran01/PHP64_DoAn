<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'name',
        'description',
        'content',
        'hot',
        'photo'
    ];

    public $timestamps = false;

    /**
     * Lấy danh sách tin tức phân trang
     */
    public static function getAllPaginated($perPage = 50)
    {
        return self::orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Tạo hoặc cập nhật tin tức
     */
    public static function saveNews($data, $file = null, $id = null)
    {
        if ($id) {
            $news = self::find($id);
            if (!$news) return null;
        } else {
            $news = new self();
        }

        $news->fill($data);
        $news->hot = isset($data['hot']) ? 1 : 0;

        // Upload ảnh
        if ($file) {
            if ($news->photo && Storage::exists('public/news/'.$news->photo)) {
                Storage::delete('public/news/'.$news->photo);
            }
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/news', $filename);
            $news->photo = $filename;
        }

        $news->save();
        return $news;
    }

    /**
     * Xóa tin tức và ảnh liên quan
     */
    public function deleteNews()
    {
        if ($this->photo && Storage::exists('public/news/'.$this->photo)) {
            Storage::delete('public/news/'.$this->photo);
        }
        return $this->delete();
    }
}
