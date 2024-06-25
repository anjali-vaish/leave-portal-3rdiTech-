document.addEventListener('DOMContentLoaded', function() {
    fetchLeaveRequests();

    // Polling for updates every 30 seconds
    setInterval(fetchLeaveRequests, 30000);
});

function fetchLeaveRequests() {
    fetch('fetch_user_leave_requests.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched data:', data); // Debug: Log fetched data
            updateLeaveTable(data);
        })
        .catch(error => console.error('Error fetching leave requests:', error));
}

function updateLeaveTable(data) {
    const tableBody = document.querySelector('#leave-table tbody');
    const totalRequests = document.getElementById('total-requests');
    const approvedRequests = document.getElementById('approved-requests');
    const pendingRequests = document.getElementById('pending-requests');

    let total = 0, approved = 0, pending = 0;

    // Clear the table before repopulating
    tableBody.innerHTML = '';

    data.forEach(request => {
        total++;
        if (request.status === 'approved') approved++;
        if (request.status === 'pending') pending++;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${request.leave_type}</td>
            <td>${request.start_date}</td>
            <td>${request.end_date}</td>
            <td>${getDuration(request.start_date, request.end_date)} days</td>
            <td class="status-cell">
                <span class="status-circle ${request.status}"></span>${request.status.charAt(0).toUpperCase() + request.status.slice(1)}
            </td>
        `;
        tableBody.appendChild(row);
    });

    totalRequests.textContent = total;
    approvedRequests.textContent = approved;
    pendingRequests.textContent = pending;
}

function getDuration(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const duration = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
    return duration;
}

function sortRequests(option) {
    fetch('fetch_user_leave_requests.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            let filteredData;
            if (option === 'earliest') {
                filteredData = data.sort((a, b) => new Date(a.start_date) - new Date(b.start_date));
            } else if (option === 'latest') {
                filteredData = data.sort((a, b) => new Date(b.start_date) - new Date(a.start_date));
            } else if (option === 'approved') {
                filteredData = data.filter(request => request.status === 'approved');
            }

            updateLeaveTable(filteredData);
        })
        .catch(error => console.error('Error fetching leave requests:', error));
}
