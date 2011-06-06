<?php
/**
 * Database query builder for SELECT statements.
 *
 * @package    Fuel/Database
 * @category   Drivers
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Core;

class Database_Mssql_Builder_Select extends \Database_Pdo_Builder_Select {

	/**
	 * Compile the SQL query and return it.
	 *
	 * @param   object  Database instance
	 * @return  string
	 */
	public function compile(\Database_Connection$db)
	{
		// Callback to quote identifiers
		$quote_ident = array($db, 'quote_identifier');

		// Callback to quote tables
		$quote_table = array($db, 'quote_table');

		// Start a selection query
		$query = 'SELECT ';

		// deal with limit and offset first
		if ($this->_limit !== null)
		{
			// Add limiting
			$query .= ' TOP '.$this->_limit.' ';
		}
		if ($this->_offset !== null and $this->_offset > 0)
		{
			if (empty($this->_select))
			{
				// Select all columns
				$query .= '*';
			}
			else
			{
				// Select all columns
				$query .= implode(', ', array_unique(array_map($quote_ident, $this->_select)));
			}

			$this->_limit = $this->_offset;
			$this->_offset = null;
			$query .= ' FROM ( '. $this->compile($db) .' ) AS subquery';
			if ( ! empty($this->_order_by))
			{
				foreach ($this->_order_by as $idx => $group)
				{
					list ($column, $direction) = $group;

					if ( ! empty($direction))
					{
						$this->_order_by[$idx][$column] = strtoupper($direction) == 'ASC' ? 'DESC' : 'ASC';
					}
					else
					{
						$this->_order_by[$idx][$column] = 'DESC';
					}
				}

				// Add revserse sorting
				$query .= ' '.$this->_compile_order_by($db, $this->_order_by);
			}
			return $query;
		}

		if ($this->_distinct === TRUE)
		{
			// Select only unique results
			$query .= 'DISTINCT ';
		}

		if (empty($this->_select))
		{
			// Select all columns
			$query .= '*';
		}
		else
		{
			// Select all columns
			$query .= implode(', ', array_unique(array_map($quote_ident, $this->_select)));
		}

		if ( ! empty($this->_from))
		{
			// Set tables to select from
			$query .= ' FROM '.implode(', ', array_unique(array_map($quote_table, $this->_from)));
		}

		if ( ! empty($this->_join))
		{
			// Add tables to join
			$query .= ' '.$this->_compile_join($db, $this->_join);
		}

		if ( ! empty($this->_where))
		{
			// Add selection conditions
			$query .= ' WHERE '.$this->_compile_conditions($db, $this->_where);
		}

		if ( ! empty($this->_group_by))
		{
			// Add sorting
			$query .= ' GROUP BY '.implode(', ', array_map($quote_ident, $this->_group_by));
		}

		if ( ! empty($this->_having))
		{
			// Add filtering conditions
			$query .= ' HAVING '.$this->_compile_conditions($db, $this->_having);
		}

		if ( ! empty($this->_order_by))
		{
			// Add sorting
			$query .= ' '.$this->_compile_order_by($db, $this->_order_by);
		}

		return $query;
	}

}
// End Database_Mssql_Builder_Select
