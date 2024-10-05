<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\Rule;

class ProductController extends Controller {
	use ApiResponse;
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		Gate::authorize( 'viewAny', Product::class);
		$products = QueryBuilder::for( Product::class)
			->allowedIncludes( [ 'category', 'producer', 'creditor' ] )
			->defaultSort( '-created_at' )
			->allowedSorts( 'name', 'price', 'created_at', 'quantity', 'tax' )
			->allowedFilters( [ 'category_id', 'producer_id', 'creditor_id', 'name', 'in_stock' ] )
			->paginate( request()->get( 'limit' ) ?? 10 );

		return $this->success(
			ProductResource::collection( $products ),
			pagination: true,
		);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store( Request $request ) {
		Gate::authorize( 'create', Product::class);
		$validated = $request->validate( [ 
			'category_id' => 'required|exists:categories,id',
			'producer_id' => 'required|exists:producers,id',
			'creditor_id' => 'required|exists:creditors,id',
			'name' => 'required|unique:products,name|min:3|max:255',
			'price' => 'required|numeric',
			'standard' => 'required|max:255',
			'in_stock' => 'required|boolean',
			'quantity' => 'required|numeric',
			'tax' => 'required|numeric',
		] );
		$product = Product::create( $validated );
		return $this->success( new ProductResource( $product ) );//
	}

	/**
	 * Display the specified resource.
	 */
	public function show( int $id ) {
		$product = QueryBuilder::for( Product::class)
			->allowedIncludes( [ 'category', 'producer', 'creditor' ] )
			->where( 'id', $id )
			->first();
		if ( ! $product ) {
			throw new NotFoundHttpException();
		}
		Gate::authorize( 'view', $product );
		return $this->success( new ProductResource( $product ) );//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update( Request $request, Product $product ) {
		Gate::authorize( 'update', Product::class);
		$validated = $request->validate( [ 
			'category_id' => 'sometimes|exists:categories,id',
			'producer_id' => 'sometimes|exists:producers,id',
			'creditor_id' => 'sometimes|exists:creditors,id',
			'name' => [ 
				'sometimes',
				Rule::unique( 'products', 'name' )->ignore( $product->id ),
				'min:3',
				'max:255'
			],
			'price' => 'sometimes|numeric',
			'standard' => 'sometimes|max:255',
			'in_stock' => 'sometimes|boolean',
			'quantity' => 'sometimes|numeric',
			'tax' => 'sometimes|numeric',
		] );
		$product = Product::create( $validated );
		return $this->success( new ProductResource( $product ) );//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy( Product $product ) {
		Gate::authorize( 'delete', $product );
		$product->delete();
		return $this->success( [], message: 'تم حذف المنتج بنجاح' );
	}
}
