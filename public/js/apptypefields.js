function generateTicketId(baseUrl, apptype) {
    $.ajax({
        type: "get",
        url: `${baseUrl}/requests/generateticketid?apptype=${apptype}`,
        success: function (response) {
            $("#ticket_id").val(response);
        },
    });
}

function getRequestTypes(baseUrl, apptype) {
    $.ajax({
        type: "get",
        url: `${baseUrl}/requests/getrequesttypes?apptype=${apptype}`,
        success: function (response) {
            $("#request_type").html(
                "<option selected disabled>Select Request Type</option>"
            );
            $.each(response, function (key, value) {
                $("#request_type").append(
                    '<option value="' +
                        value.id +
                        '">' +
                        value.description +
                        "</option>"
                );
            });
        },
    });
}

function showAppTypeFields() {
    const value = $("#application_type").val();
    const accountfields = $(".accountfields");
    const hrisfields = $(".hrisfields");

    if (value === "1") {
        hrisfields.attr("hidden", false);
        accountfields.attr("hidden", true);
    }

    if (value === "2") {
        hrisfields.attr("hidden", true);
        accountfields.attr("hidden", false);
    }

    if (value === "3") {
        hrisfields.attr("hidden", true);
        accountfields.attr("hidden", true);
    }
}

function getRequestStatusValue() {
    const applicationTypeVal = $("#application_type").val();
    const status = $("#status_id");

    if (applicationTypeVal === "1") status.val("32");
    if (applicationTypeVal === "2") status.val("20");
}

$("#application_type").on("change", function () {
    const value = $(this).val();
    generateTicketId(baseUrl, value);
    getRequestTypes(baseUrl, value);
    showAppTypeFields();
    getRequestStatusValue();
});

// on page load
getRequestTypes(baseUrl, $("#application_type").val());
showAppTypeFields();
