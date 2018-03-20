<?php

namespace User\Controller;

use User\Form\LoginForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    public function loginAction()
    {
        $form = new LoginForm();

        if( $this->getRequest()->isPost() )
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

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
