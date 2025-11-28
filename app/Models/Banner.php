<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'photo',
        'button_url',
        'display_at_home_page',
    ];

    /**
     * Lấy danh sách banner phân trang
     */
    public static function getAllPaginated($perPage = 50)
    {
        return self::orderByDesc('id')->paginate($perPage);
    }

    /**
     * Lưu banner (tạo mới hoặc cập nhật)
     */
    public static function saveBanner(array $data, $file = null, $id = null)
    {
        if ($id) {
            $banner = self::findOrFail($id);
        } else {
            $banner = new self();
        }

        // Gán dữ liệu từ controller
        $banner->fill($data);

        // Xử lý upload ảnh nếu có
        if ($file) {
            if ($banner->photo && Storage::exists('public/banner/'.$banner->photo)) {
                Storage::delete('public/banner/'.$banner->photo);
            }
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/banner', $filename);
            $banner->photo = $filename;
        }

        $banner->save();
        return $banner;
    }

    /**
     * Xóa banner và ảnh liên quan
     */
    public function deleteBanner()
    {
        if ($this->photo && Storage::exists('public/banner/'.$this->photo)) {
            Storage::delete('public/banner/'.$this->photo);
        }
        return $this->delete();
    }
}
