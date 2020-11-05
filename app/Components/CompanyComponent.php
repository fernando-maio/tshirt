<?php

namespace App\Components;

use App\Models\Company;

class CompanyComponent
{    
    /**
     * Instance of Model
     *
     * @var Company
     */
    private $companies;

    /**
     * Helper component
     *
     * @var HelperComponent
     */
    private $helper;
    
    /**
     * Create an instance of Company model and helper
     *
     * @param  Company $companies
     * @param  HelperComponent $helper
     * @return void
     */
    public function __construct(Company $companies, HelperComponent $helper)
    {
        $this->companies = $companies;
        $this->helper = $helper;
    }
    
    /**
     * List of objects
     *
     * @return array
     */
    public function list()
    {
        $companies = $this->companies->get();

        if(!count($companies)){
            return $this->helper->errorReturn(\Lang::get('auth.empty'), 404);
        }

        return $this->helper->successReturn($companies);
    }

}