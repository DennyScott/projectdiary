<?php
session_start();
if(!isset($_SESSION["user"])){
	header('location: ' . URL . 'home/signin');
	exit;
}