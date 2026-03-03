<?php
session_start();
session_destroy();
header("Location: /Proekt/index.php");
