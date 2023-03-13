<html>
    Course page !!
    <br>
    enter the information
    <br>
    <script src="jquery.min.js"></script>
    <form method="POST" action="{{ route('add-course') }}">
        @csrf
        <input type="text" name="name" placeholder="name">
        <br>
        <input type="teacher" name="teacher" placeholder="teacher">
        <br>
        <input type="text" name="description" placeholder="description">
        <br>
        <input type="number" name="cost" placeholder="cost">
        <br>
        <br>
        <button type="submit">add</button>
    </form>
    <form method="get" action="{{ route('view-courses') }}">
        <button type="submit">view-courses</button>
    </form>
</html>

