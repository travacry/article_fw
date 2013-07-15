<?php
include_once('controller/C_Base.php');
//
// ����������� ��������-�������.
//
class C_Welcome extends C_Base 
{
	private $input;		// ����� ��� ��������������
	private $result;	// ���������

	//
    // �����������.
    //
    function __construct() 
    {
    	parent::__construct();
    	//$this->needLogin = true; // ����������������, ����� ������� ���������������� ������ � ��������
    }

    //
    // ����������� ���������� �������.
    //
    protected function OnInput() 
    {
		// C_Base.
		parent::OnInput();
		
		// ���������.
		$mUsers = M_Users::Instance();
		$mExample = M_Example::Instance();
		
		// ��������� �������� �����.
		if ($this->IsPost())
		{
			$this->input = $_POST['input'];
			
			if ($_POST['secret'])
			{
				// �������� ������� ���������� ����� �� ������, ��� ��� ���
				// ������ � ������
				$this->result = $mExample->MakeSecretMagic($this->input);				
			}
			else
			{
				$this->result = $mExample->MakeMagic($this->input);			
			}
		}
		else
		{
			$this->input = '������';
			$this->result = null;
		}
    }

    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput() 
    {   	
		// ���������.
		$mUsers = M_Users::Instance();
	
        // ��������� ����������� �������� Welcome.
    	$vars = array(
			'input' => $this->input,
			'result' => $this->result,
			'canUseSecretFunctions' => $mUsers->Can('USE_SECRET_FUNCTIONS'));
    	
    	$this->content = $this->View('tpl_welcome.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
}