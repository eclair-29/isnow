function getApprovalsTable(baseUrl) {
    const currentPagePath = window.location.pathname;
    const pageTicketPath = currentPagePath.substring(
        currentPagePath.lastIndexOf("/") + 1
    );

    $.ajax({
        type: "get",
        url: `${baseUrl}/requests/getapprovalsdetails${
            currentPagePath === "/requests/create"
                ? ""
                : "?requestid=" + pageTicketPath
        }`,
        success: function (response) {
            const requestTypeVal = $("#request_type").val();
            const applicationTypeVal = $("#application_type").val();
            const tableHeader = $("#approverstable thead tr");
            const tableBody = $("#approverstable tbody tr");
            const requestDetails = response.requestDetails;

            if (
                applicationTypeVal === "2" ||
                requestDetails?.application_type_id === 2
            ) {
                tableHeader.html(`
                    <th class="align-center" scope="col">Requested By</th>
                    <th class="align-center" scope="col">Checked By</th>
                    <th class="align-center" scope="col">Noted By</th>
                    <th class="align-center" scope="col">MIS Approved By</th>
                `);

                tableBody.html(`
                    <td>${response.user.name ?? "N/A"}</td>    
                    <td>${response.deptHead.user.name ?? "N/A"}</td>    
                    <td>${response.divisionHead?.user.name ?? "N/A"}</td>    
                    <td>${response.isHead.user.name ?? "N/A"}</td>    
                `);

                if (
                    requestTypeVal === "4" ||
                    response.requestDetails?.request_type_id === 4
                ) {
                    tableHeader.append(
                        '<th class="align-center" scope="col">Proceessed By</th>'
                    );
                    tableBody.append(`<td>N/A</td>`);
                }
            }
        },
    });
}

$("#request_type").on("change", function () {
    getApprovalsTable(baseUrl);
});

getApprovalsTable(baseUrl);
