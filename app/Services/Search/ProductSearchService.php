<?php

namespace App\Services\Search;

use Illuminate\Support\Facades\DB;

class ProductSearchService
{
    const MAX_GROUPS = 4;
    const PER_GROUP = 4;
    const FETCH_LIMIT = 100;   
    const MAX_DEPTH = 10;
    /**
     * @param  string|null  $key
     * @return array{key:string,total:int,groups:array}
     */
    public function search($key)
    {
        $key = trim((string) $key);
        $result = ['key' => $key, 'total' => 0, 'groups' => []];

        if ($key === '') {
            return $result;
        }

        // Escape ký tự đặc biệt của LIKE để người dùng gõ % hoặc _ không bị hiểu nhầm
        $like = '%' . addcslashes($key, '\\%_') . '%';

        $query = DB::table('products')->where(function ($q) use ($like) {
            $q->where('name', 'like', $like)
                ->orWhere('description', 'like', $like)
                ->orWhere('content', 'like', $like);
        });

        $total = (clone $query)->count();
        if ($total === 0) {
            return $result;
        }

        // Sản phẩm khớp ở tên được xếp trước, sau đó mới tới khớp ở mô tả/nội dung
        $rows = $query
            ->select('id', 'name', 'price', 'photo', 'category_id')
            ->orderByRaw('CASE WHEN name LIKE ? THEN 0 ELSE 1 END', [$like])
            ->orderBy('id', 'desc')
            ->limit(self::FETCH_LIMIT)
            ->get();

        // Bảng danh mục nhỏ nên lấy hết một lần để tự tìm danh mục cha gốc, tránh query lặp
        $categories = DB::table('categories')->select('id', 'name', 'parent_id')->get()->keyBy('id');

        $groups = [];
        $byRoot = $rows->groupBy(function ($row) use ($categories) {
            return $this->rootCategoryId($row->category_id, $categories);
        });

        foreach ($byRoot as $rootId => $products) {
            $root = $rootId ? $categories->get($rootId) : null;

            $groups[] = [
                'id'       => $root ? (int) $root->id : null,
                'name'     => $root ? $root->name : 'Khác',
                'url'      => $root ? route('products.category', $root->id) : null,
                'count'    => $products->count(),
                'products' => $products->take(self::PER_GROUP)->map(function ($p) {
                    return [
                        'id'    => $p->id,
                        'name'  => $p->name,
                        'price' => $this->formatPrice($p->price),
                        'photo' => $p->photo ? asset('storage/products/' . $p->photo) : null,
                        'url'   => url('products/detail/' . $p->id),
                    ];
                })->values()->all(),
            ];

            if (count($groups) >= self::MAX_GROUPS) {
                break;
            }
        }

        $result['total'] = $total;
        $result['groups'] = $groups;

        return $result;
    }

    /**
     * Đi ngược theo parent_id để tìm danh mục cha gốc (parent_id = 0 hoặc null).
     * Trả về 0 nếu sản phẩm không có danh mục hợp lệ (sẽ vào nhóm "Khác").
     */
    private function rootCategoryId($categoryId, $categories)
    {
        $current = $categories->get($categoryId);
        if (!$current) {
            return 0;
        }

        for ($i = 0; $i < self::MAX_DEPTH; $i++) {
            $parent = $current->parent_id ? $categories->get($current->parent_id) : null;
            if (!$parent) {
                break;
            }
            $current = $parent;
        }

        return (int) $current->id;
    }

    private function formatPrice($price)
    {
        return (float) $price > 0 ? number_format((float) $price) . '₫' : 'Liên hệ';
    }
}