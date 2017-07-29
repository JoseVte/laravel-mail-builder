<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    {{-- So that mobile will display zoomed in --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- enable media queries for windows phone 8 --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- disable auto telephone linking in iOS --}}
    <meta name="format-detection" content="telephone=no">
    <title>@yield ('title')</title>
    <style type="text/css">
        {{ file_exists(public_path('/css/email.css')) ? file_get_contents(public_path('/css/email.css')) : (file_get_contents(public_path() . elixir('css/email.css'))) }}
    </style>
</head>

<body bgcolor="white" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    {{-- 100% background wrapper (grey background) --}}
    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="grey">
        <tr>
            <td align="center" valign="top">
                {{-- 600px container (white background) --}}
                <table border="0" width="600" cellpadding="0" cellspacing="0" bgcolor="white" class="container">
                    <tr>
                        <td class="header" align="center">
                            <a href="{{ route('home') }}" class="link-logo">
                                <img src="@{{ asset(config('mail.logo')) }}" alt="@{{ config('app.url') }}" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="content" align="left">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="subtitle-table force-row">
                                <tr>
                                    <td class="subtitle-td">
                                        <h2>@yield ('subtitle')</h2>
                                    </td>
                                </tr>
                                <tr><td><hr/></td></tr>
                                <tr>
                                    <td class="subtitle-td">
                                        @yield('content')
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer-text" align="left">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="force-row full-width">
                                <tr>
                                    <td class="content-wrapper">
                                        <br>
                                        <table class="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>Copyright &copy; @{{ date('Y') }} @{{ config('mail.copyright') }}</td>
                                            </tr>
                                        </table>
                                        <br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                {{-- /600px container --}}
            </td>
        </tr>
    </table>
    {{-- /100% background wrapper --}}
</body>
</html>
