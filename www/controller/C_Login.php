<?php
include_once('controller/C_Base.php');

//
// Контроллер страницы авторизации
//
class C_Login extends C_Base
{
	private $login;	// логин пользователя
	
	//
	// Конструктор.
	//
	public function __construct() 
	{
		parent::__construct();			
		$this->login = '';
	}
	
	//
    // Виртуальный обработчик запроса.
    //
    protected function OnInput() 
    {
		// Выход из системы пользователя.
        $mUsers = M_Users::Instance();        
        $mUsers->Logout();
        
		// C_Base.
        parent::OnInput();
        
		// Обработка отправки формы.
        if ($this->IsPost())
        {
	        if ($mUsers->Login($_POST['login'], 
		                       $_POST['password'], 
						       isset($_POST['remember'])))
			{
				header('Location: index.php');
				die();
			}
			
			$this->login = $_POST['login'];
        }
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() 
    {    
		// Генерация содержимого формы входа.
        $vars = array('login' => $this->login);        
    	$this->content = $this->View('tpl_login.php', $vars);
		
		// C_Base.
        parent::OnOutput();
    }
}