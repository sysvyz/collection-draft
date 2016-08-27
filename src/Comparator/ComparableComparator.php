<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.08.16
 * Time: 04:12
 */

namespace Svz\Generic\Comparator;



use Cofi\Comparator\Abstracts\AbstractComparator;
use Svz\Generic\Contracts\Comparable;

class ComparableComparator extends AbstractComparator {

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		return $this->_compare($a,$b);
	}
	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function _compare(Comparable $a,Comparable $b)
	{
		return $a->compare($b);
	}

}