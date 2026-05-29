<?php

namespace Quiz\Api\Http\Controllers;

use Illuminate\Http\Request;
use Quiz\Api\Http\Resources\QuizResource as ResourceClass;
use Quiz\Api\Models\Quiz as ResourceModalClass;

class QuizController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = new ResourceModalClass();
        //$query = $query->with(['customer']);
        //Search query

        //Show deleted
        if ($request->has('is_deleted') && $request->get('is_deleted') == true) {
            //return false;
            $query = $query->onlyTrashed();
        }

        //Search, Order-by, Pagination functions
        $query = $this->defaultSearch($request, $query);
        $query = $this->defaultOrderBy($request, $query);
        $query = $this->defaultPagination($request, $query);

        return ResourceClass::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array(
            //..
        );

        // Validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);

        // If the validator fails
        if ($validator->fails()) {
            // Return validator errors
            return [
                'errors' => $validator->errors()->all()
            ];
        } else {
            // Fill model with request data
            $resource = ResourceModelClass::create($request->all());
            //Save new model to database
            $resource->save();


        }
        //Return resource model
        return new ResourceClass($resource);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $resource)
    {
        //Return resource model
        return new ResourceClass($resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $resource)
    {
        //Fill resource model with request data
        $resource->update($request->all());

        //Return resource model
        return new ResourceClass($resource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $resource)
    {
        //Delete specified resource, then return status code 204
        $resource->delete();

        //Send response model deleted
        return response()->json(null, 204);
    }

    /**
     * Restore deactivated resource model
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(Request $request, $resourceId) {

        //Get deactivated
        ResourceModelClass::withTrashed()->findOrFail($resourceId)->restore();

        //Send success response
        return response()->json([
            'success' => true
        ], 200);
    }
}