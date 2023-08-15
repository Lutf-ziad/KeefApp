<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function successMessage($msg = '')
{
    return back()->with('message', ['type' => 'success', 'text' => $msg]);
}
function errorMessage($msg = '')
{
    return back()->with('message', ['type' => 'danger', 'text' => $msg]);
}
function handleErrors(Exception $exception, $type = 'back')
{
    $message = null;
    if ($exception instanceof QueryException) {
        if ($exception->errorInfo[1] == 1451) {
            $message = 'A record that has other related records cannot be deleted';
        } else {
            $message = $exception->getMessage();
        }
    } elseif ($exception instanceof ModelNotFoundException) {
        $message = 'Not Found Record';
    } else {
        $message = $exception->getMessage();
    }
    if ($type == 'msg') {
        return $message;
    } elseif ($type == 'back') {
        return errorMessage($message);
    }

}
function getRequest($route, $class)
{
    return request()->is($route) ? "$class" : '';
}
function getStatus($status, $labels = ['Active', 'InActive'], $nullValue = false, $class = ['success', 'danger'])
{
    if (! $nullValue) {
        if ($status == 1) {
            echo "<span class='badge badge-$class[0]'  style='width:70px;'>".__($labels[0]).'</span>';
        } elseif ($status == 0) {
            echo "<span class='badge badge-$class[1]' style='width:70px;'>".__($labels[1]).'</span>';
        }
    } else {
        if ($status == null) {
            echo "<span class='badge badge-$class[0]'  style='width:70px;'>".__($labels[0]).'</span>';
        } else {
            echo "<span class='badge badge-$class[1]' style='width:70px;'>".__($labels[1]).'</span>';
        }
    }
}

function getStorage($folder, $file, $disk = 'upload')
{
    return Storage::disk($disk)->url("$folder/$file");
}
function setStorage($folder, $file, $disk = 'upload')
{
    $name = Str::random(30).'.'.$file->extension();
    $result = Storage::disk($disk)->putFileAs($folder, $file, $name);
    if ($result) {
        return $name;
    } else {
        return null;
    }
}
function deleteStorage($file, $disk = 'upload')
{
    $path = explode('/', $file);
    if (count($path) > 2) {
        $path = $path[count($path) - 2].'/'.end($path);
    } else {
        $path = $file;
    }
    if (! str_contains($path, 'default') && ! str_contains($path, 'splash') && ! str_contains($path, 'no-image')) {
        return Storage::disk($disk)->delete($path);
    }
}
