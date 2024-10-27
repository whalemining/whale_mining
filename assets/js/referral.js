document.addEventListener("DOMContentLoaded", () => {
    const telegram = window.Telegram.WebApp;
    const user = telegram.initDataUnsafe.user;

    if (user) {
        const inviteButton = document.getElementById("inviteButton");
        const copyButton = document.getElementById("copyButton");

        // Ensure buttons exist before attaching event listeners
        if (!inviteButton || !copyButton) {
            console.error("Buttons are not available in the DOM");
            return;
        }

        let referralLink = ''; // This will store the referral link from the backend
        const referrerId = window.referrerId || null; // Replace with actual referrer ID logic

        // Authenticate user and get referral link from backend
        fetch('https://gope360.com/whale/telegram_auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                telegram_id: user.id,
                username: user.username || 'Anonymous',
                first_name: user.first_name || '',
                last_name: user.last_name || '',
                referrer_id: referrerId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                referralLink = data.referral_link;

                // Invite Button Functionality
                inviteButton.addEventListener("click", (event) => {
                    event.preventDefault();
                    if (referralLink) {
                        const forwardLink = `https://t.me/share/url?url=${encodeURIComponent(referralLink)}&text=${encodeURIComponent("Join using my referral!")}`;
                        telegram.openTelegramLink(forwardLink);
                        console.log("Invite button clicked! Referral link opened in Telegram.");
                    } else {
                        console.error("Referral link is missing or invalid.");
                    }
                });

                // Copy Button Functionality
                copyButton.addEventListener("click", (event) => {
                    event.preventDefault();
                    if (referralLink) {
                        copyToClipboard(referralLink);
                        console.log("Copy button clicked! Referral link copied to clipboard.");
                    } else {
                        console.error("Referral link is missing or invalid.");
                    }
                });
            } else {
                console.error('Error fetching referral link:', data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching data from backend:', error);
        });

    } else {
        document.body.innerHTML = '<h1>Unable to authenticate user. Please log in with Telegram.</h1>';
    }

    // Copy to Clipboard Function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            const copySuccess = document.getElementById("copySuccess");
            if (copySuccess) {
                copySuccess.style.display = "block";
                setTimeout(() => {
                    copySuccess.style.display = "none";
                }, 2000);
            }
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }
});