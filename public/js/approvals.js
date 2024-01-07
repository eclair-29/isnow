function getApprovalsTable(baseUrl) {
    const currentPagePath = window.location.pathname;
    const pageTicketPath = currentPagePath.substring(
        currentPagePath.lastIndexOf("/") + 1
    );

    $.ajax({
        type: "get",
        url: `${baseUrl}/requests/getapprovalsdetails${
            currentPagePath === "/requests/create"
                ? "?accountid=" + $("#account_type").val()
                : "?requestid=" + pageTicketPath
        }`,
        success: function (response) {
            // const requestTypeVal = $("#request_type").val();
            const applicationTypeVal = $("#application_type").val();
            const tableHeader = $("#approverstable thead tr");
            const tableBody = $("#approverstable tbody tr");

            const requestDetails = response.requestDetails;
            const isAccountTypeGlobal =
                response.accountType?.type === "global" ||
                response.accountType === "global";

            // approvers for request: account application
            if (
                applicationTypeVal === "2" ||
                requestDetails?.application_type_id === 2
            ) {
                tableHeader.html(`
                    <th class="align-center" scope="col">Requestor</th>
                    <th class="align-center" scope="col">Dept. Head</th>
                    <th class="align-center" scope="col">Division Head</th>
                    <th class="align-center" scope="col">MIS Head</th>
                    ${
                        isAccountTypeGlobal &&
                        '<th class="align-center" scope="col">President</th>'
                    } 
                    <th class="align-center" scope="col">Processed By</th>
                `);

                tableBody.html(`
                    <td>${
                        requestDetails
                            ? requestDetails.user.name
                            : response.user.name ?? "N/A"
                    }</td>    
                    <td>${response.deptHead?.user.name ?? "N/A"}</td>    
                    <td>${response.divisionHead?.user.name ?? "N/A"}</td>    
                    <td>${response.isHead?.user.name ?? "N/A"}</td>   
                    ${
                        isAccountTypeGlobal &&
                        `<td>${response.president?.user.name ?? "N/A"}</td>`
                    } 
                    <td>IS Officer</td>
                `);

                // if (
                //     response.accountType?.type === "global"
                //     // || response.requestDetails?.request_type_id === 4
                // ) {
                //     tableHeader.append(
                //         '<th class="align-center" scope="col">Proceessed By</th>'
                //     );
                //     tableBody.append(`<td>N/A</td>`);
                // }
            }
        },
    });
}

$("#account_type").on("change", function () {
    getApprovalsTable(baseUrl);
});

getApprovalsTable(baseUrl);
