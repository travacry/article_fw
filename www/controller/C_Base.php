<?php
include_once('controller/Controller.php');
include_once('model/M_Users.php');
include_once('model/M_Example.php');

//
// ������� ���������� �����.
//
abstract class C_Base extends Controller
{
	protected $needLogin;	// ������������� ����������� 
	protected $user;		// �������������� ������������
	
	private $start_time;	// ����� ������ ��������� ��������
	
	//
	// �����������.
	//
	function __construct()
	{
		$this->needLogin = false;
		$this->user = null;		
	}
	
	//
	// ����������� ���������� �������.
	//
	protected function OnInput()
	{
		// ������� ������ ������ � ����������� �������� ������������.
		$mUsers = M_Users::Instance();		
		$mUsers->ClearSessions();		
		$this->user = $mUsers->Get();
		
		// ��������������� �� �������� �����������, ���� ��� ����������.
		if ($this->user == null && $this->needLogin)
		{	
			header("Location: index.php?c=login");
			die();
		}
		
		// �������� ����� ������ ��������� �������.
		$this->start_time = microtime(true);
	}
	
	//
	// ����������� ��������� HTML.
	//	
	protected function OnOutput()
	{
	    // �������� ������ ���� �������.
		$vars = array('content' => $this->content);			
		$page = $this->View('tpl_main.php', $vars);
						
		// ����� ��������� �������.
        $time = microtime(true) - $this->start_time;        
        $page .= "<!-- ����� ��������� ��������: $time ���.-->";
        
		// ����� HTML.
        echo $page;
	}
}
