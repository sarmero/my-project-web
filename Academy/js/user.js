$(document).ready(function () { 
    $('#state').change(function () {
        var state = $(this).val();

        $('#region').html('<option value="">Choose...</option>');

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

    $('#pensum').change(function () {
        var program = $(this).val();

        // Vaciar la lista de barrios
        $('#semester').html('<option value="">Choose...</option>');

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

    $('#program').change(function () {
        var program = $(this).val();

        $('#pensum').html('<option value="">Choose...</option>');

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

});