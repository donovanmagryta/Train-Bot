<?

/**
 * Finds the value of an intersection of a CSV file
 * when given column and row headings
 *
 * @param string $file   Path to CSV file
 * @param string $column Column heading to search by
 * @param string $row    Row heading to search by
 */
function intersect($file, $column, $row) {

	// All cells will be strings
	$column = (string) $column;
	$row    = (string) $row;

	// Get table
	$table = array_map('str_getcsv', file($file));

	// Get headings and flip so values match row keys
	$headings = array_shift($table);
	array_shift($headings); // First is empty!
	$headings = array_flip($headings);

	// Move row headings to array keys
	foreach ($table as $key => $value) $rows[array_shift($value)] = $value;

	// Get column key, if exists
	if (!isset($headings[$column])) return null;
	$key = $headings[$column];

	// Get intersection value, if exists
	if (!isset($rows[$row][$key])) return null;
	$value = $rows[$row][$key];
	
	// Attempt to cast to a sensible type
	if (in_array(strtolower($value), ['true', 'false'])) $value = (bool) $value;
	if (is_numeric($value)) $value = $value+0;

	return $value;

}