<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab5</title>
</head>
<body>
    <form action="query_1.php" method="get">
        <label for="project_name">Project Name: </label>
        <input type="text" id="project_name" name="project_name">
        <br>
        <label for="date">Date: </label>
        <input type="date" id="date" name="date">
        <br>
        <input type="submit" value="Get works descriptions">
    </form>
    <br>
    <br>
    <form action="query_2.php" method="get">
        <label for="project_name">Project Name: </label>
        <input type="text" id="project_name" name="project_name">
        <input type="submit" value="Get Total Work Time">
    </form>
    <br>
    <br>
    <form action="query_3.php" method="get">
        <label for="manager">Manager Name: </label>
        <input type="text" id="manager" name="manager">
        <input type="submit" value="Get Number of Workers">
    </form>
</body>
</html>