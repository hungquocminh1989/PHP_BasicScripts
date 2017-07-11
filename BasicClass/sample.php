<?php
//Cơ bản các lớp hướng đối tượng trong PHP

/**
* ★★★★★★★★★★
* ABSTRACT CLASS
* ★★★★★★★★★★
*/
abstract class abst_class_A //Lớp kế thừa
{
	protected function fn_A() //Hàm protected chỉ gọi được bên trong class hoặc class kế thừa
	{
		echo "<br>";
		echo "fn_A";
	}
	private function fn_A1() //Hàm private chỉ gọi được bên trong class của chính nó
	{
		echo "<br>";
		echo "fn_A1";
	}
	public function fn_A2() //Ở đâu gọi cũng được (thông qua kế thừa hoặc đối tượng)
	{
		echo "<br>";
		echo "fn_A2";
	}
}
abstract class abst_class_B extends abst_class_A //Lớp kế thừa 
{
	final protected function fn_B() //final function trong abstract class sẽ không cho phép overide
	{
		echo "<br>";
		echo "fn_B";
	}
}

/**
* ★★★★★★★★★★
* INTERFACE CLASS
* ★★★★★★★★★★
*/
interface iA //Lớp giao diện
{
	public function interface_A();
}
interface iB //Lớp giao diện
{
	public function interface_B();//Chỗ nào kế thừa lớp giao diện bắt buộc phải overide lại
}

/**
* ★★★★★★★★★★
* NORMAL CLASS
* ★★★★★★★★★★
*/
class sample extends abst_class_B implements iA,iB //1 lớp chỉ kế thừa được duy nhất 1 lớp khác và kế thừa được nhiều lớp giao diện
{
	public function interface_A()
	{
		echo "<br>";
		echo "Overide interface_A";
	}
	public function interface_B()
	{
		echo "<br>";
		echo "Overide interface_B";
	}
	public function exec_A()
	{
		$this->fn_A();
	}
	public function exec_B()
	{
		$this->fn_B();
	}
	
}

/**
* ★★★★★★★★★★
* USE CLASS
* ★★★★★★★★★★
*/
$model = new sample();
$model->exec_A();
$model->exec_B();

?>