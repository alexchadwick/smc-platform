<?php

namespace Training\Api\Http\Controllers;

use Illuminate\Http\Request;
use Training\Api\Http\Resources\CourseEnrollmentResource as ResourceClass;

class UserCourseEnrollmentController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @param ResourceParentModalClass $parent
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = $request->user()->course_enrollments()->with(['course']);
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


}