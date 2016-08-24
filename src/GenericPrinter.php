<?php namespace Svz\Generic;

use PhpParser\Comment;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\Ternary;
use PhpParser\Node\Name;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\Stmt\UseUse;
use PhpParser\PrettyPrinter\Standard as StandardPrinter;

class GenericPrinter extends StandardPrinter
{
	/**
	 * @var string
	 */
	private $fullQualifiedName;
	/**
	 * @var string
	 */
	private $className;

	/**
	 * GenericPrinter constructor.
	 * @param string $fullQualifiedName
	 */
	public function __construct($fullQualifiedName)
	{
		parent::__construct(['shortArraySyntax' => true]);
		$this->fullQualifiedName = $fullQualifiedName;
		$parts = explode('\\',$fullQualifiedName);
		$this->className = end($parts);
	}

	/**
	 * @return string
	 */
	public function getClassName(): string
	{
		return $this->className;
	}

	/**
	 * @return string
	 */
	public function getFullQualifiedName(): string
	{
		return $this->fullQualifiedName;
	}



	public function prettyPrint(array $stmts)
	{
		$stmts = $this->_manipulate($stmts);
		return parent::prettyPrint($stmts); // TODO: Change the autogenerated stub
	}

	private function _manipulate($stmts)
	{
		foreach ($stmts as $stmt) {
			if ($stmt instanceof Class_) {
				$this->_manipulateClass($stmt);
			} else if ($stmt instanceof ClassMethod) {
				$this->_manipulateClassMethod($stmt);
			} else if ($stmt instanceof Namespace_) {
				$this->_manipulateNamespace($stmt);
			} else if ($stmt instanceof Use_) {
				$this->_manipulateUse($stmt);
			}  else if ($stmt instanceof New_) {
				$this->_manipulateNew($stmt);
			}  else if ($stmt instanceof Name) {

			} else if ($stmt instanceof Ternary) {

				$this->_manipulateTernary($stmt);
			} else if (is_array($stmt)) {
				foreach ($stmt as $s) {
					$this->_manipulate($s);
				}
			} else {

				if(isset($stmt->stmt)){
					foreach ($stmt->stmt as $s) {
						$this->_manipulate($s);
					}
				}else{
				//	echo (is_object($stmt) ? get_class($stmt) : print_r($stmt, true)) . PHP_EOL;

				}


			}
		}
		return $stmts;
	}

	private function _manipulateClass(Class_ $stmt)
	{
		$stmt->name = $this->_replaceGeneric($stmt->name);
		$this->_manipulate($stmt->stmts);
	}

	private function _manipulateClassMethod(ClassMethod $classMethod)
	{
//		if ($stmt->returnType) {
//			$this->_manipulateName($stmt->returnType);
//		}
//		foreach ($stmt->params as $param) {
//			$this->_manipulateParam($param);
//		}
//		$comment = $stmt->getDocComment();
//		if ($comment) {
//			$doc = $this->_manipulateComment($comment);
//			$stmt->setAttribute('comments', [$doc]);
//
//		}


		foreach ($classMethod->stmts as $stmt) {

			$this->_manipulate($stmt);
		}

		return;
	}

	private function _manipulateParam(Param $param)
	{
		if (isset($param->type->parts[0])) {
			$param->type->parts[0] = $this->_replaceGeneric($param->type->parts[0]);
		}

		return;
	}

	private function _manipulateComment(Comment\Doc $comment)
	{
		$doc = new Comment\Doc($this->_replaceGeneric($comment->getText()), $comment->getLine(), $comment->getFilePos());

		return $doc;
	}


	private function _replaceGeneric($subject)
	{
		$search = 'GenericClass' . '_';
		$replace = $this->className . '_';
		return str_replace($search, $replace, $subject);
	}

	private function _replaceWithFullQualifiedName($subject)
	{
		$search = 'GenericClass';
		return str_replace($search, $this->fullQualifiedName, $subject);
	}

	private function _manipulateName(Name $name)
	{
		$name->parts[0] = $this->_replaceWithFullQualifiedName($name->parts[0]);
		return;
	}

	private function _manipulateUse(Use_ $stmt)
	{

		foreach ($stmt->uses as $use) {
			$this->_manipulateUseUse($use);
		}
		return;
	}

	private function _manipulateUseUse(UseUse $use)
	{
		$this->_manipulateName($use->name);
		return;
	}

	private function _manipulateNew(New_ $stmt)
	{
		$classname = array_pop($stmt->class->parts);

		$stmt->class->parts[] =$this->_replaceGeneric($classname);

	}

	private function _manipulateTernary(Ternary $stmt)
	{
		$this->_manipulate([
			$stmt->cond,
			$stmt->if,
			$stmt->else,
		]);
	}

	private function _manipulateNamespace(Namespace_ $stmt)
	{
		$stmt->name->parts = explode('\\',$this->fullQualifiedName);
		$this->_manipulate($stmt->stmts);
	}
}