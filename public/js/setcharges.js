$("#account_type").on("change", function () {
    const selectedText = $("#account_type").find(":selected").text();
    const charge = $("#account_type")
        .find(":selected")
        .text()
        .substring(selectedText.indexOf("¥"), selectedText.length - 1);

    $("#charges").val(charge);
});
