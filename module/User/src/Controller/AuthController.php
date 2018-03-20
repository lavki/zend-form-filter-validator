<?php

namespace User\Controller;

use User\Form\LoginForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    /**
     * Login Page that contains the Login Form
     * @return ViewModel
     */
    public function loginAction()
    {
        // create login form
        $form = new LoginForm();

        // if form was submited then
        if( $this->getRequest()->isPost() )
        {
            // take the data from POST Request
            $data = $this->params()->fromPost();

            // put the data into Form
            $form->setData($data);

            // if data from POST is Correct
            if( $form->isValid() )
            {
                exit( 'Form data is valid! Now can implementation the Authentication process...');
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function logoutAction()
    {

    }
}
