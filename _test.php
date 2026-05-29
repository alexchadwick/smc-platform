<?php

/**
 * Upload for resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function upload(Request $request, $resource)
{

    //Validation rules
    $rules = array(
        'file' => 'required|file',
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

        $path = $request
            ->file('file')
            ->store('quotes/'.$resource->id.'/attachments', 's3');

        $file_name = $request->file('file')->hashName();

        $resource->save();
    }

    //Return resource model
    return new ResourceClass($resource);
}