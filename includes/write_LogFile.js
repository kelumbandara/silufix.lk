function writeToLogFile(data) 
{
    writeToLogFile("Test error log");
    //alert("test-1");
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./includes/logging.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() 
    {
        //alert("test-1");
        if (xhr.readyState === XMLHttpRequest.DONE)
        {
            if (xhr.status === 200) 
            {
                //alert("Data written to log file successfully");
            } else {
                //alert("Error writing data to log file");
            }
        }
    };
    xhr.send("data=" + encodeURIComponent(data));
    //alert("test-9");
}