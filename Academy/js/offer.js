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



        if (pensum !== '') {
            $.ajax({
                url: '../services/obtain_semester.php',
                type: 'POST',
                data: { pensum: pensum },
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


        // Vaciar la lista de ciudades y barrios
        $('#subject').html('<option value="">Choose...</option>');
        $('#state').html('<option value="">Choose...</option>');
        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');


        if (semester !== '') {
            $.ajax({
                url: '../services/obtain_state.php',
                type: 'POST',
                data: { semester: semester },
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
        ontain_data_table();
    });

    const saveDelete = document.querySelector('.btn-secondary');
    saveDelete.addEventListener('click', delete_offer);

    const saveEdit = document.querySelector('.btn-primary');
    saveEdit.addEventListener('click', edit_offer);

    function edit_offer() {
        const code = document.querySelector('#codeEdit').value;
        var state = $('#statex').val();

        if (code !== '') {
            $.ajax({
                url: '../services/update_offer.php',
                type: 'POST',
                data: { code: code, state: state },
                dataType: 'json',
                success: function (response) {
                    alert(response.message);
                    if (response.success === true) {
                        document.getElementById("codeEdit").value = "";
                        ontain_data_table();
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error al editar los datos:', error);
                    window.location.href = "/Academy/pages/offer_error.php";
                }
            });
        }
    }

    function delete_offer() {
        const code = document.querySelector('#codeDelete').value;

        if (code !== '') {
            $.ajax({
                url: '../services/delete_offer.php',
                type: 'POST',
                data: { code: code },
                dataType: 'json',
                success: function (response) {
                    alert(response.message);
                    if (response.success === true) {
                        document.getElementById("codeDelete").value = "";
                        ontain_data_table();
                        
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error al eliminar los datos:', error);
                    window.location.href = "/Academy/pages/offer_error.php";
                }
            });
        }
    }

    function ontain_data_table() {
        var region = $('#region').val();
        var semester = $('#semester').val();
        var pensum = $("#pensum").val();
        var calendar = $("#calendar").val();
        const selectedDatesTableBody = document.querySelector('#selectedDatesTableBody');

        console.log(region + "-" + semester + "-" + pensum + "-" + calendar);

        if (region !== '') {

            $.ajax({
                url: '../services/obtain_offer.php',
                type: 'POST',
                data: { region: region, semester: semester, calendar: calendar, pensum: pensum },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.length > 0) {
                        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');
                        $.each(response, function (index, offer) {

                            const rowData = document.createElement('tr');
                            const ind = document.createElement('td');
                            ind.setAttribute('style', "color:white;");
                            const cod = document.createElement('td');
                            cod.setAttribute('style', "color:white;");
                            const sub = document.createElement('td');
                            sub.setAttribute('style', "color:white;");
                            const sta = document.createElement('td');
                            sta.setAttribute('style', "color:white;");

                            ind.textContent = index + 1;
                            cod.textContent = offer.code;
                            sub.textContent = offer.subject;
                            sta.textContent = offer.state;

                            rowData.appendChild(ind);
                            rowData.appendChild(cod);
                            rowData.appendChild(sub);
                            rowData.appendChild(sta);

                            selectedDatesTableBody.appendChild(rowData);
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    }



});