<?php

session_start();
session_destroy();
echo "<script>alert('Logout Success!');parent.location.href='/GLA/Vue/index.html';</script>";

?>