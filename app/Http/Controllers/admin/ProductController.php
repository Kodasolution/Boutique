<?php

namespace App\Http\Controllers\admin;

use Exception;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Color;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use App\Models\OtherField;
use App\Models\ProductSize;
use App\Models\Product_size;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProductOtherField;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Classes\Services\ProductService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = new ProductService();
        $product = $service->getAllProduct();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = Category::where('parent_id', null)->get();
        $size = Size::all();
        $color = Color::all();
        $other = OtherField::all();
        return view('admin.product.create', compact('category', 'size', 'color', 'other'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|unique:products,name",
            "price" => "required",
            "quantity" => "required",
            "marque" => "required",
            "files" => "required",
            "file" => "required",
            "category_id" => "required"
        ]);
        DB::beginTransaction();
        try {
            $pro = Product::create([
                "name" => $request->name,
                "price" => $request->price,
                "quantity" => $request->quantity,
                "category_id" => $request->category_id,
                "marque" => $request->marque
            ]);
            if (array_key_exists('size', $request->all())) {
                foreach ($request->size as $size) {
                    ProductSize::create(
                        [
                            "size_id" => $size,
                            "product_id" => $pro->id
                        ]
                    );
                }
            }
            if (array_key_exists('color', $request->all())) {
                foreach ($request->color as $color) {
                    ProductColor::create(
                        [
                            "color_id" => $color,
                            "product_id" => $pro->id
                        ]
                    );
                }
            }
            // if (array_key_exists('other_field', $request->all())) {
            //     foreach ($request->other_field as $field) {
            //         foreach ($request->other_field_id as $field_id) {
            //             ProductOtherField::create(
            //                 [
            //                     "other_field_id" => $field_id,
            //                     "product_id" => $pro->id,
            //                     "value" => $field
            //                 ]
            //             );
            //         }
            //     }
            // }
            if (!is_null($request->file)) {
                $fileName = $pro->id . '_' . $request->file->getClientOriginalName();
                $type = $request->file->getClientMimeType();
                $size = $request->file->getSize();
                $request->file->move(storage_path('app/public/photo'), $fileName);
                Photo::create([
                    "url" => $fileName,
                    "product_id" => $pro->id,
                    "principal" => 1
                ]);
            }
            if (!is_null($request->files)) {
                foreach ($request['files'] as $item) {
                    $fileName = $pro->id . '_' . $item->getClientOriginalName();
                    $type = $item->getClientMimeType();
                    $size = $item->getSize();
                    $item->move(storage_path('app/public/photo'), $fileName);
                    Photo::create([
                        "url" => $fileName,
                        "product_id" => $pro->id
                    ]);
                }
            } else {
                return back()->with('error', 'photo is required');
            }
            DB::commit();
            return back()->with('success', 'product is saved successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return [
                $e->getLine(),
                $e->getFile(),
                $e->getMessage()
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = Category::where('parent_id', null)->get();
        $size = Size::all();
        $color = Color::all();
        $photo = Photo::where('product_id', $product->id)->get();
        return view('admin.product.edit', compact('product', 'category', 'size', 'color', 'photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $data = $request->validate([
            "name" =>  'required', Rule::unique('products')->ignore($product->id),
            "price" => "required",
            "quantity" => "required",
            "marque" => "required",
            // "files" => "required",
            "category_id" => "required"
        ]);
        DB::beginTransaction();
        try {
            $product->update([
                "name" => $request->name,
                "price" => $request->price,
                "quantity" => $request->quantity,
                "category_id" => $request->category_id,
                "marque" => $request->marque,
                "status" => $request->status
            ]);
            if ($product->sizes != null) {
                foreach ($product->sizes as $siz) {
                    $siz->delete();
                }
                if (array_key_exists('size', $request->all())) {
                    // if ($product->sizes != null) {
                    foreach ($request->size as $size) {
                        ProductSize::create(
                            [
                                "size_id" => $size,
                                "product_id" => $product->id
                            ]
                        );
                    }
                }
            }
            if ($product->colors != null) {
                foreach ($product->colors as $col) {
                    $col->delete();
                }
                if (array_key_exists('color', $request->all())) {
                    foreach ($request->color as $color) {
                        ProductColor::create(
                            [
                                "color_id" => $color,
                                "product_id" => $product->id
                            ]
                        );
                    }
                }
            }
            if ($request['principal']) {
                $oldPrincipale = Photo::where('product_id', $product->id)->where('principal', 1)->first();
                $oldPrincipale->update(
                    [
                        'principal' => 0
                    ]
                );
                $newPrincipale = Photo::where('product_id', $product->id)->where('id', $request->principal)->first();
                $newPrincipale->update(['principal' => 1]);
            }
            if ($request['files']) {
                // dd($request->files);
                foreach ($request['files'] as $key => $item) {
                    $fileName = $product->id . '_' . $item->getClientOriginalName();
                    $type = $item->getClientMimeType();
                    $size = $item->getSize();
                    $item->move(storage_path('app/public/photo'), $fileName);
                    $image = DB::table('photos')
                        ->where('id', $key)
                        ->where('product_id', $product->id)
                        ->update([
                            'url' => trim(htmlentities($fileName)),
                        ]);
                }
            }
            DB::commit();
            return back()->with('success', 'product updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return [
                $e->getMessage(),
                $e->getLine(),
                $e->getFile()
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (!is_null($product->colors)) {
            foreach ($product->colors as $col) {
                $col->delete();
            }
        }
        if (!is_null($product->sizes)) {
            foreach ($product->sizes as $siz) {
                $siz->delete();
            }
        }
        foreach ($product->photos as $phot) {
            $phot->delete();
        }
        $product->delete();
        return back()->with('success', 'product is deleted successfully');
    }
}
