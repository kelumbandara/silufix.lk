<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart TV Dashboard</title>
<style>
  #id_AndonDashboard 
  {
    width: 100%;
    height: 120px; /* Height for a single row */
    overflow: hidden; /* Hide overflow */
    white-space: nowrap; /* Prevent cards from wrapping */
  }
  
  .card 
  {
    display: inline-block;
    width: 150px; /* Adjust card width as needed */
    height: 100px; /* Adjust card height as needed */
    margin-right: 10px; /* Adjust spacing between cards */
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    text-align: center;
    line-height: 100px; /* Center content vertically */
    font-size: 18px;
  }
</style>
</head>
<body>
<div id="id_AndonDashboard">
  <!-- Cards will be dynamically added here -->
</div>

<script>
// JavaScript code for automatic scrolling of the dashboard
const cardContainer = document.getElementById('id_AndonDashboard');
const cardsPerPage = 6; // Maximum number of cards per row
const scrollSpeed = 30; // Adjust scrolling speed as needed

// Function to automatically scroll the dashboard container
function autoScroll() 
{
    // Check if scrolling is needed
    if (cardContainer.scrollWidth > cardContainer.clientWidth) 
    {
        // Calculate the width of a single card (adjust as needed based on your card size)
        const cardWidth = 150; // Adjust as needed

        // Calculate the total width of all cards in the container
        const totalWidth = cardContainer.scrollWidth;

        // Calculate the remaining width to be scrolled
        const remainingWidth = totalWidth - cardContainer.scrollLeft - cardContainer.clientWidth;

        // Scroll the container by a small increment
        if (remainingWidth > 0) 
        {
            cardContainer.scrollLeft += 1; // Adjust scrolling direction and speed as needed
            setTimeout(autoScroll, scrollSpeed); // Repeat the scrolling process
        }
        else 
        {
            // Reset scroll position to the beginning to create continuous scrolling effect
            cardContainer.scrollLeft = 0;
            setTimeout(autoScroll, 1000); // Wait for 1 second before restarting scrolling
        }
    }
    else 
    {
        // No scrolling needed, wait for 1 second before checking again
        setTimeout(autoScroll, 1000);
    }
}

// Start automatic scrolling when the page loads
window.onload = function() 
{
  // Append cards dynamically (replace this with your actual card data)
  for (let i = 1; i <= 10; i++)
  {
        cardContainer.innerHTML += "<div class='card'>Card " + i + "</div>";
  }  
  // Start automatic scrolling
  autoScroll();
};

</script>

</body>
</html>
