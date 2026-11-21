<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // GET /api/media?search=judul&type=anime
    public function index(Request $request)
    {
        $media = Media::query()
            ->when($request->search, fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->when($request->type, fn ($q, $t) => $q->where('type', $t))
            ->paginate(10);

        return MediaResource::collection($media);
    }

    // GET /api/media/{media}  -> detail + pengguna yang mengoleksinya
    public function show(Media $media)
    {
        return new MediaResource($media->load('users'));
    }

    // POST /api/media
    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))->response()->setStatusCode(201);
    }

    // PATCH /api/media/{media}
    public function update(StoreMediaRequest $request, Media $media)
    {
        $media->update($request->validated());

        return new MediaResource($media);
    }

    // DELETE /api/media/{media}
    public function destroy(Media $media)
    {
        $media->delete();

        return response()->json(['message' => 'Media berhasil dihapus']);
    }
}
