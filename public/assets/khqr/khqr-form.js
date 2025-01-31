const urlParams = new URLSearchParams(window.location.search);
const hashParam = urlParams.get('hash');

// Function to extract URL parameters
function getURLParameter(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Extract Amount from URL parameter
var amountParam = getURLParameter('amount');
var amountElement = document.querySelector('.home-amount');
if (amountParam) {
    amountElement.textContent = amountParam;
}

// Display Countdown Timer
var minutesElement = document.querySelector('.home-minutes');
var countdownTime = 180; // 3 minutes in seconds

function updateCountdown(countdownTime_=null) {
    if (countdownTime_) countdownTime = countdownTime_;
    var minutes = Math.floor(countdownTime / 60);
    var seconds = countdownTime % 60;
    minutesElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
    countdownTime--;
    if (countdownTime < 0) {
        clearInterval(countdownInterval);
        minutesElement.textContent = '0:00'; // Display 0:00 after countdown ends
        $('body').removeClass("modal-open");

        window.location.reload();
    }
}

function generateQRCode(qrData) {
    var qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=190x190&data=${qrData}`;
    return qrUrl;
}
var countdownInterval = setInterval(updateCountdown, 1000); // Update every second
