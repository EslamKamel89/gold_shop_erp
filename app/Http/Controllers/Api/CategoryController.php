<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller {
	use ApiResponse;
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		Gate::authorize( 'viewAny', Category::class);
		return $this->success(
			CategoryResource::collection( Category::paginate( request()->get( 'limit' ) ?? 10 ) ),
			pagination: true,
		);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store( Request $request ) {
		Gate::authorize( 'create', Category::class);
		$validated = $request->validate( [ 
			'name' => 'required|unique:shops,name|min:3|max:255'
		] );
		$shop = Category::create( $validated );
		return $this->success( new CategoryResource( $shop ) );
	}

	/**
	 * Display the specified resource.
	 */
	public function show( int $id ) {
		$category = QueryBuilder::for( Category::class)
			->allowedIncludes( [ 'products' ] )
			->where( 'id', $id )
			->first();
		Gate::authorize( 'view', $category );
		return $this->success( new CategoryResource( $category ) );
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update( Request $request, Category $category ) {
		Gate::authorize( 'update', $category );
		$validated = $request->validate( [ 
			'name' => [ 'required', Rule::unique( 'shops', 'name' )->ignore( $category->id, 'id' ), 'min:3', 'max:255' ]
		] );
		$category->update( $validated );
		return $this->success( new CategoryResource( $category ) );
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy( Category $category ) {
		Gate::authorize( 'delete', $category );
		$category->delete();
		return $this->success( [], message: 'category deleted successfully' );
	}
}
