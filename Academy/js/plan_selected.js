$(document).ready(function () {

    const currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonthIndex = currentDate.getMonth();
    const buttonSave = document.querySelector('.save-button');
    const calendarDays = document.querySelector('.calendar-days');

    const selectedDatesTableBody = document.querySelector('#selectedDatesTableBody');
    let selectedDate = null;
    let selectedTimeSelector = null;
    let count = 0;

    function updateTime() {
        const sub = document.querySelector('#subject');

        const rowData = document.createElement('tr');
        rowData.setAttribute('id', "cell-" + count);
        const index = document.createElement('td');
        const subject = document.createElement('td');

        index.textContent = count;
        subject.textContent = sub;

        rowData.appendChild(index);
        rowData.appendChild(subject);

        selectedDatesTableBody.appendChild(rowData);
        count++;
    }


    buttonSave.addEventListener('click', updateTime);

});