$("#approve_btn").on("click", function (event) {
    // event.preventDefault();
    const notes = prompt("Please enter your notes:", "Approved");

    if (notes) {
        $("#approved_notes").val(notes);
    }
});

$("#reject_btn").on("click", function (event) {
    // event.preventDefault();
    let notes;

    while (!notes) {
        notes = prompt("Please enter your notes:");
    }

    $("#rejected_notes").val(notes);
});
