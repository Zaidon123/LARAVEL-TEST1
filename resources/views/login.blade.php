<html>

    Welcome to login page !!

    <form method="POST" action="{{ route('log-me-in') }}">
        @csrf
        <input type="text" name="email" placeholder="Enter your email">
        <br>
        <input type="password" name="password" placeholder="Enter your password">
        <br><br>
        <button type="submit">Signup</button>

    </form>

</html>
