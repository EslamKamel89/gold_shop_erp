<?php

namespace App\Policies;

use App\Models\Producer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProducerPolicy {
	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny( User $user ): bool {
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view( User $user, Producer $producer ): bool {
		//
		return true;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create( User $user ): bool {
		//
		return true;
		return auth()->user()->isAdmin();
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update( User $user, Producer $producer ): bool {
		//
		return true;
		return auth()->user()->isAdmin();
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete( User $user, Producer $producer ): bool {
		//
		return true;
		return auth()->user()->isAdmin();
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore( User $user, Producer $producer ): bool {
		//
		return true;
		return auth()->user()->isAdmin();
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete( User $user, Producer $producer ): bool {
		//
		return true;
		return auth()->user()->isAdmin();
	}
}
