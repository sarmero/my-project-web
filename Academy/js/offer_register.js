$(document).ready(function () {
    $('#xcalendar').change(function () {
        var calendar = $(this).val();

        // Vaciar la lista de ciudades y barrios
        $('#xprogram').html('<option value="">Choose...</option>');
        $('#xpensum').html('<option value="">Choose...</option>');
        $('#xsemester').html('<option value="">Choose...</option>');
        $('#xsubject').html('<option value="">Choose...</option>');
        $('#xstate').html('<option value="">Choose...</option>');
        $('#xregion').html('<option value="">Choose...</option>');

        if (calendar !== '') {
            $.ajax({
                url: '../services/obtain_program.php',
                type: 'POST',
                data: { calendar: calendar },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#xprogram').html('<option value="">Choose...</option>');
                        $.each(response, function (index, program) {
                            $('#xprogram').append('<option value="' + program.id + '">' + program.profession + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    $('#xprogram').change(function () {
        var program = $(this).val();

        // Vaciar la lista de barrios
        $('#xpensum').html('<option value="">Choose...</option>');
        $('#xsemester').html('<option value="">Choose...</option>');
        $('#xsubject').html('<option value="">Choose...</option>');
        $('#xstate').html('<option value="">Choose...</option>');
        $('#xregion').html('<option value="">Choose...</option>');

        if (program !== '') {
            $.ajax({
                url: '../services/obtain_pensum.php',
                type: 'POST',
                data: { program: program },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#xpensum').html('<option value="">Choose...</option>');
                        $.each(response, function (index, pensum) {
                            $('#xpensum').append('<option value="' + pensum.id + '">' + pensum.description + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });


    $('#xpensum').change(function () {
        var pensum = $(this).val();

        // Vaciar la lista de ciudades y barrios
        $('#xsemester').html('<option value="">Choose...</option>');
        $('#xsubject').html('<option value="">Choose...</option>');
        $('#xstate').html('<option value="">Choose...</option>');
        $('#xregion').html('<option value="">Choose...</option>');

        if (pensum !== '') {
            $.ajax({
                url: '../services/obtain_semester.php',
                type: 'POST',
                data: { pensum: pensum },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#xsemester').html('<option value="">Choose...</option>');
                        $.each(response, function (index, semester) {
                            $('#xsemester').append('<option value="' + semester.id + '">' + semester.semester + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });




    $('#xsemester').change(function () {
        var semester = $(this).val();


        // Vaciar la lista de ciudades y barrios
        $('#xstate').html('<option value="">Choose...</option>');
        $('#xregion').html('<option value="">Choose...</option>');
        $('#xsubject').html('<option value="">Choose...</option>');


        if (semester !== '') {
            $.ajax({
                url: '../services/obtain_state.php',
                type: 'POST',
                data: { semester: semester },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#xstate').html('<option value="">Choose...</option>');
                        $.each(response, function (index, state) {
                            $('#xstate').append('<option value="' + state.id + '">' + state.state + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    $('#xstate').change(function () {
        var state = $(this).val();

        $('#xregion').html('<option value="">Choose...</option>');
        $('#xsubject').html('<option value="">Choose...</option>');

        if (state !== '') {
            $.ajax({
                url: '../services/obtain_region.php',
                type: 'POST',
                data: { state: state },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#xregion').html('<option value="">Choose...</option>');
                        $.each(response, function (index, region) {
                            $('#xregion').append('<option value="' + region.id + '">' + region.region + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });


    $('#xregion').change(function () {
        var region = $(this).val();
        var pensum = $("#xpensum").val();
        var program = $("#xprogram").val();
        var semester = $("#xsemester").val();

        // Vaciar la lista de ciudades y barrios
        $('#xsubject').html('<option value="">Choose...</option>');

        if (region !== '') {
            $.ajax({
                url: '../services/obtain_subject_plan.php',
                type: 'POST',
                data: { semester: semester, program: program, pensum: pensum },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#xsubject').html('<option value="">Choose...</option>');
                        $.each(response, function (index, subject) {
                            $('#xsubject').append('<option value="' + subject.id + '">' + subject.subject + '</option>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    const saveButton = document.querySelector('.btn-success');
    saveButton.addEventListener('click', save);

    function save() {
        var calendar = $('#xcalendar').val();
        var pensum = $('#xpensum').val();
        var semester = $('#xsemester').val();
        var subject = $('#xsubject').val();
        var region = $('#xregion').val();

        if (subject !== '') {
            $.ajax({
                url: '../services/save_offer.php',
                type: 'POST',
                data: { semester: semester, calendar: calendar, pensum: pensum, subject: subject, region: region },
                dataType: 'json',
                success: function (response) {
                    console.log(response.message);
                    $('#xprogram').html('<option value="">Choose...</option>');
                    $('#xpensum').html('<option value="">Choose...</option>');
                    $('#xsemester').html('<option value="">Choose...</option>');
                    $('#xsubject').html('<option value="">Choose...</option>');
                    $('#xstate').html('<option value="">Choose...</option>');
                    $('#xregion').html('<option value="">Choose...</option>');
                },
                error: function (xhr, status, error) {
                    console.log('Error al editar los datos:', error);
                    window.location.href = "/Academy/pages/offer_error.php";
                }
            });
        }
    }


});