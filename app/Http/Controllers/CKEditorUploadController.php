<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CKEditorUploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads'), $filename);

            return response()->json([
                'url' => asset('uploads/' . $filename)
            ]);
        }

        return response()->json(['error' => 'File not uploaded.'], 400);
    }
}
