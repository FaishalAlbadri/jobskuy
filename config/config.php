<?php
define('HOST', 'sql100.epizy.com');
define('USER', 'epiz_30640197');
define('PASS', '4Cr2Kfd5FNS');
define('DB', 'epiz_30640197_jobskuy');

$con = new mysqli(HOST, USER, PASS, DB) or die('Koneksi Ke Database Error');

date_default_timezone_set('Asia/Jakarta');
