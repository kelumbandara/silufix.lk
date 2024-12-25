
<?php
    
    //------------- Read User Parameters -----------------------
     session_start();
    // Display the authenticated user's information
    $userName       = $_SESSION["user_name"];
   // $userType       = $_SESSION["user_type"];
    $userAvailable  = $_SESSION["user_availability"];
   
    
    $userType = 'admin';
    $menuId     = 'setting_errorlevel';
    
    //echo isMenuDisabled($userType, $menuId);
    
    echo isMenuDisabled($userType, 'setting_errorlevel') ? 'disabled' : ''; 
    
// Function to check if a menu should be disabled based on user type.
function isMenuDisabled($userType, $menuId) 
{
    // Replace this with your actual logic to determine if the menu should be disabled.
    // For example, check if the user type is 'admin' and menuId is 'setting_errorlevel'.
    return ($userType !== 'admin' && $menuId === 'setting_errorlevel');
}
       
?>