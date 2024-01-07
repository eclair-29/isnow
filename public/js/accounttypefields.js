const requestType = $("#request_type");
const accountType = $("#account_type");

const sapRoles = $("#sap_roles");
const existingSalesforce = $("#existing_salesforce_subtypes");
const salesforce = $("#salesforce_subtypes");

function showSubTypes() {
    switch (true) {
        case requestType.val() === "4" && accountType.val() === "3": // [New and SAP]
            salesforce.attr("hidden", true);
            existingSalesforce.attr("hidden", true);
            sapRoles.attr("hidden", false);
            break;
        case requestType.val() === "6" && accountType.val() === "3": // [Delete and SAP]
            //
            break;
        case requestType.val() === "4" && accountType.val() === "2": // [New and Salesforce]
            salesforce.attr("hidden", false);
            existingSalesforce.attr("hidden", true);
            sapRoles.attr("hidden", true);
            break;
        case requestType.val() === "5" && accountType.val() === "2": // [Edit and Salesforce]
            existingSalesforce.attr("hidden", false);
            salesforce.attr("hidden", false);
            break;
        default:
            sapRoles.attr("hidden", true);
            existingSalesforce.attr("hidden", true);
            salesforce.attr("hidden", true);
            break;
    }
}

function hideDelFieldBtn() {
    const sapDelFieldBtn = sapRoles.find(".del-field");
    const salesforceDelFieldBtn = salesforce.find(".del-field");

    switch (accountType.val()) {
        case "2":
            salesforce.children(".col-6").length === 1
                ? salesforceDelFieldBtn.attr("hidden", true)
                : salesforceDelFieldBtn.attr("hidden", false);
            break;
        case "3":
            sapRoles.children(".col-6").length === 1
                ? sapDelFieldBtn.attr("hidden", true)
                : sapDelFieldBtn.attr("hidden", false);
        default:
            break;
    }
}

requestType.on("change", function () {
    $("#account_types").attr("hidden", false);
    showSubTypes();
});

accountType.on("change", function () {
    showSubTypes();
    hideDelFieldBtn();
});

const subTypeActionAdd = ".subtype-action-select .add-field";
const subTypeActionDel = ".subtype-action-select .del-field";

hideDelFieldBtn();

$("body").on("click", subTypeActionAdd, function () {
    switch (accountType.val()) {
        case "2":
            salesforce.append(
                $("#salesforce_subtypes .col-6:first-child").get(0).outerHTML
            );
            break;
        case "3":
            sapRoles.append(
                $("#sap_roles .col-6:first-child").get(0).outerHTML
            );
            break;
        default:
            break;
    }

    hideDelFieldBtn();
});

$("body").on("click", subTypeActionDel, function () {
    $(this).closest(".col-6").remove();
    hideDelFieldBtn();
});
