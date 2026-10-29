<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    use HasFactory;

    public const TYPE_SIMPLE = 'simple';
    public const TYPE_CONFIGURABLE = 'configurable';

    protected $table = 'products';

    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'description',
        'content',
        'hot',
        'photo',
        'price',
        'discount',
        'is_active',
        // 'stock' cố ý KHÔNG đưa vào đây: chỉ StockService được đổi tồn kho
    ];

    protected $casts = [
        'price'     => 'integer',
        'discount'  => 'integer',
        'stock'     => 'integer',
        'is_active' => 'boolean',
    ];

    public $timestamps = false;

    /* ------------------------------------------------------------------
     | Quan hệ
     * ------------------------------------------------------------------ */

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    /** Sản phẩm cha (nếu đây là sản phẩm con của configurable) */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /** Các sản phẩm con (nếu đây là configurable cha) */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /* ------------------------------------------------------------------
     | Scope
     * ------------------------------------------------------------------ */

    /** Chỉ lấy sản phẩm đang bật (enable) */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    /** Sản phẩm hiển thị ở listing/tìm kiếm: bật + không phải sản phẩm con */
    public function scopeListable(Builder $query): Builder
    {
        return $query->where('is_active', 1)->whereNull('parent_id');
    }

    /* ------------------------------------------------------------------
     | Loại sản phẩm
     * ------------------------------------------------------------------ */

    public function isConfigurable(): bool
    {
        return $this->product_type === self::TYPE_CONFIGURABLE && $this->parent_id === null;
    }

    public function isChild(): bool
    {
        return $this->parent_id !== null;
    }

    /** Sản phẩm có tồn kho riêng và mua trực tiếp được (simple hoặc con) */
    public function isPurchasable(): bool
    {
        return !$this->isConfigurable();
    }

    /* ------------------------------------------------------------------
     | Giá & tồn kho
     * ------------------------------------------------------------------ */

    /**
     * % giảm giá hiệu lực. Sản phẩm con luôn lấy discount của cha.
     */
    public function effectiveDiscount(): int
    {
        if ($this->isChild()) {
            return (int) ($this->parent?->discount ?? 0);
        }
        return (int) $this->discount;
    }

    /**
     * Giá bán cuối cùng (VND, số nguyên). MỌI NƠI (listing, chi tiết, giỏ,
     * đơn hàng, Stripe) phải dùng hàm này để tính giá.
     */
    public function finalPrice(): int
    {
        $discount = max(0, min(100, $this->effectiveDiscount()));
        return (int) round($this->price * (100 - $discount) / 100);
    }

    public function getFinalPriceAttribute(): int
    {
        return $this->finalPrice();
    }

    /** Còn hàng cho số lượng yêu cầu? (chỉ đọc, không khóa dòng) */
    public function isInStock(int $qty = 1): bool
    {
        return $this->isPurchasable() && $this->is_active && $this->stock >= $qty;
    }

    /* ------------------------------------------------------------------
     | CRUD (giữ nguyên cách làm cũ)
     * ------------------------------------------------------------------ */

    public static function getAllPaginated($perPage = 50)
    {
        return self::orderBy('id', 'desc')->paginate($perPage);
    }

    public function getCategoryName()
    {
        return $this->category ? $this->category->name : '';
    }

    public static function saveProduct($data, $file = null, $id = null)
    {
        if ($id) {
            $product = self::find($id);
            if (!$product) return null;
        } else {
            $product = new self();
        }

        $product->fill($data);
        $product->hot = isset($data['hot']) ? 1 : 0;

        if ($file) {
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

    public function deleteProduct()
    {
        if ($this->photo && Storage::exists('public/products/'.$this->photo)) {
            Storage::delete('public/products/'.$this->photo);
        }
        return $this->delete();
    }
}