$(document).ready(function () {
    


    function updateTable() {
        const selectedDatesTableBody = document.querySelector('#selectedDatesTableBody');

        $.ajax({
            url: '../services/obtain_subject_dp_this.php',
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (response) {
                if (response.length > 0) {
                    $('#selectedDatesTableBody').html('<tbody id="selectedDatesTableBody"></tbody>');
                    $.each(response, function (index, subject) {

                        const rowData = document.createElement('tr');
                        const ind = document.createElement('td');
                        ind.setAttribute('style', "color:white;");
                        const cod = document.createElement('td');
                        cod.setAttribute('style', "color:white;");
                        const sub = document.createElement('td');
                        sub.setAttribute('style', "color:white;");

                        ind.textContent = index + 1;
                        cod.textContent = subject.code;
                        sub.textContent = subject.subject;

                        rowData.appendChild(ind);
                        rowData.appendChild(cod);
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

    const saveDelete = document.querySelector('.btn-secondary');
    saveDelete.addEventListener('click', deleteSubject);

    const saveEdit = document.querySelector('.btn-primary');
    saveEdit.addEventListener('click', editSubject);

    function editSubject() {
        const code = document.querySelector('#codeEdit').value;
        const subject = document.querySelector('#newName').value;

        console.log(code+" "+subject)

        if (code !== '') {
            $.ajax({
                url: '../services/update_subject.php',
                type: 'POST',
                data: { code: code, subject: subject  },
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
                    window.location.href = "/Academy/pages/subject_error.php";
                }
            });
        }
    }

    function deleteSubject() {
        const code = document.querySelector('#codeDelete').value;

        if (code !== '') {
            $.ajax({
                url: '../services/delete_subject.php',
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