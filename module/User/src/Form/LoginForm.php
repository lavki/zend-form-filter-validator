<?php

namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Filter;
use Zend\Validator;
use Zend\InputFilter\InputFilter;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct( 'login-form' );

        $this->addElements();
        $this->addInputFilter();
    }

    private function addElements()
    {
        $this->add([
            'name'       => 'email-address',
            'type'       => Element\Email::class,
            'attributes' => [
                'class'       => 'form-control input-sm',
                'id'          => 'email-address',
                'placeholder' => 'email@example.com',
                'required'    => true,
                'autofocus'   => true,
            ],
            'options'    => [
                'label' => 'Email Address:',
            ],
        ]);

        $this->add([
            'name'       => 'password',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'       => 'form-control input-sm',
                'id'          => 'password',
                'placeholder' => '*******',
                'required'    => true,
            ],
            'options'    => [
                'label' => 'Password:',
            ],
        ]);

        $this->add([
            'name' => 'remember-me',
            'type' => Element\Checkbox::class,
            'attributes' => [
                'id' => 'remember-me',
            ],
            'options'    => [
                'label' => 'Remember Me:'
            ],
        ]);

        $this->add([
            'name' => 'csrf',
            'type' => Element\Csrf::class,
            'options' => [
                'csrf_options' => [
                    'timeout' => 600,
                ],
            ],
        ]);

        $this->add([
            'name'       => 'login',
            'type'       => Element\Submit::class,
            'attributes' => [
                'value' => 'Login',
                'class' => 'btn btn-sm btn-primary btn-block',
            ],
        ]);

    }

    private function addInputFilter()
    {
        $filter = new InputFilter();

        $this->setInputFilter($filter);

        $filter->add([
            'name'       => 'email-address',
            'require'    => true,
            'filters'    => [
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name'    => Validator\EmailAddress::class,
                    'options' => [
                        'allow'      => Validator\Hostname::ALLOW_DNS,
                        'useMxCheck' => false,
                    ],
                ],
            ],
        ]);

        $filter->add([
            'name'       => 'password',
            'require'    => true,
            'filters'    => [
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name'    => Validator\StringLength::class,
                    'options' => ['min' => 5, 'max' => 30],
                ],
            ],
        ]);

        $filter->add([
            'name'       => 'remember-me',
            'required'   => false,
            'filters'    => [],
            'validators' => [
                [
                    'name'    => Validator\InArray::class,
                    'options' => [
                        'haystack' => [0, 1],
                    ],
                ],
            ],
        ]);
    }
}
