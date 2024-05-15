<?php

declare(strict_types=1);

namespace App\UI\Register;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use App\Models\UserModel;

class RegisterPresenter extends Presenter{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function createComponentRegisterForm(): Form{
        $form = new Form;

        $form->addText('first_name','Jméno')
            ->setRequired('Prosím zadejte jméno.');
        $form->addText('last_name','Příjmení')
            ->setRequired('Prosím zadejte příjmení.');
        $form->addEmail('email','Email')
            ->setRequired('Prosím zadejte email.')
            ->addRule(Form::Email, 'Prosím zadejte validní email.');
        $form->addText('tel', 'Telefon')
            ->setRequired('Prosím zadejte svůj telefon.')
            ->addRule(Form::PATTERN, 'Prosím zadejte validní telefon', '^\+?[1-9]\d{1,14}$');
        $form->addPassword('password','Heslo')
            ->setRequired('Prosím zadejte heslo.');
        $form->addPassword('passwordConfirm','Znovu heslo')
            ->setRequired('Prosím zadejte heslo.')
            ->addRule(Form::Equal, "Hesla se neshodují.",$form['password']);
        $form->addSubmit('register', 'Zaregistrovat se');
        $form->onSuccess[] = [$this,"registerFormSucceded"];
        return $form;
    }
    public function registerFormSucceded(Form $form,$data): void{
        try{
            $this->userModel->register($data->first_name,$data->last_name,$data->email,$data->tel,$data->password);
            $this->flashMessage('Registrace byla úspěšná');
            $this->redirect('Products:default'); // nefunguje
        } catch(\Exception $e){
            $form->addError('Registrace neproběhla úspěšně.');
        }
    }
}