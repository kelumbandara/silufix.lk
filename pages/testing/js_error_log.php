<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Write to Log File</title>

<script src="../sky/js/write_LogFile.js"></script>
<script>
   function handleClick() 
    {
        var data = "Errro handle sucess..feb 07.2";
        //alert(data);
        writeToLogFile(data);
    }
</script>
</head>
<body>

<button onclick="handleClick()">Write to Log File</button>

</body>
</html>
