<?php

namespace app\tests;

class LoginFormCest
{
    //se ejecuta SIEMPRE antes de cada prueba
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');// Sale la palabra login con una etiqueta h1
    }

    // usa `amLoggedInAs` method y el id del usuario
    public function internalLoginById(\FunctionalTester $I)
    {
        $I->amLoggedInAs(100);// Usa id
        $I->amOnPage('/');
        $I->see('Logout (admin)');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('admin')); // usa instancia de app\model\user
        $I->amOnPage('/');
        $I->see('Logout (admin)');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);// usa el id de la etiqueta form '#login-form' y mete un array vacio
        $I->expectTo('see validations errors');// se espera ver errores de validacion
        $I->see('Username cannot be blank.'); // si se cambia a español se cambia las frases
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->see('Logout (admin)');
        $I->dontSeeElement('form#login-form');// no veo el formulario ya que te has logueao
    }
}
