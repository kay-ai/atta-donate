$(document).ready(function () {
    // 1. Handle clicking on a suggested amount
    $(".money").click(function () {
        var amount = $(this).data("amount");

        if (amount) {
            $("#amount").val(amount);
        } else {
            $("#amount").val("");
            $("#amount").focus();
        }
    });

    // 2. Handle donation type selection
    $("#donate_type").change(function () {
        if ($(this).val() === "financial") {
            $("#amountField").removeClass("d-none");
            $("#moneyDiv").addClass('d-flex');
            $("#moneyDiv").slideDown(200);

            $("#messageField").addClass("d-none");
        } else {
            $("#amountField").addClass("d-none");
            $("#moneyDiv").removeClass('d-flex');
            $("#moneyDiv").slideUp();
            $("#messageField").removeClass("d-none");
        }

        if ($(this).val() === "it-equipment") {
            $("#addLocation").removeClass("d-none");
        }else{
            $("#addLocation").addClass("d-none");
        }
    });

    // 3. Handle form submission logic
    $("#donationForm").submit(function (event) {
        if ($("#donate_type").val() === "financial") {
            event.preventDefault();
            initiatePaystackPayment();
        }
    });

    $("#support_type").change(function () {
        if ($(this).val() === "laptop") {
            $("#areaOfInterest").addClass("d-none");
            $("#cvField").addClass("d-none");
            $("#institutionField").removeClass("d-none");
        } else {
            $("#areaOfInterest").removeClass("d-none");
            $("#cvField").removeClass("d-none");
            $("#institutionField").addClass("d-none");
        }
    });
});
