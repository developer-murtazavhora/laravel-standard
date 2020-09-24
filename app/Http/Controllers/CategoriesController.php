<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    protected $categories_repository;

    public function __construct(CategoriesRepository $categories_repository)
    {
        $this->categories_repository = $categories_repository;
    }

    public function index()
    {
        try {
            $categories = $this->categories_repository->getCategories();
            return view('categories.index', compact('categories'));
        } catch (\Exception $e) {
            return redirect()
                ->route('categories.index')
                ->with('notification', [
                    'type'    => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function create()
    {
        return view('categories.manage');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data      = $request->all();
            $validator = Validator::make($data, array('title' => 'required'));
            if ($validator->fails()) {
                return redirect()
                    ->route('categories.create')
                    ->withInput()
                    ->with('notification', [
                        'type'    => 'danger',
                        'message' => implode('<br>', $validator->getMessageBag()->all())
                    ]);
            }

            $data['added_by']   = auth()->user()->id;
            $data['is_active']  = isset($data['is_active']) ? $data['is_active'] : 0;
            $data['identifier'] = strtolower(str_replace(' ', '-', $data['title']));

            $this->categories_repository->store($data);

            DB::commit();
            $notification = [
                'type'    => 'success',
                'message' => 'Category has been added.'
            ];
        } catch (\Exception $e) {
            $notification = [
                'type'    => 'danger',
                'message' => $e->getMessage()
            ];
            DB::rollBack();
        }

        return redirect()
            ->route('categories.index')
            ->withInput()
            ->with('notification', $notification);
    }

    public function show($id)
    {
        try {
            $category = $this->categories_repository->getCategoryById($id);
            return view('categories.show', compact('category'));
        } catch (\Exception $e) {
            return redirect()
                ->route('categories.index')
                ->with('notification', [
                    'type'    => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function edit($id)
    {
        try {
            $category = $this->categories_repository->getCategoryById($id);
            return view('categories.manage', compact('category'));
        } catch (\Exception $e) {
            return redirect()
                ->route('categories.index')
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
            $data      = $request->except('_method');
            $validator = Validator::make($data, array('title' => 'required'));
            if ($validator->fails()) {
                return redirect()
                    ->route('categories.edit', ['id' => $id])
                    ->withInput()
                    ->with('notification', [
                        'type'    => 'danger',
                        'message' => implode('<br>', $validator->getMessageBag()->all())
                    ]);
            }

            $data['is_active']  = isset($data['is_active']) ? $data['is_active'] : 0;
            $data['identifier'] = strtolower(str_replace(' ', '-', $data['title']));
            $this->categories_repository->update($data, $id);

            DB::commit();
            $notification = [
                'type'    => 'success',
                'message' => 'Category has been updated.'
            ];
        } catch (\Exception $e) {
            $notification = [
                'type'    => 'danger',
                'message' => $e->getMessage()
            ];
            DB::rollBack();
        }

        return redirect()
            ->route('categories.index')
            ->withInput()
            ->with('notification', $notification);
    }

    public function destroy($id)
    {
        try {
            $this->categories_repository->delete($id);
            $notification = [
                'type'    => 'success',
                'message' => 'Category has been removed.'
            ];
        } catch (\Exception $e) {
            $notification = [
                'type'    => 'danger',
                'message' => $e->getMessage()
            ];
        }

        return redirect()
            ->route('categories.index')
            ->with('notification', $notification);
    }
}
