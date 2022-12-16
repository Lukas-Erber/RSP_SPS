<?php
	require_once 'includes/dbconn.inc.php';
	require_once 'includes/funkce.inc.php';

	$posudekId = $_GET['posudekId'];

	deletePosudek($conn, $posudekId);

	header("Location: recenze.php");
