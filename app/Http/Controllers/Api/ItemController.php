<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemController extends Controller {
	use ApiResponse;

	public function index() {
		Gate::authorize( 'viewAny', Item::class);
		$itemQuery = QueryBuilder::for( Item::class)
			->allowedIncludes( [ 'product', 'creditor', 'shop' ] )
			->defaultSort( '-created_at' )
			->allowedSorts( 'code', 'sold', 'created_at' )
			->allowedFilters( [ 'code', 'sold' ] );
		if ( request( 'productId' ) ) {
			$itemQuery->where( 'product_id', request( 'productId' ) );
		}
		if ( request( 'creditorId' ) ) {
			$itemQuery->where( 'creditor_id', request( 'creditorId' ) );
		}
		if ( request( 'shopId' ) ) {
			$itemQuery->where( 'shop_id', request( 'shopId' ) );
		}

		$items = $itemQuery->paginate( request()->get( 'limit' ) ?? 10 );

		return $this->success(
			ItemResource::collection( $items ),
			pagination: true,
		);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store( Request $request ) {
		Gate::authorize( 'create', Item::class);
		$validated = $request->validate( [ 
			'product_id' => 'required|exists:products,id',
			'creditor_id' => 'required|exists:creditors,id',
			'shop_id' => 'required|exists:shops,id',
			'code' => 'required|unique:items,code|min:3|max:255',
			'sold' => 'required|boolean',
		] );
		$item = Item::create( $validated );
		return $this->success( new ItemResource( $item ) );//
	}

	/**
	 * Display the specified resource.
	 */
	public function show( int $id ) {
		$item = QueryBuilder::for( Item::class)
			->allowedIncludes( [ 'product', 'shop', 'creditor' ] )
			->where( 'id', $id )
			->first();
		if ( ! $item ) {
			throw new NotFoundHttpException();
		}
		Gate::authorize( 'view', $item );
		return $this->success(
			new ItemResource( $item ),
		);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update( Request $request, Item $item ) {
		Gate::authorize( 'update', $item );
		$validated = $request->validate( [ 
			'product_id' => 'sometimes|exists:products,id',
			'creditor_id' => 'sometimes|exists:creditors,id',
			'shop_id' => 'sometimes|exists:shops,id',
			'code' => [ 
				'sometimes',
				Rule::unique( 'items', 'code' )->ignore( $item->id ),
				'min:3',
				'max:255'
			],
			'sold' => 'sometimes|boolean',
		] );
		$item->update( $validated );
		return $this->success( new ItemResource( $item ) );//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy( Item $item ) {
		Gate::authorize( 'delete', $item );
		$item->delete();
		return $this->success( [], message: 'تم حذف القطعة بنجاح' );
	}
}
