<?php

namespace Admin\Api\Http\Controllers;

use Illuminate\Http\Request;
use Admin\Api\Http\Resources\UserResource as ResourceClass;
use Admin\Api\Models\User as ResourceModalClass;

class UserController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = new ResourceModalClass();
        //$query = $query->with(['customer']);
        //Search query

        //Show deleted
        if ($request->has('is_deleted') && $request->get('is_deleted') == true) {
            $query = $query->onlyTrashed();
        }

        //Search, Order-by, Pagination functions
        $query = $this->defaultSearch($request, $query);
        $query = $this->defaultOrderBy($request, $query);
        $query = $this->defaultPagination($request, $query);

        return ResourceClass::collection($query);
    }

    public function create(Request $request){
        return view('smc-admin.pages.forms.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return array|ResourceClass
     */
    public function store(Request $request)
    {

        $rules = array(
            //..
            'name' => ['required'],
            'email' => ['required','email','unique:users'],
            'password' => 'required|min:6|confirmed'
        );

        // Validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);

        // If the validator fails
        if ($validator->fails()) {
            // Return validator errors
            return response()->json(['errors' => $validator->errors()->all()], 422);
            //return ['errors' => $validator->errors()->all()];
        } else {
            // Fill model with request data
            $resource = ResourceModalClass::create($request->all());
            $resource->password = bcrypt($request->get('password'));
            //Save new model to database
            $resource->save();

        }
        //Return resource model
        return new ResourceClass($resource);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @param ResourceModalClass $resource
     * @return ResourceClass
     */
    public function show(Request $request, ResourceModalClass $resource)
    {
        if(!isset($resource->id))
            abort(500, 'invalid');
        //Return resource model
        return new ResourceClass($resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ResourceModalClass $resource
     * @return ResourceClass
     */
    public function update(Request $request, ResourceModalClass $resource)
    {
        //Fill resource model with request data
        $resource->update($request->all());

        //Return resource model
        return new ResourceClass($resource);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param ResourceModalClass $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, ResourceModalClass $resource)
    {
        //Delete specified resource, then return status code 204
        $resource->delete();

        //Send response model deleted
        return response()->json(null, 204);
    }

    /**
     * Restore deactivated resource model
     * @param Request $request
     * @param ResourceModalClass $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore2(Request $request, ResourceModalClass $resource) {

        //Get deactivated
        $resource->restore();

        //Send success response
        return response()->json([
            'success' => true
        ], 200);
    }
    public function restore(Request $request, $resourceId) {

        //Get deactivated
        ResourceModalClass::withTrashed()->findOrFail($resourceId)->restore();

        //Send success response
        return response()->json([
            'success' => true
        ], 200);
    }
}