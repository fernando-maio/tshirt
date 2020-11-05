<?php

namespace App\Components;

use App\Contracts\ValidateInterface;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ContactComponent implements ValidateInterface
{
    /**
     * Instance of Model
     *
     * @var Contact
     */
    private $contacts;

    /**
     * Helper component
     *
     * @var HelperComponent
     */
    private $helper;

    /**
     * Create an instance of Contact model and helper
     *
     * @param  Contact $contacts
     * @param  HelperComponent $helper
     * @return void
     */
    public function __construct(Contact $contacts, HelperComponent $helper)
    {
        $this->contacts = $contacts;
        $this->helper = $helper;
    }
    
    /**
     * List contacts with pagination
     *
     * @return array
     */
    public function list()
    {
        $contacts = $this->contacts->paginate(10);
        if(!count($contacts)){
            return $this->helper->errorReturn(\Lang::get('auth.empty'), 404);
        }

        return $this->helper->successReturn($contacts);
    }
    
    /**
     * Get contact by id
     *
     * @param  int $id
     * @return array
     */
    public function getById($id)
    {
        $contact = $this->contacts->find($id);
        if(empty($contact)){
            return $this->helper->errorReturn(\Lang::get('auth.empty'), 404);
        }

        return $this->helper->successReturn($contact);
    }

    /**
     * Get contact by name
     *
     * @param  string $name
     * @return array
     */
    public function getByName($name)
    {
        $contact = $this->contacts->where('name', 'like', "%$name%")->get();
        if(!count($contact)){
            return $this->helper->errorReturn(\Lang::get('auth.empty'), 404);
        }

        return $this->helper->successReturn($contact);
    }
    
    /**
     * Get contact by company id
     *
     * @param  int $companyId
     * @return array
     */
    public function getByCompanyId($companyId)
    {
        $contacts = $this->contacts->where('company_id', $companyId)->get();
        if(!count($contacts)){
            return $this->helper->errorReturn(\Lang::get('auth.empty'), 404);
        }

        return $this->helper->successReturn($contacts);
    }
    
    /**
     * Create a new contact
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
            $this->contacts->company_id = $request['company_id'];
            $this->contacts->name = $request['name'];
            $this->contacts->phone = $request['phone'];
            $this->contacts->save();
        } catch (\Throwable $th) {
            return $this->helper->errorReturn($th, 500);
        }

        return $this->helper->successReturn();
    }
    
    /**
     * Create multiple contacts with the same company
     *
     * @param  array $request
     * @return array
     */
    public function store($request)
    {
        foreach ($request['contacts'] as $contact) {
            $contact['company_id'] = $request['company_id'];
            $validator = $this->validate($contact);
            
            if($validator->fails()) {  
                return $this->helper->errorReturn($validator->errors(), 400);
            }
        }

        $contacts = array();
        foreach ($request['contacts'] as $contact) {
            $contact['company_id'] = $request['company_id'];
            $contact['created_at'] = Carbon::now()->toDateTimeString();
            $contact['updated_at'] = Carbon::now()->toDateTimeString();
            $contacts[] = $contact;
        }

        try {
            $this->contacts->insert($contacts);
        } catch (\Throwable $th) {
            return $this->helper->errorReturn($th, 500);
        }

        return $this->helper->successReturn();
    }
    
    /**
     * Update contact
     *
     * @param  array $request
     * @param  int $id
     * @return array
     */
    public function update($request, $id)
    {
        $contact = $this->contacts->find($id);
        if(empty($contact)){
            return $this->helper->errorReturn(\Lang::get('auth.notFound'), 404);
        }

        try {
            foreach ($request as $key => $value) {
                $contact->$key = $value;
            }
            $contact->update();
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
            'company_id' => 'required',
            'name' => 'required|max:100',
            'phone' => 'required|max:20'
        ));
    }
}