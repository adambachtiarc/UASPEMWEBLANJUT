<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Throwable;

class Helper
{

    public static function saveFiles($files, $argPath, $argName)
    {
        try {
            if (!$files || empty($files)) return null;

            $storedFiles = null;
            $path = "public/data/" . $argPath;
            $name = $argName ?: uniqid() . date("-YmdHis");
            Storage::makeDirectory($path);

            foreach ($files as $key => $val) {
                $filename = $name . "-" . uniqid()  . "." . $val->getClientOriginalExtension();

                Storage::putFileAs($path, $val, $filename);
                $storedFiles[] = [
                    "path" => $path,
                    "name" => $filename,
                    "mime" => $val->getClientMimeType(),
                    "original_name" => $val->getClientOriginalName(),
                ];
            }
            return $storedFiles;
        } catch (Throwable $t) {
            $message = "Error on Helper::saveFiles() | " . $t->getMessage();
            Log::error($message, [
                "message" => $message,
                "files" => $files,
                "argPath" => $argPath,
                "argName" => $argName,
                "trace" => $t->getTraceAsString()
            ]);
            return [];
        }
    }


    public static function flashMessage($title = "", $message = "", $icon = "info", $key = "")
    {
        Session::flash("alert-title$key", $title);
        Session::flash("alert-message$key", $message);
        Session::flash("alert-icon$key", $icon);
    }


    public static function sendResponse($param)
    {
        return response()->json($param);
    }


    public static function jsonMessage($title = "", $message = "", $icon = "info")
    {
        return response()->json([
            "title" => $title,
            "message" => $message,
            "icon" => $icon,
        ]);
    }

    public static function getSymlinkPath($file, $index = 0, $type = "html")
    {
        $validPath = asset("assets/images/default-image.jpg");

        if (!$file && $type == "html") return $validPath;
        if (!$file && $type == "excel") return "";

        if (is_array($file) && !empty($file) && $index !== null) {
            $validPath = url(str_replace("public/", "storage/", $file[$index]["path"] . "/" . $file[$index]["name"]));
        } else if ($index === null) {
            $validPath = url(str_replace("public/", "storage/", $file["path"] . "/" . $file["name"]));
        } else {
            $validPath = url(str_replace("public/", "storage/", $file));
        }
        return $validPath;
    }

    public static function isImage($filename)
    {
        $types = ["jpg", "jpeg", "png"];
        $temp = explode(".", $filename);
        $extension = strtolower(end($temp));
        return in_array($extension, $types);
    }

    public static function getFilePreview($fileUrl, $title, $anchorAttr = "class='file-item'", $imageAttr = "style='height:10em;margin-bottom:3rem;'", $nonImageAttr = "style='margin-bottom:1rem;'")
    {
        if (Helper::isImage($fileUrl)) {
            $hint = "<a href='$fileUrl' $anchorAttr data-lightbox='image-display' data-title='$title' title='$title'><img src='$fileUrl' $imageAttr alt='$title' /></a>";
        } else {
            $hint = "<a href='$fileUrl' $anchorAttr target='document' rel='noreferrer'title='$title'><i class='fa fa-file fa-3x text-danger' $nonImageAttr></i></a>";
        }

        return $hint;
    }

    public static function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}