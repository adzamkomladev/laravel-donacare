export default class Paystack {
    static save(data) {
        var handler = PaystackPop.setup({
            key: data.paystackPublicKey,
            currency: "GHS",
            email: data.email,
            amount: 1,
            ref: "" + Math.floor(Math.random() * 1000000000 + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            metadata: {
                custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: data.phone
                    }
                ]
            },
            callback: function(response) {
                console.log({ response });
                alert("success. transaction ref is " + response.reference);
            },
            onClose: function() {
                alert("window closed");
            }
        });

        handler.openIframe();
    }
}
