<?php
  
namespace App\Http\Controllers;
  
use App\Models\Product;
use Illuminate\Support\Facades\Storage;  // Penting
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * @OA\Info(
 *     title="API Gallery",
 *     version="1.0.0",
 *     description="API Gallery",
 *     @OA\Contact(
 *         email="contact@domainanda.com"
 *     )
 * )
 */
class ProductController extends Controller
{
        // Metode untuk menampilkan produk dalam API (JSON)
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get product gallery data",
     *     tags={"Gallery"},
     *     @OA\Response(
     *         response=200,
     *         description="List of products as gallery",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Product Name"),
     *                     @OA\Property(property="detail", type="string", example="Product description"),
     *                     @OA\Property(property="image", type="string", example="http://example.com/product-image.jpg")
     *                 )
     *             ),
     *             @OA\Property(property="total", type="integer", example=10)
     *         )
     *     )
     * )
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function apiIndex()
    {
        $products = Product::latest()->get(); // Ambil semua produk
        foreach ($products as $product) {
            $product->image = asset('storage/images/'.$product->image); // Membuat URL lengkap
        }
        return response()->json([
            'data' => $products
        ]);
    }
  
    public function create(): View
    {
        return view('products.create');
    }
  
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // Simpan file ke storage/app/public/images
            Storage::disk('public')->putFileAs('images', $image, $profileImage);
            $input['image'] = $profileImage;
        }
      
        Product::create($input);
       
        return redirect()->route('products.index')
                        ->with('success', 'Berhasil membuat data.');
    }
  
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }
  
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);
    
        $input = $request->all();
    
        if ($image = $request->file('image')) {
            // Hapus file lama jika ada
            if($product->image && Storage::disk('public')->exists('images/'.$product->image)) {
                Storage::disk('public')->delete('images/'.$product->image);
            }

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images', $image, $profileImage);
            $input['image'] = $profileImage;
        } else {
            unset($input['image']);
        }
            
        $product->update($input);
      
        return redirect()->route('products.index')
                        ->with('success', 'Berhasil memperbarui data');
    }
  
    public function destroy(Product $product): RedirectResponse
    {
        // Hapus file gambar saat product dihapus
        if($product->image && Storage::disk('public')->exists('images/'.$product->image)) {
            Storage::disk('public')->delete('images/'.$product->image);
        }

        $product->delete();
         
        return redirect()->route('products.index')
                        ->with('success', 'Berhasil hapus data');
    }
}