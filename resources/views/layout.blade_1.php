<!DOCTYPE html>
<html lang="en">
   <head>
        <meta charset="utf-8" />
        <title>Home page</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewpor11t">
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <select name="languages" onchange="fncChangeLang(this);">
            @foreach ($langs as $lang)
                <option value="{{ $lang->iso2 }}" @if($lang->iso2 == App::getLocale()) selected="selected" @endif>{{ $lang->name }}</option>
            @endforeach
        </select>

        @yield('content')


        <script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
        <script>
            function fncChangeLang(obj) {
                var lang = $(obj).val();
                window.location.href = '{{ route("home_lang", ["lt" => ='+lang+']) }}';
            }
        </script>
        @yield('footer_script')
    </body>
</html>
