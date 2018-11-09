<?php
/**
 * Created by PhpStorm.
 * User: elf
 * Date: 08.11.2018
 * Time: 19:00
 */

namespace App\Http\Controllers;
use App\Models\ImageAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImageAttachmentController
{
    public  function upload(Request $request){
        if(!$request->hasFile('avatar')) return response()->json(['status' => 0, 'msg' => 'Загрузите файл']);

        $rules = [
            'avatar' => 'image|dimensions:max_width=2048,max_height=2048|max:4096'
        ];
        $messages = [
            'avatar.image'      => 'Загрузите картинку',
            'avatar.dimensions' => 'Аватар не должен превышать в размерах 2048x2048',
            'avatar.max'        => 'Превышен максимальный размер файла'
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        if($validation->fails()){
            return response()->json(['status' => 0, 'msg' => $validation->errors()->all()[0]]);
        }

        try{
            $file = $request->file('avatar');
            if(!$file->isValid()) return response()->json(['status' => 0, 'msg' => 'Ошибка при сохранении файла']);

            $fileName = ImageAttachment::generateFileName($file->getClientOriginalExtension());
            $filePath = ImageAttachment::generateFileFolder($fileName);
            $file->move($filePath, $fileName);
           // ImageOptimizer::optimize($filePath.$fileName);
            $data = [
                'original_name' => $file->getClientOriginalName(),
                'code'          => $fileName,
                'type'          => ImageAttachment::TYPE_USER_AVATAR
            ];
            $newImage = ImageAttachment::create($data);
            $user = Auth::user();
            $user->avatar()->associate($newImage->id);
            $user->save();


            return response()->json(['status' => 1, 'avatar' => $user->profile_avatar_url]);

        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status' => 0, 'msg' => 'Ошибка при сохранении файла']);
        }
    }


}
