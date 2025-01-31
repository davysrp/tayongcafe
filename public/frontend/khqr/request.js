
    const {BakongKHQR, khqrData, MerchantInfo} = window.BakongKHQR;
    const {SourceInfo} = window.BakongKHQR;

    function generateKhqr(amountData,merchantInfoData,optionalData_) {


        const {BakongKHQR, khqrData, MerchantInfo} = window.BakongKHQR;
        const {SourceInfo} = window.BakongKHQR;

        const merchantInfo = {
            bakongAccountID: merchantInfoData.bakongAccountID,
            merchantName:merchantInfoData.merchantName,
            merchantCity: merchantInfoData.merchantCity,
            merchantId: merchantInfoData.merchantId,
            acquiringBank: merchantInfoData.acquiringBank,
        };

        // Get amount and user from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const amount = amountData ? amountData: 0.01; // default value if not provided
        const user = urlParams.get('userid') || 'defaultUser'; // default value if not provided

        const optionalData = {
            currency: khqrData.currency.usd,
            amount: amount,
            mobileNumber: optionalData_.mobileNumber,
            billNumber: optionalData_.billNumber,
            storeLabel:optionalData_.storeLabel,
            terminalLabel: optionalData_.terminalLabel,
        };

        function generateBillNumber() {
            return "INV-" + new Date().toISOString().replace(/[-:.TZ]/g, "");
        }

        const merchantInfoInstance = new MerchantInfo(
            merchantInfo.bakongAccountID,
            merchantInfo.merchantName,
            merchantInfo.merchantCity,
            merchantInfo.merchantId,
            merchantInfo.acquiringBank,
            optionalData
        );

        const khqr = new BakongKHQR();
        const response = khqr.generateMerchant(merchantInfoInstance);

        const khqrString = response.data.qr;
        const sourceInfo = new SourceInfo(
            "https://bakong.nbc.gov.kh/images/logo.svg",
            "KHMMO.COM",
            "http://bakong.nbc.gov.kh");
        const deeplink = BakongKHQR.generateDeepLink(
            "https://api-bakong.nbc.gov.kh/v1/generate_deeplink_by_qr",
            khqrString,
            sourceInfo
        );
        deeplink.then((data) => {
            if (data.status.code == 0) {
                console.log(data.data.shortLink);
            } else {
                console.log(data.status.message);
            }
        });



        return {
            'md5':response.data.md5,
            'amount':amount,
            'qr':response.data.qr,
            'invoice':optionalData_.invoice
        }
    }

    function generateBillNumber() {
        return "INV-" + new Date().toISOString().replace(/[-:.TZ]/g, "");
    }
