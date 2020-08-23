<?php
session_start();
requireValidSession();

$currentDate = new DateTime();

$user = $_SESSION['user'];

$selectedPeriod = $_POST['period'] ?? $currentDate->format('Y-m');
$periods = [];
for ($yearDiff = 2; $yearDiff >= 0; $yearDiff--) {
	$year = date('Y') - $yearDiff;
	for ($month = 1; $month <= 12; $month++) {
		$date = new DateTime("{$year}-{$month}-1");
		$periods[$date->format('Y-m-d')] = utf8_encode(strftime('%B de %Y', $date->getTimestamp()));
	}
}

$registries = WorkingHours::getMonthlyReport($user->id, new DateTime());

$report = [];
$workDay = 0;
$sumOfWorkedTime = 0;
$lastDay = getLastDayOfMonth($selectedPeriod)->format('d');

for ($day = 1; $day <= $lastDay; $day++) {
	$date = $selectedPeriod->format('Y-m') . '-' . sprintf('%02d', $day);
	$registry = isset($registries[$date]) ? $registries[$date] : ($registries[$date] = []);

	if (isPastWorkday($date)) $workDay++;

	if ($registry) {
		$sumOfWorkedTime += $registry->worked_time;
		array_push($report, $registry);
	} else {
		array_push($report, new WorkingHours([
			'work_date' => $date,
			'worked_time' => 0
		]));
	}
}

$expectedTime = $workDay * DAYLY_TIME;
$balance = getTimeSrtingFromSeconds(abs($sumOfWorkedTime - $expectedTime));
$sign = ($sumOfWorkedTime >= $expectedTime) ? '+' : '-';

loadTemplateView('monthly_report', [
	'report' => $report,
	'sumOfWorkedTime' => getTimeSrtingFromSeconds($sumOfWorkedTime),
	'balance' => "{$sign}{$balance}",
	'periods' => $periods
]);
