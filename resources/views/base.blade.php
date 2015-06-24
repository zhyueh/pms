<html>
<title>
@section('title')
PMS 主页
@show()
</title>
<meta charset="utf-8">
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/bootstrap-3.3.4-dist/css/bootstrap.css">
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/bootstrap-3.3.4-dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/asset/css/pms.base.css">
@yield('reference_before_body')
<body>
@section('body')
empty content
@show()


</body>
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/jquery/jquery.min.js"></script>
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
@yield('reference_after_body')
</html>
