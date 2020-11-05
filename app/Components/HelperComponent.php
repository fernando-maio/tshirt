<?php

namespace App\Components;

class HelperComponent
{    
    /**
     * Handle success retuns
     *
     * @param  object $data
     * @return array
     */
    public function successReturn($data = false)
    {
        if($data){
            return array(
                'success' => true,
                'data' => $data,
                'code' => 200
            );
        }

        return array(
            'success' => true,
            'code' => 201
        );
    }
    
    /**
     * Handle success retuns
     *
     * @param  mixed $error
     * @param  int $code
     * @return array
     */
    public function errorReturn($error, $code)
    {
        return array(
            'success' => false,
            'error' => $error,
            'code' => $code
        );
    }
}