<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>表单请求</title>

    <link href="{{ asset('css/app.css')  }}" rel="stylesheet">
</head>
<div id="app">
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('form.submit') }}" method="POST">
            <div class="form-group">
                <label>标题</label>
                <input type="text" name="title" class="form-control" placeholder="输入标题" value="{{ old('title') }}" ref="title">
            </div>
            <div class="form-group">
                <label>URL</label>
                <input type="text" name="url" class="form-control" placeholder="输入URL" value="{{ old('url') }}" ref="url" >
            </div>
            <input value="{{csrf_token()}}" name="_token" type="hidden">
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>