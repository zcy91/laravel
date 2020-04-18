<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function formPage()
    {
        return view('request.formPage');
    }

    public function fileUpload(Request $request)
    {
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            if (!$picture->isValid()) {
                abort(400, '无效的上传文件');
            }
            // 文件扩展名
            $extension = $picture->getClientOriginalExtension();
            // 文件名
            $fileName = $picture->getClientOriginalName();
            // 生成新的统一格式的文件名
            $newFileName = md5($fileName . time() . mt_rand(1, 10000)) . '.' . $extension;
            // 图片保存路径
            $savePath = 'images/' . $newFileName;
            // Web 访问路径
            $webPath = './storage/' . $savePath;

            // 将文件保存到本地 storage/app/public/images 目录下，先判断同名文件是否已经存在，如果存在直接返回
            if (Storage::disk('public')->has($savePath)) {
                return response()->json(['path' => $webPath]);
            }
            // 否则执行保存操作，保存成功将访问路径返回给调用方
            if ($picture->storePubliclyAs('images', $newFileName, ['disk' => 'public'])) {
                return response()->json(['path' => $webPath]);
            }
            abort(500, '文件上传失败');
        } else {
            abort(400, '请选择要上传的文件');
        }
    }

    public function index(){
        return view('request.form');
    }

    public function form(Request $request)
    {

        $this->validate($request, [
            'title' => 'bail|required|string|between:2,32',
            'url' => 'sometimes|url|max:200',
        ], [
            'title.required' => '标题字段不能为空',
            'title.string' => '标题字段仅支持字符串',
            'title.between' => '标题长度必须介于2-32之间',
            'url.url' => 'URL格式不正确，请输入有效的URL',
            'url.max' => 'URL长度不能超过200',
        ]);

        return response('表单验证通过');
    }
}
