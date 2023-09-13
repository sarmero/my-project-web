$(document).ready(function () {
    $('#calendar').change(function () {
        var calendar = $(this).val();

        // Vaciar la lista de ciudades y barrios
        $('#program').html('<option value="">Choose...</option>');
        $('#pensum').html('<option value="">Choose...</option>');
        $('#semester').html('<option value="">Choose...</option>');
        $('#state').html('<option value="">Choose...</option>');
        $('#region').html('<option value="">Choose...</option>');
        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');

        if (calendar !== '') {
            $.ajax({
                url: '../services/obtain_program.php',
                type: 'POST',
                data: { calendar: calendar },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#program').html('<option value="">Choose...</option>');
                        $.each(response, function (index, program) {
                            $('#program').append('<option value="' + program.id + '">' + program.profession + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    $('#program').change(function () {
        var program = $(this).val();

        // Vaciar la lista de barrios
        $('#pensum').html('<option value="">Choose...</option>');
        $('#semester').html('<option value="">Choose...</option>');
        $('#state').html('<option value="">Choose...</option>');
        $('#region').html('<option value="">Choose...</option>');
        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');

        if (program !== '') {
            $.ajax({
                url: '../services/obtain_pensum_program.php',
                type: 'POST',
                data: { program: program },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#pensum').html('<option value="">Choose...</option>');
                        $.each(response, function (index, pensum) {
                            $('#pensum').append('<option value="' + pensum.id + '">' + pensum.description + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });


    $('#pensum').change(function () {
        var pensum = $(this).val();

        // Vaciar la lista de ciudades y barrios
        $('#semester').html('<option value="">Choose...</option>');
        $('#state').html('<option value="">Choose...</option>');
        $('#region').html('<option value="">Choose...</option>');
        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');

        if (pensum !== '') {

            $.ajax({
                url: '../services/obtain_state.php',
                type: 'POST',
                data: { pensum: pensum },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#state').html('<option value="">Choose...</option>');
                        $.each(response, function (index, state) {
                            $('#state').append('<option value="' + state.id + '">' + state.state + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });

        }
    });


    $('#state').change(function () {
        var state = $(this).val();
        $('#region').html('<option value="">Choose...</option>');
        $('#semester').html('<option value="">Choose...</option>');
        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');


        if (state !== '') {
            $.ajax({
                url: '../services/obtain_region.php',
                type: 'POST',
                data: { state: state },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#region').html('<option value="">Choose...</option>');
                        $.each(response, function (index, region) {
                            $('#region').append('<option value="' + region.id + '">' + region.region + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    $('#region').change(function () {
        var reg = $(this).val();

        // Vaciar la lista de ciudades y barrios
        $('#semester').html('<option value="">Choose...</option>');
        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');

        if (reg !== '') {
            $.ajax({
                url: '../services/obtain_semester.php',
                type: 'POST',
                data: { reg: reg },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#semester').html('<option value="">Choose...</option>');
                        $.each(response, function (index, semester) {
                            $('#semester').append('<option value="' + semester.id + '">' + semester.semester + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    $('#semester').change(function () {
        var semester = $(this).val();
        var region = $('#region').val();
        var pensum = $('#pensum').val();
        var calendar = $('#calendar').val();

        if (semester !== '') {

            $.ajax({
                url: '../services/obtain_calendar.php',
                type: 'POST',
                data: { semester: semester, region: region, pensum: pensum, calendar: calendar },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');
                        calendarLista(response);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    function calendarLista(response) {
        const selectedDatesTableBody = document.querySelector('#selectedDatesTableBody');
        let ban;
        let l = 0;
        while (response.length !== 0) {

            let n = response[0][5];
            let arr = [];
            let idx = [];

            for (let i = 0; i < response.length; i++) {

                if (response[i][5] !== 0) {
                    if (response[i][5] >= n) {
                        arr.push(response[i][5]);
                        console.log(response[i][5]);
                        idx.push(i);
                    } else {
                        break;
                    }

                    n = response[i][5];

                } else {
                    response.splice(i, 1);
                    i--;
                }
            }

            console.log("");

            const frecuencia = {};

            // Recorrer el array y contar la frecuencia de cada número
            arr.forEach((num) => {
                frecuencia[num] = (frecuencia[num] || 0) + 1;
            });

            // Encontrar el número con la mayor frecuencia
            let numMasRepetido;
            let maxFrecuencia = 0;
            for (const num in frecuencia) {
                if (frecuencia[num] > maxFrecuencia) {
                    maxFrecuencia = frecuencia[num];
                    numMasRepetido = num;

                }
            }

            let fil = maxFrecuencia;

            l++;

            const ind = document.createElement('td');
            ind.classList.add('align-middle');
            ind.classList.add('text-center');
            ind.setAttribute('scope', 'row');
            ind.setAttribute('rowspan', fil);
            ind.setAttribute('style', "color:white;");
            ind.textContent = l;

            console.log("semana: " + l + " filas: " + fil);

            let elemt = [];

            for (let f = 0; f < fil; f++) {
                const rowData = document.createElement('tr');

                if (f === 0) {
                    rowData.appendChild(ind);
                }

                for (let i = 1; i <= 7; i++) {
                    const dat = document.createElement('td');
                    ban = false;

                    for (let k = 0; k < arr.length; k++) {

                        if (arr[k] === i) {
                            const end = response[idx[k]][4].slice(0, 5);
                            const star = response[idx[k]][3].slice(0, 5);

                            dat.innerHTML = `
                                                <ul class="list-unstyled"> 
                                                    <li style = "color: #cdfeaa;font-size:70%;"> ${response[idx[k]][1]} </li>
                                                    <li  style = "color: ##28a745; font-size:70%;">${star} - ${end} H</li>
                                                    <li  style = "color: #66ced6;">${response[idx[k]][0]}</li>
                                                    <li style = "color: #cdfeaa;font-size:90%;">${response[idx[k]][2]}</li>
                                                </ul> `;

                            ban = true;
                            arr[k] = 0;
                            break;
                        }

                    }


                    if (ban === false) {
                        dat.innerHTML = `
                                        <ul class="list-unstyled"> 
                                            <li style = "color: #cdfeaa;"></li>
                                            <li  style = "color: #66ced6;"></li>
                                            <li style = "color: #cdfeaa;"></li>
                                        </ul> `;
                    }

                    rowData.appendChild(dat);
                }

                idx.forEach((num) => {
                    response[num][5] = 0;
                });

                selectedDatesTableBody.appendChild(rowData);
            }

        }
    }

});