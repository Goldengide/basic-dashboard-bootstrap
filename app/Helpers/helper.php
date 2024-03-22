<?php
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
function removeSession($session){
    if(\Session::has($session)){
        \Session::forget($session);
    }
    return true;
}

function getGreeting()
{
    // Get the current time
    $currentHour = date('G');

    // Determine the appropriate greeting based on the current hour
    if ($currentHour < 12) {
        return 'Good morning';
    } elseif ($currentHour < 18) {
        return 'Good afternoon';
    } else {
        return 'Good evening';
    }
}

function getFileUrl($id) {
    $file = \App\Models\Media::where('id', $id)->first();
    $url = Storage::disk($file->disk)->url($file->file_name);
    return $url;
}

function getFileUrlWithSpatie($id) {
    $file = \App\Models\Media::where('id', $id)->first();
    $url = Storage::disk($file->disk)->url($id.'/'.$file->file_name);
    return $url;
}
function generateSlug($string) {
    // Remove special characters
    $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);

    // Convert spaces to hyphens and lowercase
    $slug = strtolower(str_replace(' ', '-', $string));

    return $slug;
}

function generateUniqueSlug($model, $name)
{
        $slug = Str::slug($name);
        $count = $model::where('slug', 'like', $slug . '%')->count();

        return $count > 0 ? $slug . '-' . ($count + 1) : $slug;
}
function featuredImageInput($name, $collectionName, $label, $imageName, $value=null)
    {
        $inputvalue = old("$name", $value);
        $componentname = "media.image-view";
        $html = '<label for="' . $name . '" class="form-label">' . $label . '</label>';
        $html .= '<div><a href="#" data-bs-toggle="modal" data-bs-target="#addImageModal">';
        // $html .= '<div><a href="#" onclick="loadModalContent(\'' . $componentname . '\', ' . htmlspecialchars($parameters, ENT_QUOTES) . ')">'; 
        $html .= '<img id="' . $name . '-src" src="' . ($inputvalue ? getFileUrlWithSpatie($inputvalue) : asset('images/placeholders/' . $imageName . '.jpg')) . '" alt="' . $label . '" width="100%" height="auto">';
        $html .= '</a></div>';
        $html .= '<input type="hidden" value = "'.$inputvalue.'" class="form-control" id="' . $name . '" name="' . $name . '" data-collection="' . $collectionName . '">';

        return new HtmlString($html);
    }

function randomString($length,$type = 'token'){
    if($type == 'password')
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    elseif($type == 'username')
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    else
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $token = substr( str_shuffle( $chars ), 0, $length );
    return $token;
}

function activeRoute($route, $isClass = false): string
{
    $requestUrl = request()->fullUrl() === $route ? true : false;

    if($isClass) {
        return $requestUrl ? $isClass : '';
    } else {
        return $requestUrl ? 'active' : '';
    }
}

function checkRecordExist($table_list,$column_name,$id){
    if(count($table_list) > 0){
        foreach($table_list as $table){
            $check_data = \DB::table($table)->where($column_name,$id)->count();
            if($check_data > 0) return false ;
        }
        return true;
    }
    return true;
}

// Model file save to storage by spatie media library
function storeMediaFile($model,$file,$name)
{
    if($file) {
        $model->clearMediaCollection($name);
        if (is_array($file)){
            foreach ($file as $key => $value){
                $model->addMedia($value)->toMediaCollection($name);
            }
        }else{
            $model->addMedia($file)->toMediaCollection($name);
        }
    }
    return true;
}

// Model file get by storage by spatie media library
function getSingleMedia($model, $collection = 'image_icon',$skip=true)
{
    if (!\Auth::check() && $skip) {
        return asset('images/avatars/01.png');
    }
    if ($model !== null) {
        $media = $model->getFirstMedia($collection);
    }
    $imgurl= isset($media)?$media->getPath():'';
    if (file_exists($imgurl)) {
        return $media->getFullUrl();
    }
    else
    {
        switch ($collection) {
            case 'image_icon':
                $media = asset('images/avatars/01.png');
                break;
            case 'profile_image':
                $media = asset('images/avatars/01.png');
                break;
            default:
                $media = asset('images/common/add.png');
                break;
        }
        return $media;
    }
}

// File exist check
function getFileExistsCheck($media)
{
    $mediaCondition = false;
    if($media) {
        if($media->disk == 'public') {
            $mediaCondition = file_exists($media->getPath());
        } else {
            $mediaCondition = \Storage::disk($media->disk)->exists($media->getPath());
        }
    }
    return $mediaCondition;
}
