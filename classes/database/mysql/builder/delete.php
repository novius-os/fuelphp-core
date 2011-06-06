<?php
/**
 * Database query builder for DELETE statements.
 *
 * @package    Fuel/Database
 * @category   Drivers
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Core;

class Database_MySQLi_Builder_Delete extends \Database_Query_Builder_Delete {

	/**
	 * Compile the SQL query and return it.
	 *
	 * @param   object  Database instance
	 * @return  string
	 */
	public function compile(\Database_Connection $db)
	{
		// see if we can get away with a truncate
		if ( empty($this->_where) and is_null($this->_limit))
		{
			// use truncate instead
			$query = 'TRUNCATE '.$db->quote_table($this->_table);
		}
		else
		{
			$query = parent::compile($db);
		}

		return $query;
	}

}
// End Database_MySQLi_Builder_Delete
