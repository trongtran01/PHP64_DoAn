<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\InsufficientStockException;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

class ProductsController extends Controller
{
    public function index()
    {
        $data = Products::getAllPaginated();
        return view('admin.products.index', compact('data'));
    }

    public function create()
    {
        $categories = Categories::all();
        $action = route('admin.products.store');
        return view('admin.products.form', compact('categories', 'action'));
    }

    public function store(Request $request, StockService $stock)
    {
        $request->validate($this->rules());

        $data = $this->payload($request);
        $file = $request->file('photo');
        $initialStock = (int) $request->input('stock', 0);

        DB::transaction(function () use ($data, $file, $initialStock, $stock) {
            $product = Products::saveProduct($data, $file);

            // Tồn kho ban đầu cũng phải đi qua StockService để có lịch sử
            if ($initialStock > 0) {
                $stock->increase(
                    $product->id,
                    $initialStock,
                    StockService::REASON_INITIAL,
                    null,
                    null,
                    'Tồn kho ban đầu',
                    auth()->id()
                );
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $record = Products::findOrFail($id);
        $categories = Categories::all();
        $action = route('admin.products.update', $id);
        return view('admin.products.form', compact('record', 'categories', 'action'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->rules($id));

        // Cố ý không nhận 'stock' ở đây: tồn kho chỉ đổi qua màn hình Điều chỉnh kho
        Products::saveProduct($this->payload($request), $request->file('photo'), $id);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->deleteProduct();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    /* ------------------------------------------------------------------
     | Tồn kho
     * ------------------------------------------------------------------ */

    /** Trang điều chỉnh kho + lịch sử biến động */
    public function stock($id)
    {
        $record = Products::findOrFail($id);

        if ($record->isConfigurable()) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Sản phẩm configurable không có tồn kho riêng. Hãy quản lý kho ở từng sản phẩm con.');
        }

        $movements = DB::table('stock_movements')
            ->where('product_id', $id)
            ->orderByDesc('id')
            ->paginate(30);

        return view('admin.products.stock', compact('record', 'movements'));
    }

    /** Admin cộng/trừ kho thủ công, bắt buộc có lý do */
    public function adjustStock(Request $request, $id, StockService $stock)
    {
        $request->validate([
            'delta' => 'required|integer|not_in:0',
            'note'  => 'required|string|max:500',
        ], [
            'delta.not_in' => 'Số lượng điều chỉnh phải khác 0.',
            'note.required' => 'Vui lòng nhập lý do điều chỉnh.',
        ]);

        Products::findOrFail($id);

        try {
            $after = $stock->adjust($id, (int) $request->delta, $request->note, auth()->id());
        } catch (InsufficientStockException $e) {
            return back()->withInput()->with('error', 'Không thể trừ quá số tồn hiện có (còn ' . $e->available . ').');
        } catch (InvalidArgumentException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.products.stock', $id)
            ->with('success', 'Đã cập nhật tồn kho. Tồn hiện tại: ' . $after);
    }

    /* ------------------------------------------------------------------ */

    private function rules($id = null): array
    {
        return [
            'name'        => 'required|string|max:255',
            'sku'         => ['nullable', 'string', 'max:64', Rule::unique('products', 'sku')->ignore($id)],
            'category_id' => 'required|integer',
            'price'       => 'required|integer|min:0',
            'discount'    => 'nullable|integer|min:0|max:100',
            'stock'       => 'nullable|integer|min:0',
            'photo'       => 'nullable|image|max:2048',
        ];
    }

    private function payload(Request $request): array
    {
        $data = $request->only(['name', 'category_id', 'price', 'hot', 'description', 'content']);
        $data['sku'] = $request->filled('sku') ? trim($request->input('sku')) : null; // '' sẽ vi phạm unique
        $data['discount'] = (int) $request->input('discount', 0);
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}