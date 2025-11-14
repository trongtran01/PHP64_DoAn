<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'products';

    // Các trường có thể gán hàng loạt
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'content',
        'hot',
        'photo',
        'price',
        'discount'
    ];

    // Nếu không dùng created_at & updated_at
    public $timestamps = false;

    /**
     * Quan hệ với Category
     */
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    /**
     * Lấy danh sách sản phẩm phân trang
     */
    public static function getAllPaginated($perPage = 50)
    {
        return self::orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Lấy tên category
     */
    public function getCategoryName()
    {
        return $this->category ? $this->category->name : '';
    }

    /**
     * Tạo hoặc cập nhật sản phẩm
     */
    public static function saveProduct($data, $file = null, $id = null)
    {
        if ($id) {
            $product = self::find($id);
            if (!$product) return null;
        } else {
            $product = new self();
        }

        // Gán giá trị
        $product->fill($data);
        $product->hot = isset($data['hot']) ? 1 : 0;

        // Xử lý ảnh
        if ($file) {
            // Xóa ảnh cũ nếu update
            if ($product->photo && Storage::exists('public/products/'.$product->photo)) {
                Storage::delete('public/products/'.$product->photo);
            }
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/products', $filename);
            $product->photo = $filename;
        }

        $product->save();

        return $product;
    }

    /**
     * Xóa sản phẩm và ảnh liên quan
     */
    public function deleteProduct()
    {
        if ($this->photo && Storage::exists('public/products/'.$this->photo)) {
            Storage::delete('public/products/'.$this->photo);
        }
        return $this->delete();
    }
}
