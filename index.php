<?php
if(isset($_GET['url'])):
    $file = file_get_contents($_GET['url']); //we get HTML-code
    $query = '<meta name="medium" content='; // necessary html tag and att
    switch(substr($file, strpos($file, $query)+strlen($query)+1, 5)) {
        case 'video':
            $query = '<meta property="og:video" content="';
            break;
        case 'image':
            $query = '<meta property="og:image" content="';
            break;
    }
    $buffer = substr($file, strpos($file, $query), 200);

    unset($file);
    
    $buffer = substr($buffer, strlen($query), strpos($buffer, '" />'));

    if($end = strpos($buffer, '"'))
        $buffer = substr($buffer, 0, $end);

    header ('Content-Type: application/octet-stream');
    header ('Accept-Ranges: bytes');
    header ('Content-Disposition: attachment; filename='.$buffer);  
    readfile($buffer);
    header('Location: /');

else:
?>
<html>
<head>
    <title>
        Download from Instagram
    </title>
    <style>
    * {
        text-align: center;
    }
    input {
        width: 500px;
        height: 45px;
        border-radius: 5%;
        margin-bottom: 15px;
    }
    button {
        padding: 0;
        margin: 0;
        border: 0;
        
        background: silver;
        color: black;

        height: 30px;
        width: 500px;
    }

    button:hover {
        background: black;
        color: white;
        transition: 1s;
    }
    
    </style>
</head>
<body>
    <h1>
        Download from Instagram
    </h1>
    <form method="GET">
        <input type="text" name="url" value="" placeholder="Example URL: https://www.instagram.com/p/Bl5nxXbllc_/" required><br/>
        <button type="submit">
            Download
        </button>
    </form>
</body>
</html>
<?php
endif;
?>
