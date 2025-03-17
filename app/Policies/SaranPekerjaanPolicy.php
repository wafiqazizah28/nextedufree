<?php

namespace App\Policies;

use App\Models\SaranPekerjaan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SaranPekerjaanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Ganti sesuai kebijakan
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SaranPekerjaan $saranPekerjaan): bool
    {
        return $user->id === $saranPekerjaan->user_id; // Contoh: hanya pemilik yang bisa melihat
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Bisa buat aturan tambahan
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SaranPekerjaan $saranPekerjaan): bool
    {
        return $user->id === $saranPekerjaan->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SaranPekerjaan $saranPekerjaan): bool
    {
        return $user->id === $saranPekerjaan->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SaranPekerjaan $saranPekerjaan): bool
    {
        return $user->id === $saranPekerjaan->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SaranPekerjaan $saranPekerjaan): bool
    {
        return $user->id === $saranPekerjaan->user_id;
    }
}
