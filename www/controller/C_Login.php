<?php
include_once('controller/C_Base.php');

//
// ���������� �������� �����������
//
class C_Login extends C_Base
{
	private $login;	// ����� ������������
	
	//
	// �����������.
	//
	public function __construct() 
	{
		parent::__construct();			
		$this->login = '';
	}
	
	//
    // ����������� ���������� �������.
    //
    protected function OnInput() 
    {
		// ����� �� ������� ������������.
        $mUsers = M_Users::Instance();        
        $mUsers->Logout();
        
		// C_Base.
        parent::OnInput();
        
		// ��������� �������� �����.
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
    // ����������� ��������� HTML.
    //
    protected function OnOutput() 
    {    
		// ��������� ����������� ����� �����.
        $vars = array('login' => $this->login);        
    	$this->content = $this->View('tpl_login.php', $vars);
		
		// C_Base.
        parent::OnOutput();
    }
}