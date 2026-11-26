<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCollectionRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\MediaResource;
use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;

class UserController extends Controller
{
    // GET /api/users  -> untuk melihat ID pengguna saat testing
    public function index()
    {
        return UserResource::collection(User::all());
    }

    // POST /api/users
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    // PATCH /api/users/{user}
    public function update(StoreUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    // GET /api/users/{user}/collection
    public function collection(User $user)
    {
        return MediaResource::collection($user->media);
    }

    // POST /api/users/{user}/collection   body: { "media_id": 4 }
    public function addToCollection(AddToCollectionRequest $request, User $user)
    {
        if ($user->media()->where('media.id', $request->media_id)->exists()) {
            return response()->json(['message' => 'Media sudah ada di koleksi'], 409);
        }

        $user->media()->attach($request->media_id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi',
            'data'    => new UserResource($user->load('media')),
        ], 201);
    }

    // DELETE /api/users/{user}/collection/{media}
    public function removeFromCollection(User $user, Media $media)
    {
        if (! $user->media()->where('media.id', $media->id)->exists()) {
            return response()->json(['message' => 'Media tidak ada di koleksi pengguna ini'], 404);
        }

        $user->media()->detach($media->id);

        return response()->json(['message' => 'Media berhasil dihapus dari koleksi']);
    }
}