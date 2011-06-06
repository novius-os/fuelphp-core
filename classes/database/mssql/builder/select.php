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
	 * This MSSQL specific version translates LIMIT and OFFSET into MSSQL2005 tSQL
	 *
	 * Based on the Kohana driver of xrado, https://github.com/xrado
	 *
	 * @param   object  Database instance
	 * @return  string
	 */
	public function compile(\Database_Connection $db)
	{
		// get the query
		$sql = parent::compile($db);

		// fetch any offset generated
		if (preg_match("/OFFSET ([0-9]+)/i", $sql, $matches))
		{
			list($replace,$offset) = $matches;
			$sql = str_replace($replace, '', $sql);
		}

		// fetch any limit generated
		if (preg_match("/LIMIT ([0-9]+)/i", $sql, $matches))
		{
			list($replace,$limit) = $matches;
			$sql = str_replace($replace, '', $sql);
		}

		if (isset($limit) or isset($offset))
		{
			if ( ! isset($offset))
			{
				$sql = preg_replace("/^(SELECT|DELETE|UPDATE)\s/i", "$1 TOP " . $limit . ' ', $sql);
			}
			else
			{
				$orderby = stristr($sql, 'ORDER BY');

				if ( ! $orderby)
				{
					$over = 'ORDER BY (SELECT 0)';
				}
				else
				{
					$over = trim(preg_replace('/[^,\s]*\.([^,\s]*)/i', 'fuel_inner_tbl.$1', $orderby));
				}

				// remove ORDER BY clause from $sql
				$sql = preg_replace('/\s+ORDER BY(.*)/', '', $sql);

				// add ORDER BY clause as an argument for ROW_NUMBER()
				$sql = "SELECT ROW_NUMBER() OVER ($over) AS fuel_fake_rownr, * FROM ($sql) AS fuel_inner_tbl";

				if (isset($limit))
				{
					$start = $offset + 1;
					$end = $offset + $limit;
					$sql = "WITH fuel_outer_tbl AS ($sql) SELECT * FROM fuel_outer_tbl WHERE fuel_fake_rownr BETWEEN $start AND $end";
				}
				else
				{
					$sql = "WITH fuel_outer_tbl AS ($sql) SELECT * FROM fuel_outer_tbl WHERE fuel_fake_rownr > $offset";
				}
			}
		}

		return $sql;
	}

}
// End Database_Mssql_Builder_Select
