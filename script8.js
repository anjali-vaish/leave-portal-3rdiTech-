function fetchLeaveRequests() {
    fetch('fetch_leave_requests.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#leave-requests tbody');
            tableBody.innerHTML = '';

            data.forEach(request => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${request.email}</td> <!-- Changed to email -->
                    <td>${request.leave_type}</td>
                    <td>${request.start_date}</td>
                    <td>${request.end_date}</td>
                    <td class="status-cell">${request.status}</td>
                    <td>
                        <button class="approve-button" onclick="updateStatus(${request.id}, 'approved', this)">Approve</button>
                        <button class="decline-button" onclick="updateStatus(${request.id}, 'denied', this)">Deny</button>
                    </td>
                    <td>${request.reason}</td> <!-- Added reason data -->
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching leave requests:', error));
}

function updateStatus(id, status, button) {
    fetch('update_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}&status=${status}`
    })
    .then(response => response.text())
    .then(result => {
        if (result === 'success') {
            const statusCell = button.closest('tr').querySelector('.status-cell');
            statusCell.textContent = status;
            if (status === 'approved') {
                statusCell.classList.add('highlight-approved');
                statusCell.classList.remove('highlight-declined');
            } else if (status === 'denied') {
                statusCell.classList.add('highlight-declined');
                statusCell.classList.remove('highlight-approved');
            }
        } else {
            console.error('Error updating status:', result);
        }
    })
    .catch(error => console.error('Error:', error));
}

window.addEventListener('load', fetchLeaveRequests);
