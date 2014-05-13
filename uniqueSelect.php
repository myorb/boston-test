<?php
/*
  Use PHP 5.3.

  "records.csv" contains CSV-delimited records on each line in the
  following format:
    
    2,070843201,18594,28,1

  Use the following framework to read "records.csv" and output
  "records_pruned.csv" such that each record in the output file
  has a one record for each ID in the second field (the 9-digit
  ID). For records in "records.csv" that share the same 9-digit
  ID, transfer only the first to "records_pruned.csv".

  For example:

  records.csv
    2,111111111,AAAAA,28,1
    2,222222222,BBBBB,28,1
    2,111111111,CCCCC,28,1
    2,333333333,DDDDD,28,1
    2,222222222,AAAAA,28,1

  should output records_pruned.csv
    2,111111111,AAAAA,28,1
    2,222222222,BBBBB,28,1
    2,333333333,DDDDD,28,1

  Sorting is not important.

  Solution will be evaluated for efficiency of algorithm and
  clarity of code.
*/
$time_start = microtime(true); 

$finalCsvData = array();

if (($handle = fopen("./csv/records.csv", "r")) !== FALSE) {
	while (!feof($handle)) {
		$line = fgets($handle);
		$temp_array[] = substr($line,2,9);
		$orig_array[] = trim($line);
   	}
  fclose($handle);
}
//find all unique 9-digit ID and computes the intersection of arrays using keys for comparison
$finalCsvData = array_intersect_key($orig_array,array_unique($temp_array));

if (($handle = fopen("./csv/records_pruned.csv", "w")) !== FALSE) {
  foreach ($finalCsvData as $csvLine) {
      fputcsv($handle, explode(',',$csvLine));
  }  
  fclose($handle);
}

echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);