<?php

$outputFileName = readline("Enter output file name:\n");
if (file_exists(getcwd().'/'.$outputFileName.'.csv')) {
	unlink(getcwd().'/'.$outputFileName.'.csv');
	$outputFileName = getcwd().'/'.$outputFileName.'.csv';
}
else{
	$outputFileName = getcwd().'/'.$outputFileName.'.csv';
}
$openFile = fopen($outputFileName, 'w');

$currentDate = new DateTime();
$currentDate = date_format($currentDate, 'd-m-Y');
$arrayData = array();
array_push($arrayData, ["Month", "Salary Payment Date", "Bonus Payment Date"]);

for ($month=0; $month<12; $month++) {
	
	/**
	 * Requirement - 1
	 * 
	 * The base salaries are paid on the last day of the month, unless that day is a Saturday or a
	 * Sunday (weekend). In that case, salaries are paid on the Friday before the weekend.
	 */
	$newDate = date('d-m-Y', strtotime($currentDate. ' + ' . $month .' months'));
	$MonthNamefordateGiven = date('F', strtotime($newDate));
	$lastDateOfMonthGiven = date("Y-m-t", strtotime($newDate));
	$lastDayNameOfDateGiven = date('l', strtotime($lastDateOfMonthGiven));
	$lastWorkingDateOfMonthGiven = getlastWorkingDateOfMonthGiven($lastDateOfMonthGiven);
	$lastWorkingDayNameOfDateGiven = date('l', strtotime($lastWorkingDateOfMonthGiven));
	
	/**
	* Requirement - 2
	* 
	* On the 15th of every month bonuses are paid for the previous month, unless that day is a
	* weekend. In that case, they are paid the first Wednesday after the 15th.
	*/
	
	$monthNumber = date('m', strtotime($lastDateOfMonthGiven));
	$year = date('Y', strtotime($lastDateOfMonthGiven));
	$dateFifteen = sprintf("%s-%s-%s", $year, $monthNumber,"15");
	$FifteenthDayDate = date('d-m-Y', strtotime($dateFifteen));
	
	$FifteenthDayName = date('l', strtotime($FifteenthDayDate));
	$nextWednesdayDate = $FifteenthDayDate;
	if($FifteenthDayName == "Sunday" || $FifteenthDayName == "Saturday"){ 
		$nextWednesdayDate = new \DateTime($FifteenthDayDate. 'next wednesday');
		$nextWednesdayDate = $nextWednesdayDate->format('d-m-Y');
	}
	
	$eachData = array();
	array_push($eachData, $MonthNamefordateGiven, $lastWorkingDateOfMonthGiven, $nextWednesdayDate);
	array_push($arrayData, $eachData);
	
}

foreach ($arrayData as $row) {
	fputcsv($openFile, $row);
}

fclose($openFile);

function getlastWorkingDateOfMonthGiven($lastDateOfMonthGiven) {
	$lastWorkingDateOfMonthGiven = null;
	$day = date('l', strtotime($lastDateOfMonthGiven));
	switch ($day) {
		case "Saturday":
			$lastWorkingDateOfMonthGiven = date('d-m-Y', strtotime($lastDateOfMonthGiven. ' -1 days'));
			break;
		case "Sunday":
			$lastWorkingDateOfMonthGiven = date('d-m-Y', strtotime($lastDateOfMonthGiven. ' -2 days'));
			break;
		default :
			$lastWorkingDateOfMonthGiven = $lastDateOfMonthGiven;
	}
	return $lastWorkingDateOfMonthGiven;
}

?>