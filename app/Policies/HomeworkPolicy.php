<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Homework;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HomeworkPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === Role::Admin) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            Role::Teacher,
            Role::Student,
            Role::Manager,
        ]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Homework $homework): bool
    {
        $role = $user->role;

        if ($role === Role::Guest) {
            return false;
        }

        if ($role === Role::Manager || $role === Role::Teacher || $role === Role::Student) {
            return $user->school_id === $homework->school_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [Role::Teacher, Role::Manager]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Homework $homework): bool
    {
        if ($user->role === Role::Manager) {
            return $homework->school_id == $user->school_id;
        }

        if ($user->role === Role::Teacher) {
            $homeworkLessonId = $homework->user->lesson_id;
            $currentLessonId = $user->lesson_id;

            return $homework->school_id == $user->school_id && $homeworkLessonId == $currentLessonId;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Homework $homework): bool
    {
        if ($user->role === Role::Manager) {
            return $homework->school_id == $user->school_id;
        }

        if ($user->role === Role::Teacher) {
            return $homework->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Homework $homework): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Homework $homework): bool
    {
        return false;
    }
}
