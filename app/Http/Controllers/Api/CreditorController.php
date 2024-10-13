<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CreditorResource;
use App\Models\Creditor;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreditorController extends Controller {
	use ApiResponse;
	/**
	 * Display a listing of the resource.
	 * allowed includes >> items
	 * defaultSort -money_balance
	 * allowedSorts money_balance , gold_balance
	 * allowedFilters name,phone,address
	 */
	public function index() {
		Gate::authorize( 'viewAny', Creditor::class);
		$creditorQuery = QueryBuilder::for( Creditor::class)
			->allowedIncludes( [ 'items' ] )
			->defaultSort( '-money_balance' )
			->allowedSorts( 'money_balance', 'gold_balance' )
			->allowedFilters( [ 'name', 'phone', 'address' ] );


		$creditors = $creditorQuery->paginate( request()->get( 'limit' ) ?? 10 );

		return $this->success(
			CreditorResource::collection( $creditors ),
			pagination: true,
		);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store( Request $request ) {
		Gate::authorize( 'create', Creditor::class);
		$validated = $request->validate( [ 
			'name' => 'required|unique:creditors,name',
			'phone' => 'required|unique:creditors,phone',
			'address' => 'sometimes|min:3|max:255',
			'money_balance' => 'required|numeric',
			'gold_balance' => 'required|numeric',
		] );
		$creditor = Creditor::create( $validated );
		return $this->success( new CreditorResource( $creditor ) );//
	}

	/**
	 * Display the specified resource.
	 */
	public function show( int $id ) {
		$creditor = QueryBuilder::for( Creditor::class)
			->allowedIncludes( [ 'items' ] )
			->where( 'id', $id )
			->first();
		if ( ! $creditor ) {
			throw new NotFoundHttpException();
		}
		Gate::authorize( 'view', $creditor );
		return $this->success(
			new CreditorResource( $creditor ),
		);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update( Request $request, Creditor $creditor ) {
		Gate::authorize( 'update', $creditor );
		$validated = $request->validate( [ 
			'name' => [ 
				'sometimes',
				Rule::unique( 'creditors', 'name' )->ignore( $creditor->id ),
				'min:3',
				'max:255'
			],
			'phone' => [ 
				'sometimes',
				Rule::unique( 'creditors', 'phone' )->ignore( $creditor->id ),
				'min:3',
				'max:255'
			],
			'address' => 'sometimes|min:3|max:255',
			'money_balance' => 'sometimes|numeric',
			'gold_balance' => 'sometimes|numeric',
		] );
		$creditor->update( $validated );
		return $this->success( new CreditorResource( $creditor ) );//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy( Creditor $creditor ) {
		Gate::authorize( 'delete', $creditor );
		$creditor->delete();
		return $this->success( [], message: 'تم حذف الدائن بنجاح' );
	}
}
