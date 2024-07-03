<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flavor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FlavorController extends Controller
{
    public function index()
    {
        $flavors = Flavor::all();
        return view('flavors.index', compact('flavors'));
    }

    public function create()
    {
        return view('flavors.create');
    }

    public function store(Request $request)
    {
        // 设置 PHP 配置以允许更大的文件上传
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        ini_set('memory_limit', '128M');

        // 验证上传的图片和其他字段
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB
        ]);

        try {
            // 获取上传的文件
            $imagePath = '';
            if ($request->hasFile('image')) {
                Log::info('Image file received'); // 记录日志
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                // 将图片保存到存储文件夹
                $imagePath = $image->storeAs('images', $imageName, 'public');
                Log::info('Image stored at: ' . $imagePath); // 记录日志
            } else {
                Log::info('No image file received'); // 记录日志
            }

            // 保存图片路径和其他字段到数据库
            Flavor::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'image_path' => $imagePath,
            ]);

            return redirect()->route('flavors.index')->with('success', 'Flavor added successfully');
        } catch (\Exception $e) {
            Log::error('Error storing flavor: ' . $e->getMessage());
            return back()->with('error', 'Failed to add flavor. Please try again.');
        }
    }

    public function showUploadImageForm($id)
    {
        $flavor = Flavor::findOrFail($id);
        return view('flavors.upload_image', compact('flavor'));
    }

    public function uploadImage(Request $request, $id)
    {
        // 设置 PHP 配置以允许更大的文件上传
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        ini_set('memory_limit', '128M');

        // 验证上传的图片
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB
        ]);

        try {
            // 查找ID对应的Flavor，如果找不到则返回404
            $flavor = Flavor::findOrFail($id);

            // 获取上传的文件
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            // 将图片保存到存储文件夹
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // 保存图片路径到数据库
            $flavor->image_path = $imagePath;
            $flavor->save();

            return redirect()->route('flavors.index')->with('success', 'Image uploaded successfully');
        } catch (\Exception $e) {
            Log::error('Error uploading image for flavor: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload image. Please try again.');
        }
    }

    public function destroy($id)
    {
        $flavor = Flavor::findOrFail($id);
        $flavor->delete();

        return redirect()->route('flavors.index')->with('success', 'Flavor deleted successfully');
    }

    public function editImageForm($id)
    {
        $flavor = Flavor::findOrFail($id);
        return view('flavors.edit_image', compact('flavor'));
    }

    public function updateImage(Request $request, $id)
    {
        // 验证上传的图片
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB
        ]);

        try {
            // 查找ID对应的Flavor
            $flavor = Flavor::findOrFail($id);

            // 删除旧的图片文件
            if ($flavor->image_path) {
                Storage::disk('public')->delete($flavor->image_path);
            }

            // 获取上传的文件
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            // 将图片保存到存储文件夹
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // 更新图片路径到数据库
            $flavor->image_path = $imagePath;
            $flavor->save();

            return redirect()->route('flavors.index')->with('success', 'Image updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating image for flavor: ' . $e->getMessage());
            return back()->with('error', 'Failed to update image. Please try again.');
        }
    }

}