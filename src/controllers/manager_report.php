<?php
session_start();
requireValidSession(true);

$activeUsersCount = User::getActiveUsersCount();
$absentUsers = WorkingHours::getAbsentUsers();

$yearAndMonth = (new DateTime())->format('Y-m');
$seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);
$hoursInMonth = explode(':', getTimeSrtingFromSeconds($seconds))[0];

loadTemplateView('manager_report', [
	'activeUsersCount' => $activeUsersCount,
	'absentUsers' => $absentUsers,
	'hoursInMonth' => $hoursInMonth
]);