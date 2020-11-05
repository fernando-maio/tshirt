<?php

namespace App\Http\Controllers\Api;

use App\Components\NoteComponent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Instance of component
     *
     * @var NoteComponent
     */
    private $components;

    /**
     * Create an instance of contact component
     *
     * @param  NoteComponent $components
     * @return void
     */
    public function __construct(NoteComponent $components)
    {
        $this->components = $components;
    }

    /**
     * Create a new note
     *
     * @param  Request $request
     * @return array
     */
    public function create(Request $request)
    {
        $note = $this->components->create($request->all());

        if(!$note['success']){
            return response()->json(array(
                'error' => $note['error']
            ), $note['code']);
        }

        return response()->json($note, $note['code']);
    }
}
