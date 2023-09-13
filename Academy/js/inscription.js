$(document).ready(function () {
    $('#calendar').change(function () {
        var calendar = $(this).val();

        // Vaciar la lista de ciudades y barrios
        $('#program').html('<option value="">Choose...</option>');
        $('#pensum').html('<option value="">Choose...</option>');
        $('#semester').html('<option value="">Choose...</option>');
        $('#subject').html('<option value="">Choose...</option>');
        $('#state').html('<option value="">Choose...</option>');
        $('#region').html('<option value="">Choose...</option>');

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
        $('#subject').html('<option value="">Choose...</option>');
        $('#state').html('<option value="">Choose...</option>');
        $('#region').html('<option value="">Choose...</option>');

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
        $('#subject').html('<option value="">Choose...</option>');
        $('#state').html('<option value="">Choose...</option>');
        $('#region').html('<option value="">Choose...</option>');

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

        $('#semester').html('<option value="">Choose...</option>');
        $('#region').html('<option value="">Choose...</option>');
        $('#subject').html('<option value="">Choose...</option>');

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

        $('#subject').html('<option value="">Choose...</option>');
        $('#semester').html('<option value="">Choose...</option>');

        if (reg !== '') {

            $.ajax({
                url: '../services/obtain_semester.php',
                type: 'POST',
                data: { region: reg },
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
        var sem = $(this).val();
        var pen = $('#pensum').val();
        var reg = $('#region').val();
        var cal = $('#calendar').val();

        $('#subject').html('<option value="">Choose...</option>');
        

        if (semester !== '') {

            $.ajax({
                url: '../services/obtain_offer.php',
                type: 'POST',
                data: { pensum: pen, semester: sem, region: reg, calendar: cal},
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#subject').html('<option value="">Choose...</option>');
                        $.each(response, function (index, subject) {
                            $('#subject').append('<option value="' + subject.id + '">' + subject.subject + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }


    });

    $('#subject').change(function () {
        var sub = $(this).val();
        var pen = $('#pensum').val();
        var sem = $('#semester').val();
        var cal = $('#calendar').val();
        var reg = $('#region').val();

        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');

        if (sub !== '') {

            $.ajax({
                url: '../services/obtain_inscriptions.php',
                type: 'POST',
                data: { pensum: pen, semester: sem, region: reg, calendar: cal, subject: sub },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');
                        if (response.length > 0) {
                            ontain_data_table(response);
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }


    });

    function ontain_data_table(response) {
        const selectedDatesTableBody = document.querySelector('#selectedDatesTableBody');

        $.each(response, function (index, inscription) {

            const rowData = document.createElement('tr');
            const ind = document.createElement('td');
            ind.setAttribute('style', "color:white;");
            const usr = document.createElement('td');
            usr.setAttribute('style', "color:white;");
            const name = document.createElement('td');
            name.setAttribute('style', "color:white;");
            const last = document.createElement('td');
            last.setAttribute('style', "color:white;");

            ind.textContent = index + 1;
            usr.textContent = inscription.usrname;
            name.textContent = inscription.first_name;
            last.textContent = inscription.last_name;

            rowData.appendChild(ind);
            rowData.appendChild(usr);
            rowData.appendChild(name);
            rowData.appendChild(last);


            selectedDatesTableBody.appendChild(rowData);
        });
    }


});