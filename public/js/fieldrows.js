$("#account_type").on("change", function () {
    // sap
    const sapRoleFields = $("#sap_role_fields");
    const sapRoleFieldBase = $("#sap_role_field_base");

    // salesforce
    const salesforceProfileFields = $("#salesforce_profile_fields");
    const salesforceProfileFieldBase = $("#salesforce_profile_field_base");

    if ($(this).val() === "3") {
        // unhide Sap Role Field
        sapRoleFieldBase.attr("hidden", false);
        sapRoleFields.attr("hidden", false);

        // hide Salesforce Field
        salesforceProfileFieldBase.attr("hidden", true);
        salesforceProfileFields.attr("hidden", true);
    } else if ($(this).val() === "2") {
        // hide Sap Role field
        sapRoleFields.attr("hidden", true);
        sapRoleFieldBase.attr("hidden", true);

        // unhide Salesforce field
        salesforceProfileFieldBase.attr("hidden", false);
        salesforceProfileFields.attr("hidden", false);
    } else {
        // hide all
        sapRoleFieldBase.attr("hidden", true);
        sapRoleFields.attr("hidden", true);
        salesforceProfileFieldBase.attr("hidden", true);
        salesforceProfileFields.attr("hidden", true);
    }
});

$("body").on("click", ".add-field", function (event) {
    const sapRoleFields = $("#sap_role_fields");
    const accountTypeVal = $("#account_type").val();

    const sapRoleClass = $(".delete-field").prev().attr("class");
    sapRoleFields.append($("#sap_role_field_base").html());

    if (sapRoleClass.includes("delete-feedback")) {
        current
            .prev()
            .attr("class", sapRoleClass.replace("delete-feedback", ""));
    }
});

$("body").on("click", ".delete-field", function (event) {
    const sapRoleClass = $(this).prev().attr("class");
    const current = $(this);

    if (current) {
        if (sapRoleClass.includes("delete-feedback")) {
            current
                .prev()
                .attr("class", sapRoleClass.replace("delete-feedback", ""));
        } else {
            current
                .prev()
                .attr("class", sapRoleClass.concat(" delete-feedback", ""));
        }
    } else $(".delete-field").prev().attr("class", "form-control custom-select");
});
