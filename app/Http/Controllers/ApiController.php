<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flavor;

class ApiController extends Controller
{
    public function listFlavors(Request $request)
    {
        // 從數據庫中獲取所有 Flavor 模型實例，僅選擇 id, name 和 description 字段
        $flavors = Flavor::all(['id', 'name', 'description']);

        // 將 description 為 null 的字段替換為空字符串
        $flavors = $flavors->map(function($flavor) {
            $flavor->description = $flavor->description ?? '';
            return $flavor;
        });

        // 返回 flavors 數據的 JSON 響應
        return response()->json([
            'flavors' => $flavors,
        ]);
    }

    public function createFlavor(Request $request)
    {
        // 驗證請求數據
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // 創建新的 Flavor 實例
        $flavor = Flavor::create($validatedData);

        // 返回成功響應和創建的數據
        return response()->json([
            'message' => 'Flavor created successfully.',
            'flavor' => $flavor,
        ]);
    }
    public function deleteFlavor(Request $request)
    {
        $id = $request->input('id');
        $flavor = Flavor::findOrFail($id);
        $flavor->delete();

        return response()->json([
            'message' => 'Flavor deleted successfully.'
        ]);
    }
}