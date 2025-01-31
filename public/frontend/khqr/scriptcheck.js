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

// Extract QR Code Data from URL parameter
var qrParam = getURLParameter('qr');
var qrImageElement = document.querySelector('.home-image');
if (qrParam) {
    generateQRCode(qrParam); // Call the function to generate QR code
} else {
    // If qrParam is not present, redirect to the dashboard
    navigateToURL('https://www.khmerboost.xyz/');
}

// Display Countdown Timer
var minutesElement = document.querySelector('.home-minutes');
var countdownTime = 180; // 3 minutes in seconds

function updateCountdown() {
    var minutes = Math.floor(countdownTime / 60);
    var seconds = countdownTime % 60;
    minutesElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

    countdownTime--;
    if (countdownTime < 0) {
        clearInterval(countdownInterval);
        minutesElement.textContent = '0:00'; // Display 0:00 after countdown ends
        window.location.href = 'https://www.khmerboost.xyz/profile'; // Redirect when countdown ends
    }
}

function navigateToURL(url) {
    // Redirect to the specified URL
    window.location.href = url;
}

function generateQRCode(qrData) {
    var qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=190x190&data=${qrData}`;
    qrImageElement.setAttribute('src', qrUrl);
}

var countdownInterval = setInterval(updateCountdown, 1000); // Update every second

async function refreshPageContent() {
    const urlParams = new URLSearchParams(window.location.search);
    const md5Param = urlParams.get('md5');
    const useridParam = urlParams.get('userid'); // Get userid from URL parameter

    if (md5Param) {
        let intervalId; // Variable to store the interval ID

        async function checkTransaction() {
            const response = await fetch('https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE3MTAwNDk1OTEsImlhdCI6MTcwMjAxNDM5MSwiZGF0YSI6eyJpZCI6IjUzNDFkMDJhZWZlYjQ1NyJ9fQ.fkbmEBUieYe-6b2HY3RKa2SH6D8ZXOcrIf51RhijFVw'
                },
                body: JSON.stringify({ "md5": md5Param })
            });

            const responseData = await response.json();

            if (responseData.responseCode === 0) {
                // Use the amount value from the response
                const amountFromResponse = responseData.data.amount;

                // Redirect to done.php with parameters
                const doneUrl = `savemd5.php?md5=${md5Param}&userid=${useridParam}&amount=${amountFromResponse}`;
                window.location.href = doneUrl;

                // Clear the interval when the response code is 0
                clearInterval(intervalId);
            }
        }

        // Start the interval and store the interval ID
        intervalId = setInterval(checkTransaction, 5000);
    } else {
        console.log('MD5 parameter is missing from the URL.');
    }
}

// Call the function to initiate the process
refreshPageContent();
