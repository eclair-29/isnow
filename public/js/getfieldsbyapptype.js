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

$("#application_type").on("change", function () {
    const value = $(this).val();
    generateTicketId(baseUrl, value);
    getRequestTypes(baseUrl, value);
    showAppTypeFields();
});

// on page load
getRequestTypes(baseUrl, $("#application_type").val());
showAppTypeFields();
