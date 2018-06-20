<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Created by PhpStorm.
 * User: deleray
 * Date: 19/06/2018
 * Time: 15:05
 */

/**
 * Class FormService
 * @package App\Service
 */
class FormService
{
    /**
     * @var null|\Symfony\Component\HttpFoundation\Request
     */
    private $request;
    /**
     * @var
     */
    private $entity;

    /**
     * FormService constructor.
     * @param RequestStack $requestStack
     */
    function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param $entity
     * @return mixed
     * in my case i will set fields to return a not empty entity
     */
    public function dataBuild($entity)
    {
        $this->entity = $entity;

        $parameters = $this->request->request->all();

        switch ($parameters){
            case in_array($parameters['contact'], $parameters):
                $fields = $parameters['contact'];
                foreach ($fields as $key => $value){
                    if($key === "_token" || $key === "submit"){
                       continue;
                    }
                    $method = 'set'.ucfirst($key);
                    $this->entity->$method($value);
                }
                break;
//            you can add an other case with a different way
//            case in_array($parameters['facture'], $parameters):
//                $fields = $parameters['facture'];
//              break;
        }

        return $this->entity;
    }

}