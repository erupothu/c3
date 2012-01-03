<?php

class INSIGHT_DB_mysqli_driver extends CI_DB_mysqli_driver {
	
	public function __construct($params) {
		parent::__construct($params);
	}
	
	public function enable_escaping() {
		$this->_protect_identifiers = true;
		return $this;
	}
	
	public function disable_escaping() {
		$this->_protect_identifiers = false;
		return $this;
	}
	
	public function join($table, $cond, $type = '') {
		
		if($type != '') {
			
			$type = strtoupper(trim($type));
			if(!in_array($type, array('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER'))) {
				$type = '';
			}
			else {
				$type .= ' ';
			}
			
		}
		
		if(is_array($table) && count($table) == 1)
			$table = array_pop($table);
		
		if(is_array($table)) {
			
			$table_items = array();
			foreach($table as $table_item) {
				$this->_track_aliases($table_item);
				$table_items[] = $this->_protect_identifiers($table_item, true, null, false);;
			}
			
			$table_string = '(' . implode(', ', $table_items) . ')';
		}
		else {
			$this->_track_aliases($table);
			$table_string = $this->_protect_identifiers($table, true, null, false);
		}
		
		// Extract any aliases that might exist.  We use this information
        // in the _protect_identifiers to know whether to add a table prefix
		if(preg_match('/([\w\.]+)([\W\s]+)(.+)/', $cond, $match)) {
			$match[1] = $this->_protect_identifiers($match[1]);
			$match[3] = $this->_protect_identifiers($match[3]);

			$cond = $match[1] . $match[2] . $match[3];
        }

		// Assemble the JOIN statement
        $join = $type . 'JOIN ' . $table_string . ' ON ' . $cond;

		$this->ar_join[] = $join;
		if($this->ar_caching === true) {
			$this->ar_cache_join[] = $join;
			$this->ar_cache_exists[] = 'join';
		}
		
		return $this;
	}
}