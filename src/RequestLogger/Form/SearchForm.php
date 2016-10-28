<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12.07.16
 * Time: 14:50
 */

namespace RequestLogger\Form;


use RequestLogger\Document\RequestLog;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class SearchForm extends Form implements InputFilterProviderInterface
{
    public function init()
    {
        parent::init();
        $this->setAttribute('action', '/admin/requestlogger');
        $this->setAttribute('method', 'POST');
        $this->add([
            'name'    => 'uid',
            'type'    => 'text',
            'options' => [
                'label' => 'User ID',
            ],
        ]);
        $this->add([
            'name'    => 'method',
            'type'    => 'Zend\Form\Element\Select',
            'options' => [
                'label'         => 'Method Type',
                'value_options' => [
                    'GET'  => 'GET',
                    'POST' => 'POST',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'dateStart',
            'type'       => 'datetime-local',
            'attributes' =>
                [
                    'id' => 'dateStart',
                ],
            'options'    => [
                'label' => 'Date Start',
            ],
        ]);
        $this->add([
            'name'       => 'dateEnd',
            'type'       => 'datetime-local',
            'attributes' =>
                [
                    'id' => 'dateEnd',
                ],
            'options'    => [
                'label' => 'Date End',
            ],
        ]);
        $this->add([
            'name'    => 'Submit',
            'type'    => 'submit',
            'options' => [
                'label' => 'Go',
            ],
        ]);

        $this->setAllowedObjectBindingClass(RequestLog::class);
        $this->setObject(new RequestLog());

    }

    public function getInputFilterSpecification()
    {
        // TODO: Implement getInputFilterSpecification() method.
        return [];
    }

}