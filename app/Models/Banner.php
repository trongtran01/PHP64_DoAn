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
        return self::orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Tạo hoặc cập nhật banner
     */
    public static function saveBanner($data, $file = null, $id = null)
    {
        if ($id) {
            $banner = self::find($id);
            if (!$banner) return null;
        } else {
            $banner = new self();
        }

        $banner->fill($data);
        $banner->display_at_home_page = isset($data['display_at_home_page']) ? 1 : 0;

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
