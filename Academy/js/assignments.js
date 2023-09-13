$(document).ready(function () {
    let id = -1;

    const saveSearch = document.querySelector('.btn-success');
    saveSearch.addEventListener('click', serach);

    const saveSave = document.querySelector('.btn-primary');
    saveSave.addEventListener('click', save);

    function save() {
        var event = $('#event').val();

        if (event !== '' && id !== -1) {
            $.ajax({
                url: '../services/save_assignments.php',
                type: 'POST',
                data: { id: id, event: event },
                dataType: 'json',
                success: function (response) {
                    
                    alert(response.message);
                    if (response.success === true) {
                        document.getElementById("firstName").value = "";
                        $('#data').html('');
                        $('#event').html('<option value="">Choose...</option>');
                        $('#type').html('<option value="">Choose...</option>');
                        id = -1;
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function serach() {
        const code = document.querySelector('#firstName').value;

        if (code !== '') {
            $.ajax({
                url: '../services/obtain_student_code.php',
                type: 'POST',
                data: { code: code },
                dataType: 'json',
                success: function (response) {
                    $('#data').html('');

                    if (response.length > 0) {

                        $.each(response, function (index, student) {

                            id = student.id;
                            const data = document.querySelector('#data');

                            data.innerHTML = `
                                <div class="col-3">
                                    <h5>${student.first_name}</h5>
                                </div>
                                <div class="col-3">
                                    <h5>${student.last_name}</h5>
                                </div>
                                <div class="col-2">
                                    <h5>${student.semester}</h5>
                                </div>
                                <div class="col-4">
                                    <h5>${student.profession}</h5>
                                </div>`
                                ;

                            event();
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error al buscar estudiante:', error);
                    window.location.href = "/Academy/pages/student_error.php";
                }
            });
        }
    }

    function event() {

        $('#event').html('<option value="">Choose...</option>');
        $('#type').html('<option value="">Choose...</option>');

        $.ajax({
            url: '../services/obtain_event_type.php',
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (response) {
                if (response.length > 0) {
                    $('#type').html('<option value="">Choose...</option>');
                    $.each(response, function (index, event) {
                        $('#type').append('<option value="' + event.id + '">' + event.event + '</option>');
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    }


    $('#type').change(function () {
        var event = $(this).val();

        $('#event').html('<option value="">Choose...</option>');

        if (event !== '') {
            $.ajax({
                url: '../services/obtain_event.php',
                type: 'POST',
                data: { event: event },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        $('#event').html('<option value="">Choose...</option>');
                        $.each(response, function (index, event) {
                            $('#event').append('<option value="' + event.id + '">' + event.event + '</option>');
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