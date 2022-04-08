<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<table>
    <caption>Students</caption>
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Board</th>
        <th scope="col">Grades</th>
        <th scope="col">Avarage Grade</th>
        <th scope="col">Is Pass</th>
        <th scope="col">Link</th>
        <th scope="col">Add Grade <input id="new-grade" value="" type="number"/></th>
    </tr>
    </thead>
    <tbody id="students">
    </tbody>
</table>
<script src="/public/js/script.js"></script>
<script>
    app.init();
</script>
</body>
</html>