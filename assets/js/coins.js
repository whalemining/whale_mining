document.addEventListener("DOMContentLoaded", function() {
    // Get the quest div and the claim button
    const questDiv = document.getElementById("joinTelegramQuest");
    const claimButton1 = document.getElementById("claimButton1");

    // Add a click event listener to the entire quest div
    questDiv.addEventListener("click", function() {
        // Open the Telegram channel link
        window.open("https://t.me/your_channel_link", "_blank");

        // Simulate task completion (user returns after joining Telegram)
        setTimeout(function() {
            claimButton1.removeAttribute("disabled");
        }, 2000);  // Simulating task completion after 2 seconds
    });

    // Handle claim button click
    claimButton1.addEventListener("click", function() {
        if (!claimButton1.hasAttribute("disabled")) {
            const telegram_id = "7354413313";  // Replace this with actual user telegram_id
            const task_name = "join_telegram";
            const reward = 50000;

            // Send an AJAX request to claim the reward
            fetch('update_coins.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    telegram_id: telegram_id,
                    task_name: task_name,
                    reward: reward
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert("You have claimed your 50,000 coins!");
                    claimButton1.setAttribute("disabled", true);  // Disable the claim button after claiming
                } else {
                    alert("Error claiming coins: " + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});
