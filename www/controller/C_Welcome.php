<?php
include_once('controller/C_Base.php');
//
// Конттроллер страницы-примера.
//
class C_Welcome extends C_Base 
{
	private $input;		// текст для преобразования
	private $result;	// результат

	//
    // Конструктор.
    //
    function __construct() 
    {
    	parent::__construct();
    	//$this->needLogin = true; // раскомментируйте, чтобы закрыть неавторизованный доступ к странице
    }

    //
    // Виртуальный обработчик запроса.
    //
    protected function OnInput() 
    {
		// C_Base.
		parent::OnInput();
		
		// Менеджеры.
		$mUsers = M_Users::Instance();
		$mExample = M_Example::Instance();
		
		// Обработка отправки формы.
		if ($this->IsPost())
		{
			$this->input = $_POST['input'];
			
			if ($_POST['secret'])
			{
				// проверку наличия привилегии здесь не делаем, так как она
				// зашита в модель
				$this->result = $mExample->MakeSecretMagic($this->input);				
			}
			else
			{
				$this->result = $mExample->MakeMagic($this->input);			
			}
		}
		else
		{
			$this->input = 'Пример';
			$this->result = null;
		}
    }

    //
    // Виртуальный генератор HTML.
    //
    protected function OnOutput() 
    {   	
		// Менеджеры.
		$mUsers = M_Users::Instance();
	
        // Генерация содержимого страницы Welcome.
    	$vars = array(
			'input' => $this->input,
			'result' => $this->result,
			'canUseSecretFunctions' => $mUsers->Can('USE_SECRET_FUNCTIONS'));
    	
    	$this->content = $this->View('tpl_welcome.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
}