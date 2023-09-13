$(document).ready(function () {
    const sendButton = document.querySelector('.btn-primary');
    sendButton.addEventListener('click', send);

    function send() {
        document.getElementById("name").value = "";
        updateTable();
    }


    function updateTable() {
        const selectedDatesTableBody = document.querySelector('#selectedDatesTableBody');

        $.ajax({
            url: '../services/obtain_program.php',
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (response) {
                if (response.length > 0) {
                    $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');
                    $.each(response, function (index, program) {

                        const rowData = document.createElement('tr');
                        const ind = document.createElement('td');
                        ind.setAttribute('style', "color:white;");
                        const cod = document.createElement('td');
                        cod.setAttribute('style', "color:white;");
                        const pro = document.createElement('td');
                        pro.setAttribute('style', "color:white;");

                        ind.textContent = index + 1;
                        cod.textContent = program.code;
                        pro.textContent = program.profession;

                        rowData.appendChild(ind);
                        rowData.appendChild(cod);
                        rowData.appendChild(pro);

                        selectedDatesTableBody.appendChild(rowData);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    }

    const saveDelete = document.querySelector('.btn-secondary');
    saveDelete.addEventListener('click', deleteProgram);

    const saveEdit = document.querySelector('.btn-primary');
    saveEdit.addEventListener('click', editProgram);

    function editProgram() {
        const code = document.querySelector('#codeEdit').value;
        const profession = document.querySelector('#newName').value;

        console.log(code+" "+profession)

        if (code !== '') {
            $.ajax({
                url: '../services/update_program.php',
                type: 'POST',
                data: { code: code, profession: profession  },
                dataType: 'json',
                success: function (response) {
                    alert(response.message);
                    if (response.success === true) {
                        document.getElementById("codeEdit").value = "";
                        document.getElementById("newName").value = "";
                        updateTable();
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error al editar los datos:', error);
                    window.location.href = "/Academy/pages/offer_error.php";
                }
            });
        }
    }

    function deleteProgram() {
        const code = document.querySelector('#codeDelete').value;

        if (code !== '') {
            $.ajax({
                url: '../services/delete_program.php',
                type: 'POST',
                data: { code: code},
                dataType: 'json',
                success: function (response) {
                    alert(response.message);
                    if (response.success === true) {
                        document.getElementById("codeDelete").value = "";
                        updateTable();
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