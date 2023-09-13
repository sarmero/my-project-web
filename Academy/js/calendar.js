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
                url: '../services/obtain_pensum.php',
                type: 'POST',
                data:  {program: program} ,
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
        $('#state').html('<option value="">Choose...</option>');
        $('#region').html('<option value="">Choose...</option>');
        $('#subject').html('<option value="">Choose...</option>');
        

        if (semester !== '') {
            $.ajax({
                url: '../services/obtain_state.php',
                type: 'POST',
                data:{ semester: semester },
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
        var reg = $(this).val();
        var pen = $('#pensum').val();
        var sem = $('#semester').val();
        var data = [{ pensum: pen, semester: sem , region: reg}];
       

        // Vaciar la lista de ciudades y barrios
        $('#subject').html('<option value="">Choose...</option>');

        if (reg !== '') {
            $.ajax({
                url: '../services/obtain_subject.php',
                type: 'POST',
                data:{ data: JSON.stringify(data) },
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