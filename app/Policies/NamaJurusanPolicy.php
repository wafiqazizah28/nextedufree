<?php

namespace App\Policies;

use App\Models\NamaJurusan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NamaJurusanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Semua user bisa melihat daftar jurusan
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NamaJurusan $namaJurusan): bool
    {
        return true; // Semua user bisa melihat detail jurusan
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin; // Contoh: hanya admin yang bisa menambah jurusan
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NamaJurusan $namaJurusan): bool
    {
        return $user->is_admin; // Hanya admin yang bisa mengedit jurusan
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NamaJurusan $namaJurusan): bool
    {
        return $user->is_admin; // Hanya admin yang bisa menghapus jurusan
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, NamaJurusan $namaJurusan): bool
    {
        return $user->is_admin; // Hanya admin yang bisa mengembalikan jurusan yang terhapus
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, NamaJurusan $namaJurusan): bool
    {
        return $user->is_admin; // Hanya admin yang bisa menghapus jurusan secara permanen
    }
}
