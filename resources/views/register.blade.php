<html>
    Welcome to academy page !!
    <br>
    enter your information
    <br>
    <script src="jquery.min.js"></script>
    <form method="POST" action="{{ route('new-register')}}">
        @csrf
        <input type="text" name="name" placeholder="name">
        <br>
        <input type="email" name="email" placeholder="email">
        <br>
        <input type="password" name="password" placeholder="password">
        <br>
        <input type="password" name="password_confirmation" placeholder="password_confirmation">
        <br>
        <input type="text" name="address" placeholder="address">
        <br>
        <input type="number" name="phone" placeholder="phone">
        <br>
        <input type="text" name="skills" placeholder="skills">
        <br>
        <input type="text" name="about" placeholder="about">
        <br>
        <br>
        <button type="submit">Sign-up</button>

    </form>
    <?php
//    $json = file_get_contents('http://localhost/academy/public/api/sign-up');
//    $obj[] = json_decode($json);
//    $data = $obj->error;
//    print_r( $data);
    // dd($obj);
    ?>
</html>
