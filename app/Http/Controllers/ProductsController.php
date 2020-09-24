<?php

namespace App\Http\Controllers;

use App\Models\ProductHasCategory;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    protected $products_repository;

    public function __construct(ProductsRepository $products_repository)
    {
        $this->products_repository = $products_repository;
    }

    public function index()
    {
        try {
            $products = $this->products_repository->getProducts();
            return view('products.index', compact('products'));
        } catch (\Exception $e) {
            return redirect()
                ->route('products.index')
                ->with('notification', [
                    'type'    => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function create()
    {
        return view('products.manage');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data      = $request->except('old_picture', 'category_ids');
            $validator = Validator::make($data, array('title' => 'required'));
            if ($validator->fails()) {
                return redirect()
                    ->route('products.create')
                    ->withInput()
                    ->with('notification', [
                        'type'    => 'danger',
                        'message' => implode('<br>', $validator->getMessageBag()->all())
                    ]);
            }

            if (!empty($request->hasFile('picture'))) {
                $destination_path = public_path('uploads/products');
                $file_name        = $request->file('picture')->getClientOriginalName();
                $request->file('picture')->move($destination_path, $file_name);
                $data['picture'] = $file_name;
            }

            $data['added_by']    = auth()->user()->id;
            $data['is_active']   = isset($data['is_active']) ? $data['is_active'] : 0;
            $data['is_featured'] = isset($data['is_featured']) ? $data['is_featured'] : 0;
            $data['identifier']  = strtolower(str_replace(' ', '-', $data['title']));

            $product = $this->products_repository->store($data);

            $category_ids = $request->get('category_ids', []);
            if (!empty($category_ids)) {
                foreach ($category_ids as $category_id) {
                    ProductHasCategory::create([
                        'product_id'  => $product->id,
                        'category_id' => $category_id
                    ]);
                }
            }

            DB::commit();
            $notification = [
                'type'    => 'success',
                'message' => 'Product has been added.'
            ];
        } catch (\Exception $e) {
            $notification = [
                'type'    => 'danger',
                'message' => $e->getMessage()
            ];
            DB::rollBack();
        }

        return redirect()
            ->route('products.index')
            ->withInput()
            ->with('notification', $notification);
    }

    public function show($id)
    {
        try {
            $product = $this->products_repository->getProductById($id);
            return view('products.show', compact('product'));
        } catch (\Exception $e) {
            return redirect()
                ->route('products.index')
                ->with('notification', [
                    'type'    => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function edit($id)
    {
        try {
            $product = $this->products_repository->getProductById($id);

            $category_ids = [];
            if (count($product->categories) > 0) {
                foreach ($product->categories as $category) {
                    $category_ids[] = $category->category_id;
                }
            }

            return view('products.manage', compact('product', 'category_ids'));
        } catch (\Exception $e) {
            return redirect()
                ->route('products.index')
                ->with('notification', [
                    'type'    => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data      = $request->except('_method', 'old_picture', 'category_ids');
            $validator = Validator::make($data, array('title' => 'required'));
            if ($validator->fails()) {
                return redirect()
                    ->route('products.edit', ['id' => $id])
                    ->withInput()
                    ->with('notification', [
                        'type'    => 'danger',
                        'message' => implode('<br>', $validator->getMessageBag()->all())
                    ]);
            }

            if (!empty($request->hasFile('picture'))) {
                $old_picture = $request->get('old_picture', '');
                if (isset($old_picture) && !empty($old_picture)) {
                    unlink(public_path('uploads/products/' . $old_picture));
                }

                $destination_path = public_path('uploads/products');
                $file_name        = $request->file('picture')->getClientOriginalName();
                $request->file('picture')->move($destination_path, $file_name);
                $data['picture'] = $file_name;
            }

            $data['is_active']   = isset($data['is_active']) ? $data['is_active'] : 0;
            $data['is_featured'] = isset($data['is_featured']) ? $data['is_featured'] : 0;
            $data['identifier']  = strtolower(str_replace(' ', '-', $data['title']));
            $this->products_repository->update($data, $id);

            ProductHasCategory::where('product_id', $id)->delete();
            $category_ids = $request->get('category_ids', []);
            if (!empty($category_ids)) {
                foreach ($category_ids as $category_id) {
                    ProductHasCategory::create([
                        'product_id'  => $id,
                        'category_id' => $category_id
                    ]);
                }
            }

            DB::commit();
            $notification = [
                'type'    => 'success',
                'message' => 'Product has been updated.'
            ];
        } catch (\Exception $e) {
            $notification = [
                'type'    => 'danger',
                'message' => $e->getMessage()
            ];
            DB::rollBack();
        }

        return redirect()
            ->route('products.index')
            ->withInput()
            ->with('notification', $notification);
    }

    public function destroy($id)
    {
        try {
            $this->products_repository->delete($id);
            $notification = [
                'type'    => 'success',
                'message' => 'Product has been removed.'
            ];
        } catch (\Exception $e) {
            $notification = [
                'type'    => 'danger',
                'message' => $e->getMessage()
            ];
        }

        return redirect()
            ->route('products.index')
            ->with('notification', $notification);
    }
}
