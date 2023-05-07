<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function index(): View
    {
        return view('downloads', [
            'contracts' => [
                ['id' => 1, 'name' => 'Contract 1', 'url' => route('generate-secure-url', 1),],
                ['id' => 2, 'name' => 'Contract 2', 'url' => route('generate-secure-url', 2),],
                ['id' => 3, 'name' => 'Contract 3', 'url' => route('generate-secure-url', 3),],
            ],
        ]);
    }

    public function generateSecureUrl(int $id): JsonResponse
    {
        abort_if(!request()->ajax(), 401);

        $disk = Storage::disk('contracts');

        $fileName = sprintf('%d.jpg', $id);

        if (!$disk->exists($fileName)) {
            return response()->json(null, 404);
        }

        $disk->buildTemporaryUrlsUsing(function (string $path, Carbon $expiration, array $options) {
            return URL::temporarySignedRoute(
                name: 'download-contract',
                expiration: $expiration,
                parameters: $options,
            );
        });

        $url = $disk->temporaryUrl(
            path: $fileName,
            expiration: now()->addMinute(),
            options: ['contract-filename' => $fileName],
        );

        return response()->json([
            'download_link' => $url,
        ]);
    }

    public function download(): StreamedResponse
    {
        abort_if(!request()->hasValidSignature(), 401);

        $disk = Storage::disk('contracts');

        $fileName = request()->query(key: 'contract-filename');

        abort_if(!$disk->exists($fileName), 404);

        return $disk->download(
            path: $fileName,
            name: $fileName,
            headers: [
                'Content-Type' => $disk->mimeType($fileName),
            ],
        );
    }
}
