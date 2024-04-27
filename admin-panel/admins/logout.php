<?php

session_start();
session_unset();
session_destroy();

echo "<script> window.location.href='http://localhost:8000/admin-panel'; </script>";
