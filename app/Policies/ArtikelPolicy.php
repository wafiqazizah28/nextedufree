<?php

namespace App\Policies;

use App\Models\Artikel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArtikelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Semua user bisa melihat daftar artikel
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Artikel $artikel): bool
    {
        return true; // Semua user bisa melihat artikel tertentu
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin; // Contoh: hanya admin yang bisa membuat artikel
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Artikel $artikel): bool
    {
        return $user->id === $artikel->user_id || $user->is_admin; // Hanya pemilik atau admin yang bisa update
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Artikel $artikel): bool
    {
        return $user->id === $artikel->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Artikel $artikel): bool
    {
        return $user->is_admin; // Hanya admin yang bisa restore artikel
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Artikel $artikel): bool
    {
        return $user->is_admin; // Hanya admin yang bisa menghapus permanen
    }
}
