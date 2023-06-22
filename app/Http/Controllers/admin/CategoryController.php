<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Classes\Services\CategoryService;

class CategoryController extends Controller
{
    public function index()
    {
        $service = new CategoryService();
        $category = $service->getAllCategory();
        
        return view('admin.category.index', compact('category'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                // "ip" => "required|ip|unique:client_ips,ip,NULL,id,client_id," . $client->id,

                "name" => 'required|unique:categories,name,NULL,id,parent_id,'.$request->parent_id,
                "parent_id" => 'nullable|integer'
            ]
        );
        $value = [];
        $value['name'] = $request->name;
        $value['parent_id'] = $request->parent_id;
        $service = new CategoryService();
        $result = $service->createCategory($value);
        return back()->with('success', $result);
    }

    public function update(Request $request, $category)
    {
        $cat = Category::findOrFail($category);
        $data = $request->validate([
            "name" => 'required', Rule::unique('categories')->ignore($cat->id),
            "parent_id" => 'nullable|integer',
            "status" => 'nullable|string'

        ]);
        DB::beginTransaction();
        try {
            $cat->update([
                "name" => $request->name,
                "parent_id" => $request->parent_id,
                "status" => $request->status
            ]);
            DB::commit();
            return back()->with('success', 'Category updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            dd([
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ]);
        }
    }
    public function delete(Category $category)
    {
        DB::beginTransaction();
        try {
            if (!is_null($category->categories)) {
                foreach ($category->categories as $chrl) {
                    $chrl->delete();
                }
            }
            $category->delete();
            DB::commit();
            return back()->with('success', 'Category deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            dd([
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ]);
        }
    }
}
