<?php

namespace Admin\Api\Http\Controllers;

use Illuminate\Http\Request;

class BaseApiController extends Controller
{

    public function __construct()
    {
        //parent::__construct();
        $this->defaultPaginateLimit = config('smc-admin.defaultPaginateLimit', 15);

    }

    /* Default pagination limiter */
    public $defaultPaginateLimit = null;

    /* Default pagination maximum limiter */
    public $defaultPaginateMaxLimit = 500;



    /**
     * Default pagination query
     * @param Request $request
     * @param $query
     * @return mixed
     */
    public function defaultPagination2(Request $request, $query){
        //Pagination
        if($request->has('paginate') &&

            ($request->get('paginate') == 'false' || $request->get('paginate') == '0')){
            //..
            $query = $query->get();
        } else {
            //..
            $query = $query->paginate(
                (
                    $request->has('limit') &&
                    ((
                        (int) $request->get('limit') <= $this->defaultPaginateMaxLimit
                    ) ? (int) $request->get('limit') : $this->defaultPaginateLimit)
                )
            );
        }
        return $query;
    }

    public function defaultPagination(Request $request, $query){
        //Pagination
        if($request->has('paginate') && ($request->get('paginate') == 'false' || $request->get('paginate') == '0')){
            //Pagination disabled..
            $query = $query->get();
        } else {
            $limit = (int) ($request->has('limit') ? ($request->get('limit') <= $this->defaultPaginateMaxLimit ? $request->get('limit') : $this->defaultPaginateMaxLimit) : $this->defaultPaginateLimit);
            $query = $query->paginate($limit);
        }
        return $query;
    }

    /**
     * default order by query
     * @param Request $request
     * @param $query
     * @return mixed
     */
    public function defaultOrderBy(Request $request, $query){
        return $query
            //Order by
            ->orderBy($request->has('order_by') ? $request->get('order_by') : 'created_at',
                $request->has('order') && strtolower($request->get('order')) === 'asc'  ? 'asc' : 'desc');
    }

    /**
     * default search query
     * @param Request $request
     * @param $query
     * @return mixed
     */
    public function defaultSearch(Request $request, $query){
        //Search query
        return $query->where(function ($query) use ($request) {
            if($request->has('search') && $request->get('search')) {
                $query->search($request->get('search'));
            }
        });
    }

    /**
     * Return api errors response with 422 HTTP status code
     * @param Validator $validator
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function returnApiErrors(Validator $validator){
        return response(array(
            'errors' => $validator->errors()->all()
        ))->setStatusCode(422, 'Invalid input');
    }

}