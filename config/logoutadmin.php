<?php
session_start();
unset($_SESSION['adminjobskuy']);
session_destroy();
header("Location: ../admin/");
