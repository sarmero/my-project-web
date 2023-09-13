$(document).ready(function () {
    $('#program').change(function () {
        var program = $(this).val();

        // Vaciar la lista de barrios
        $('#semester').html('<option value="">Choose...</option>');
        $('#region').html('<option value="">Choose...</option>');
        $('#state').html('<option value="">Choose...</option>');

        if (program !== '') {
            $.ajax({
                url: '../services/obtain_semester.php',
                type: 'POST',
                data: { program: program },
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
        var program = $('#program').val();
        var region = $(this).val();
        var semester = $('#semester').val();

        if (region !== '') {
            $.ajax({
                url: '../services/obtain_student.php',
                type: 'POST',
                data: { program: program, semester: semester, region: region },
                dataType: 'json',
                success: function (response) {
                    $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');
                    if (response.length > 0) {
                        ontain_data_table(response);
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error al editar los datos:', error);
                }
            });
        }
    });


    function ontain_data_table(response) {
        const selectedDatesTableBody = document.querySelector('#selectedDatesTableBody');

        $.each(response, function (index, student) {

            const rowData = document.createElement('tr');
            const ind = document.createElement('td');
            ind.setAttribute('style', "color:white;");
            const usr = document.createElement('td');
            usr.setAttribute('style', "color:white;");
            const name = document.createElement('td');
            name.setAttribute('style', "color:white;");
            const last = document.createElement('td');
            last.setAttribute('style', "color:white;");
            const eml = document.createElement('td');
            eml.setAttribute('style', "color:white;");
            const pho = document.createElement('td');
            pho.setAttribute('style', "color:white;");

            ind.textContent = index + 1;
            usr.textContent = student.usrname;
            name.textContent = student.first_name;
            last.textContent = student.last_name;
            eml.textContent = student.email;
            pho.textContent = student.phone;

            rowData.appendChild(ind);
            rowData.appendChild(usr);
            rowData.appendChild(name);
            rowData.appendChild(last);
            rowData.appendChild(eml);
            rowData.appendChild(pho);

            selectedDatesTableBody.appendChild(rowData);
        });
    }





});