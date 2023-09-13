$(document).ready(function () {
    let offer = "";


    function saveData() {
        const rows = document.querySelectorAll('#selectedDatesTableBody tr');
        let n = 0;

        rows.forEach(row => {
            let data = document.getElementById("cell-" + n);
            let dt = data.getElementsByTagName("td");
            //console.log(dt);

            const dayWeek = weekDay(dt[0].innerText);

            const day = dt[1].innerText;
            const month =  mont(dt[2].innerText);
            const year = dt[3].innerText;

            const date = day + '-' + month + '-' + year;
            const star = dt[4].innerText + ":00";
            const end = dt[5].innerText + ":00";

            /*console.log("dia de la semana: " + dayWeek);
            console.log("date: " + date);
            console.log("star: " + star);
            console.log("");*/

            n++;

            $.ajax({
                url: '../services/save_date_calendar.php',
                method: 'POST',
                data: { dayWeek: dayWeek, date: date, star: star, end: end, offer: offer },
                dataType: 'json',
                success: function (response) {
                    //alert("pausa");
                    console.log(response.message);
                },
                error: function (xhr, status, error) {
                    console.log('Error al guardar los datos:', error);
                    window.location.href = "/Academy/pages/calendar_error.php";
                }
            });

        });

    }

    function saveProgramming() {
        offer = document.querySelector('#subject').value;
        const teacher = document.querySelector('#teacher').value;
        console.log(offer + " - " + teacher);

        $.ajax({
            url: '../services/save_programming.php',
            method: 'POST',
            data: { offer: offer, teacher: teacher },
            dataType: 'json',
            success: function (response) {
                //alert(response.message);
                if (response.success === true) {
                    saveData();
                    window.location.href = "/Academy/pages/calendar_listx.php";
                }
            },
            error: function (xhr, status, error) {
                console.log('Error al guardar los datos:', error);
                window.location.href = "/Academy/pages/calendar_error.php";
            }
        });
    }

    function weekDay(day) {
        for (let i = 0; i < weekdays.length; i++) {
            if (day === weekdays[i]) {
                return i+1;
            }
        }
        return 7;
    }

    function mont(mon) {
        for (let i = 0; i < months.length; i++) {
            if (mon === months[i]) {
                return i+1;
            }
        }
        return 12;
    }

    const weekdays = [
        'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
    ];

    const months = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    

    // Evento de clic en el botón de guardar
    const saveButton = document.querySelector('.btn');
    saveButton.addEventListener('click', saveProgramming);
});
