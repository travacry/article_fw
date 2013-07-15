<?php
//
// ������� ����� �����������.
//
abstract class Controller
{
	//
	// �����������.
	//
	function __construct()
	{		
	}
	
	//
	// ������ ��������� HTTP �������.
	//
	public function Request()
	{
		$this->OnInput();
		$this->OnOutput();
	}
	
	//
	// ����������� ���������� �������.
	//
	protected function OnInput()
	{
	}
	
	//
	// ����������� ��������� HTML.
	//	
	protected function OnOutput()
	{
	}
	
	//
	// ������ ���������� ������� GET?
	//
	protected function IsGet()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}

	//
	// ������ ���������� ������� POST?
	//
	protected function IsPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	//
	// ��������� HTML ������� � ������.
	//
	protected function View($fileName, $vars = array())
	{
		foreach ($vars as $k => $v) 
		$$k = $v;
	
		ob_start(); 
		include "view/$fileName"; 
		return ob_get_clean(); 	
	}	
}
