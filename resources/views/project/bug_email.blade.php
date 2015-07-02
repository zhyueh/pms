<!doctype html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  </head>
<body>
<div style="width:100%"> 
hi, {{ $user->name }}
</div>
<div style="width:100%">
    <a href="{{ $link }}"<h1>{{ $bug->bug_name }}</h1></a>
    <h2>{{ trans('title.description') }}</h2>
    <div>
        {!! $bug->description !!}
    </div>
    <h2>{{ trans('title.requirement') }}</h2>
    <div>
        {!! $bug->requirement!!}
    </div>
</div>
</body>
</html>
