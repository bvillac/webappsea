<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuario;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false;
    private $_errorSession = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    //*****************INICIO TODO ************/
    public function login()
    {
        //$usuario=new Usuario();
        /*if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;*/
        if ($this->validate()) {
            $usuario = Usuario::findByUsername($this->username);
            if (isset($usuario)) {
                $status = $usuario->validatePassword($this->password);
                $status_activo = $usuario->usu_estado_activo;
                if ($status_activo == 1) { // si es usuario activo
                    if ($status && isset($status)) {                        
                        $usuario->createSession($emp_id);
                        // agregar link dash session

                        Yii::$app->user->login($usuario, 0);
                        Yii::$app->user->setIdentity($usuario);
                    } else { // error password
                        $this->setErrorSession(true);
                        Yii::$app->session->setFlash('error', Yii::t("login", "<h4>Error</h4>Incorrect username or password."));
                        $usuario->destroySession();
                        return false;
                    }
                } else { // account disabled
                    $this->setErrorSession(true);
                    Yii::$app->session->setFlash('error', Yii::t("login", "<h4>Error</h4>Incorrect username or password."));
                    $usuario->destroySession();
                    return false;
                }
                return $status;
            } else {
                $this->setErrorSession(true);
                Yii::$app->session->setFlash('error', Yii::t("login", "<h4>Error</h4>Incorrect username or password."));
                return false;
            }
        } else {
            $this->setErrorSession(true);
            Yii::$app->session->setFlash('error', Yii::t("login", "<h4>Error</h4>Incorrect username or password."));
            return false;
        }

        
    }
    
    public function setErrorSession($error) {
        $this->_errorSession = $error;
    }
    
    public function getErrorSession() {
        return $this->_errorSession;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::findByUsername($this->username);
        }

        return $this->_user;
    }
}
