function initiatePaystackPayment() {

    var handler = PaystackPop.setup({
        key: 'pk_test_dce0a18f6881f4af3f06533133141f7588a8ffd6',
        email: $("#email").val(),
        amount: $("#amount").val() * 100,
        currency: "NGN",
        callback: function (response) {
            console.log(response);
            if (response.status && response.status == "success") {

                let data = {
                    reference: response.reference,
                    first_name: $("#first_name").val(),
                    last_name: $("#last_name").val(),
                    email: $("#email").val(),
                    phone: $("#phone").val(),
                    donation_type: $("#donate_type").val(),
                }

                verifyPayment(response.reference, data);

            } else {
                swal("Payment Failed", "Error occurred while processing your payment.", "error");
            }
        },
        onClose: function () {
            alert('Payment window closed.');
        }
    });

    handler.openIframe();
}

function verifyPayment(trnx_ref, data) {
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    console.log('data', data)

    $.ajax({
        url: "/verify-payment",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: JSON.stringify(data),
        contentType: "application/json",
        dataType: "json",
        beforeSend: function () {
            console.log('Verifying payment for:', trnx_ref);
            swal({
                title: "Processing...",
                text: "Please wait",
                showConfirmButton: false,
                allowOutsideClick: false
            });
        },
        success: function (response) {
            handlePaymentResponse(response);
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", xhr.responseText);
            swal("Error", "Could not verify payment. Please contact support.", "error");
        }
    });
}

function handlePaymentResponse(response) {
    if (response.success) {
        let message = response.is_returning_donor ?
            "Thank you for your continued support!" :
            "Your account has been created, check your email for details.";

        console.log('redirect_url', response.redirect_url);
        swal({
            title: "Payment Successful",
            text: message,
            type: "success"
        }, function() {
            window.location.href = response.redirect_url;
        });
    } else {
        swal("Payment Failed", response.message, "error");
    }
}
