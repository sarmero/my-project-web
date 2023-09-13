$(document).ready(function () {
    $('#program').change(function () {
        var program = $(this).val();

        // Vaciar la lista de barrios
        $('#pensum').html('<option value="">Choose...</option>');
        $('#semester').html('<option value="">Choose...</option>');
        $('#subject').html('<option value="">Choose...</option>');
        $('#department').html('<option value="">Choose...</option>');


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
        $('#department').html('<option value="">Choose...</option>');



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
        $('#department').html('<option value="">Choose...</option>');
        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');


        if (semester !== '') {
            $.ajax({
                url: '../services/obtain_department.php',
                type: 'POST',
                data: { semester: semester },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#department').html('<option value="">Choose...</option>');
                        console.log(response);
                        $.each(response, function (index, department) {
                            $('#department').append('<option value="' + department.id + '">' + department.departament + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });

            var pensum = $("#pensum").val();
            var program = $("#program").val();
            const selectedDatesTableBody = document.querySelector('#selectedDatesTableBody');


            $.ajax({
                url: '../services/obtain_subject_plan.php',
                type: 'POST',
                data: { semester: semester, program: program, pensum: pensum },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');
                        $.each(response, function (index, subject) {

                            const rowData = document.createElement('tr');
                            const ind = document.createElement('td');
                            ind.setAttribute('style', "color:white;");
                            const sub = document.createElement('td');
                            sub.setAttribute('style', "color:white;");

                            ind.textContent = index+1;
                            sub.textContent = subject.subject;

                            rowData.appendChild(ind);
                            rowData.appendChild(sub);

                            selectedDatesTableBody.appendChild(rowData);
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    $('#department').change(function () {
        var department = $(this).val();

        // Vaciar la lista de ciudades y barrios
        $('#subject').html('<option value="">Choose...</option>');

        if (department !== '') {
            $.ajax({
                url: '../services/obtain_subject_dp.php',
                type: 'POST',
                data: { department: department },
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


});