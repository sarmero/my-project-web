$(document).ready(function () {

    $('#event').change(function () {
        var event = $(this).val();

        $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');

        if (event !== '') {
            $.ajax({
                url: '../services/obtain_event.php',
                type: 'POST',
                data: { event: event },
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

        $.each(response, function (index, event) {

            const rowData = document.createElement('tr');
            const ind = document.createElement('td');
            const eve = document.createElement('td');
            const cod = document.createElement('td');

            ind.setAttribute('style', "color:white;");
            cod.setAttribute('style', "color:white;");
            eve.setAttribute('style', "color:white;");

            ind.textContent = index + 1;
            cod.textContent = event.code;
            eve.textContent = event.event;
            
            rowData.appendChild(ind);
            rowData.appendChild(cod);
            rowData.appendChild(eve);

            selectedDatesTableBody.appendChild(rowData);
        });
    }

    const saveDelete = document.querySelector('.btn-secondary');
    saveDelete.addEventListener('click', deleteEvent);

    const saveEdit = document.querySelector('.btn-primary');
    saveEdit.addEventListener('click', editEvent);

    function editEvent() {
        const code = document.querySelector('#codeEdit').value;
        const event = document.querySelector('#newName').value;

        console.log(code+" "+event)

        if (code !== '') {
            $.ajax({
                url: '../services/update_event.php',
                type: 'POST',
                data: { code: code, event: event  },
                dataType: 'json',
                success: function (response) {
                    alert(response.message);
                    if (response.success === true) {
                        document.getElementById("codeEdit").value = "";
                        document.getElementById("newName").value = "";
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error al editar los datos:', error);
                    window.location.href = "/Academy/pages/offer_error.php";
                }
            });
        }
    }

    function deleteEvent() {
        const code = document.querySelector('#codeDelete').value;

        if (code !== '') {
            $.ajax({
                url: '../services/delete_event.php',
                type: 'POST',
                data: { code: code},
                dataType: 'json',
                success: function (response) {
                    alert(response.message);
                    if (response.success === true) {
                        document.getElementById("codeDelete").value = "";
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error al eliminar los datos:', error);
                    window.location.href = "/Academy/pages/offer_error.php";
                }
            });
        }
    }


});