<html>
Welcome to academy page !!
<br><br>
<form method="get" action="{{ route('register') }}">
    <button type="submit">Sign-up</button>
</form>

<form method="get" action="{{ route('course-page') }}">
    <button type="submit">course-page</button>
</form>

<form method="get" action= {{route('login')}}>
    <button type="submit">login</button>
</form>

<form method="get" action= {{route('view')}}>
    <button type="submit">view</button>
</form>

</html>
