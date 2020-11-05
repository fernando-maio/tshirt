<?php

namespace App\Components;

use App\Contracts\ValidateInterface;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;

class NoteComponent implements ValidateInterface
{
    /**
     * Instance of Model
     *
     * @var Note
     */
    private $notes;

    /**
     * Helper component
     *
     * @var HelperComponent
     */
    private $helper;

    /**
     * Create an instance of Note model and helper
     *
     * @param  Note $notes
     * @param  HelperComponent $helper
     * @return void
     */
    public function __construct(Note $notes, HelperComponent $helper)
    {
        $this->notes = $notes;
        $this->helper = $helper;
    }

    /**
     * Create a new Note
     *
     * @param  array $request
     * @return array
     */
    public function create($request)
    {
        $validator = $this->validate($request);
        if($validator->fails()) {  
            return $this->helper->errorReturn($validator->errors(), 400);
        }

        try {
            $this->notes->contact_id = $request['contact_id'];
            $this->notes->notes = $request['notes'];
            $this->notes->save();
        } catch (\Throwable $th) {
            return $this->helper->errorReturn($th, 500);
        }

        return $this->helper->successReturn();
    }
    
    /**
     * Validate data
     *
     * @param  array $request
     * @return object
     */
    public function validate($request)
    {
        return Validator::make($request, array(
            'contact_id' => 'required',
            'notes' => 'required|max:100'
        ));
    }

}