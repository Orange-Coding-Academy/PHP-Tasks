<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        #search{
            padding:5px;
            
        }
        button{
            display: block;
            margin-top:5px;
            background-color:blue;
            color:white;
            padding:5px;
            border:2px solid;
            border-radius:5px
        }
    </style>
</head>
<body>

    <form action="search.php" method="get">
        <h1>Search Input</h1>
       <input type="search" name="search" id="search" placeholder="Search here ">
        <button type="submit">Search</button>
    </form>
</body>
</html>
<?php
if (isset($_GET["search"])) {
     $searchInput = $_GET["search"];
echo "<h3>Search result for: " . htmlspecialchars($searchInput) . "</h3>";
}?>