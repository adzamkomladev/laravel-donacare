import { eventBus } from "../events/event-bus";

export default class Paystack {
    static showNotification(icon, message, type) {
        $.notify({ icon, message }, { type, timer: 2500 });
    }

    static save(donationData) {
        var handler = PaystackPop.setup({
            key: donationData.paystackPublicKey,
            currency: "GHS",
            email: donationData.email,
            amount: 1,
            ref: "" + Math.floor(Math.random() * 1000000000 + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            metadata: {
                custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: donationData.phone
                    }
                ]
            },
            callback: async response => {
                console.log({ response });
                alert("success. transaction ref is " + response.reference);
                return;

                try {
                    const { data } = await Donation.save(donationData.donationFormData);

                    setTimeout(
                        () =>
                            (window.location.pathname = `/donations/${data.donationId}`),
                        3100
                    );
                } catch (error) {
                    console.log({ error });

                    const errors = error?.response?.data?.errors;

                    const [errorMessage] = Object.values(errors || {})[0] || [
                        "Failed to make donation request!"
                    ];

                    Paystack.showNotification(
                        "fas fa-times",
                        errorMessage,
                        "danger"
                    );
                }
            },
            onClose: function() {
                alert("window closed");
            }
        });

        handler.openIframe();
    }
}
