$(document).ready(function () {
    function generateCalendar() {
        const currentDate = new Date();
        let currentYear = currentDate.getFullYear();
        let currentMonthIndex = currentDate.getMonth();
        const buttonSave = document.querySelector('.save-button');
        const calendarDays = document.querySelector('.calendar-days');
        const currentMonth = document.querySelector('#currentMonth');
        const prevMonthBtn = document.querySelector('#prevMonth');
        const nextMonthBtn = document.querySelector('#nextMonth');
        const selectedDatesTableBody = document.querySelector('#selectedDatesTableBody');
        let selectedDate = null;
        let selectedTimeSelector = null;
        let count = 0;

        const months = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        const weekdays = [
            'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
        ];

        const week = [
            'Dom', 'Lun', 'Mar', 'Miér', 'Jue', 'Vie', 'Sáb'
        ];

        function updateCalendar() {
            const firstDayOfMonth = new Date(currentYear, currentMonthIndex, 1);
            const lastDayOfMonth = new Date(currentYear, currentMonthIndex + 1, 0);
            const lastDayOfPrevMonth = new Date(currentYear, currentMonthIndex, 0).getDate();

            currentMonth.textContent = `${months[currentMonthIndex]} ${currentYear}`;
            calendarDays.innerHTML = '';

            /*for (let i = 0; i <= week.length(); i++) {
                const day = document.createElement('div');
                day.classList.add('calendar-day');
                day.textContent = week[i];
                calendarDays.appendChild(day);
            }*/

            // Rellenar días del mes anterior
            for (let i = firstDayOfMonth.getDay(); i > 0; i--) {
                const day = document.createElement('div');
                day.classList.add('calendar-day', 'disabled');
                day.setAttribute('value', -1);
                day.textContent = lastDayOfPrevMonth - (i - 1);
                calendarDays.appendChild(day);
            }

            // Rellenar días del mes actual
            for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
                const day = document.createElement('div');
                day.classList.add('calendar-day');
                day.textContent = i;
                calendarDays.appendChild(day);
            }

            // Rellenar días del mes siguiente
            for (let i = 1; i < 6; i++) {
                const day = document.createElement('div');
                day.classList.add('calendar-day', 'disabled');
                day.setAttribute('value', -1);
                day.textContent = i;
                calendarDays.appendChild(day);
            }
        }




        function updateTime() {
            const timeSelector = document.querySelector('.cs-form');
            const entrada = timeSelector.querySelector('#entrada').value;
            const salida = timeSelector.querySelector('#salida').value;

            //console.log('Hora de entrada:', entrada);
            //console.log('Hora de salida:', salida);

            if (entrada !== '' && salida !== '' && selectedDate !== null) {

                const dayOfWeek = weekdays[selectedDate.getDay()];
                const day = selectedDate.getDate();
                const month = months[selectedDate.getMonth()];
                const year = selectedDate.getFullYear();

                const rowData = document.createElement('tr');
                rowData.setAttribute('id', "cell-"+count);
                const dayOfWeekCell = document.createElement('td');
                const dayCell = document.createElement('td');
                const monthCell = document.createElement('td');
                const yearCell = document.createElement('td');
                const entradaCell = document.createElement('td');
                const salidaCell = document.createElement('td');

                dayOfWeekCell.textContent = dayOfWeek;
                dayCell.textContent = day;
                monthCell.textContent = month;
                yearCell.textContent = year;
                entradaCell.textContent = entrada;
                salidaCell.textContent = salida;

                rowData.appendChild(dayOfWeekCell);
                rowData.appendChild(dayCell);
                rowData.appendChild(monthCell);
                rowData.appendChild(yearCell);
                rowData.appendChild(entradaCell);
                rowData.appendChild(salidaCell);

                selectedDatesTableBody.appendChild(rowData);
                count++;
            } 
        }

        calendarDays.addEventListener('click', function (event) {
            const selectedDay = event.target;
            selectedDate = new Date(currentYear, currentMonthIndex, selectedDay.textContent);
            const selectedValue = selectedDay.getAttribute('value');

            if (selectedValue !== '-1') {
                // Ejemplo: Mostrar fecha seleccionada en la consola
                //console.log(selectedDate.toDateString());

                // Ejemplo: Aplicar estilo a la fecha seleccionada
                const allDays = document.querySelectorAll('.calendar-day');
                allDays.forEach(day => day.classList.remove('selected'));
                selectedDay.classList.add('selected');

                const date = document.querySelector('#date');
                date.textContent = selectedDate.toDateString();
            }
        });


        buttonSave.addEventListener('click', updateTime);

        prevMonthBtn.addEventListener('click', function () {
            currentMonthIndex--;
            if (currentMonthIndex < 0) {
                currentMonthIndex = 11;
                currentYear--;
            }
            updateCalendar();


        });

        nextMonthBtn.addEventListener('click', function () {
            currentMonthIndex++;
            if (currentMonthIndex > 11) {
                currentMonthIndex = 0;
                currentYear++;
            }
            updateCalendar();
        });

        updateCalendar();
    }

    generateCalendar();
});