<?php

namespace App\Policies;

use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PertanyaanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Ganti dengan logika otorisasi yang sesuai
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pertanyaan $pertanyaan): bool
    {
        return $user->id === $pertanyaan->user_id; // Contoh: hanya pemilik pertanyaan yang bisa melihat
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Ubah sesuai kebijakan aplikasi Anda
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pertanyaan $pertanyaan): bool
    {
        return $user->id === $pertanyaan->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pertanyaan $pertanyaan): bool
    {
        return $user->id === $pertanyaan->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pertanyaan $pertanyaan): bool
    {
        return $user->id === $pertanyaan->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pertanyaan $pertanyaan): bool
    {
        return $user->id === $pertanyaan->user_id;
    }
}
