<?php

namespace App\Http\Controllers\Api;

use App\Components\ContactComponent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{    
    /**
     * Instance of component
     *
     * @var ContactComponent
     */
    private $components;
    
    /**
     * Create an instance of contact component
     *
     * @param  ContactComponent $components
     * @return void
     */
    public function __construct(ContactComponent $components)
    {
        $this->components = $components;
    }
    
    /**
     * List contacts with pagination
     *
     * @return array
     */
    public function list()
    {
        $contacts = $this->components->list();

        if(!$contacts['success']){
            return response()->json(array(
                'error' => $contacts['error']
            ), $contacts['code']);
        }

        return response()->json($contacts, $contacts['code']);
    }

    /**
     * Get contact by id
     *
     * @param  int $id
     * @return array
     */
    public function getById($id)
    {
        $contact = $this->components->getById($id);

        if(!$contact['success']){
            return response()->json(array(
                'error' => $contact['error']
            ), $contact['code']);
        }

        return response()->json($contact, $contact['code']);
    }

    /**
     * Get contact by name
     *
     * @param  string $name
     * @return array
     */
    public function getByName($name)
    {
        $contacts = $this->components->getByName($name);

        if(!$contacts['success']){
            return response()->json(array(
                'error' => $contacts['error']
            ), $contacts['code']);
        }

        return response()->json($contacts, $contacts['code']);
    }

    /**
     * Get contact by company id
     *
     * @param  int $companyId
     * @return array
     */
    public function getByCompanyId($companyId)
    {
        $contacts = $this->components->getByCompanyId($companyId);

        if(!$contacts['success']){
            return response()->json(array(
                'error' => $contacts['error']
            ), $contacts['code']);
        }

        return response()->json($contacts, $contacts['code']);
    }

    /**
     * Create a new contact
     *
     * @param  Request $request
     * @return array
     */
    public function create(Request $request)
    {
        $contact = $this->components->create($request->all());

        if(!$contact['success']){
            return response()->json(array(
                'error' => $contact['error']
            ), $contact['code']);
        }

        return response()->json($contact, $contact['code']);
    }

    /**
     * Create multiple contacts with the same company
     *
     * @param  Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $contact = $this->components->store($request->all());

        if(!$contact['success']){
            return response()->json(array(
                'error' => $contact['error']
            ), $contact['code']);
        }

        return response()->json($contact, $contact['code']);
    }

    /**
     * Update contact
     *
     * @param  Request $request
     * @param  int $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $contact = $this->components->update($request->all(), $id);
        
        if(!$contact['success']){
            return response()->json(array(
                'error' => $contact['error']
            ), $contact['code']);
        }

        return response()->json($contact, $contact['code']);
    }
}
