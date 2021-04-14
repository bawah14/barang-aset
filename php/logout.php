<?php
session_start();
session_destroy();
header("Location: ../dist/login.php");