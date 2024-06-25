document.addEventListener('DOMContentLoaded', function() {
    fetchLeaveBalance();
});

function fetchLeaveBalance() {
    fetch('fetch_leave_balance.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched leave balance:', data); // Debug: Log fetched data
            updateLeaveBalance(data);
        })
        .catch(error => console.error('Error fetching leave balance:', error));
}

function updateLeaveBalance(data) {
    const annualLeaveBalance = document.getElementById('annual-leave-balance');
    const sickLeaveBalance = document.getElementById('sick-leave-balance');
    const maternityLeaveBalance = document.getElementById('maternity-leave-balance');
    const familyLeaveBalance = document.getElementById('family-leave-balance');
    const bereavementLeaveBalance = document.getElementById('bereavement-leave-balance');

    annualLeaveBalance.textContent = `${data.annual_leave_used}/${data.annual_leave_total} days`;
    sickLeaveBalance.textContent = `${data.sick_leave_used}/${data.sick_leave_total} days`;
    maternityLeaveBalance.textContent = `${data.maternity_leave_used}/${data.maternity_leave_total} days`;
    familyLeaveBalance.textContent = `${data.family_leave_used}/${data.family_leave_total} days`;
    bereavementLeaveBalance.textContent = `${data.bereavement_leave_used}/${data.bereavement_leave_total} days`;
}
