<?php

namespace App\Http\Controllers\Api;

use App\Components\CompanyComponent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{    
    /**
     * Instance of component
     *
     * @var CompanyComponent
     */
    private $components;
    
    /**
     * Create an instance of component
     *
     * @param  CompanyComponent $components
     * @return void
     */
    public function __construct(CompanyComponent $components)
    {
        $this->components = $components;
    }
    
    /**
     * List companies
     *
     * @return array
     */
    public function list()
    {        
        $companies = $this->components->list();

        if(!$companies['success']){
            return response()->json(array(
                'error' => $companies['error']
            ), $companies['code']);
        }

        return response()->json($companies, $companies['code']);
    }
}
