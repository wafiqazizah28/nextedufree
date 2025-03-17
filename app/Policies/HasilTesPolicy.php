<?php

namespace App\Policies;

use App\Models\HasilTes;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HasilTesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Ganti sesuai aturan akses
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HasilTes $hasilTes): bool
    {
        return $user->id === $hasilTes->user_id; // Contoh: hanya pemilik hasil tes yang bisa melihat
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Semua user bisa membuat hasil tes
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HasilTes $hasilTes): bool
    {
        return $user->id === $hasilTes->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HasilTes $hasilTes): bool
    {
        return $user->id === $hasilTes->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HasilTes $hasilTes): bool
    {
        return $user->id === $hasilTes->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HasilTes $hasilTes): bool
    {
        return $user->id === $hasilTes->user_id;
    }
}
