let pub;

function dialogPublication() {
  const dialogo = document.getElementById('miDialogo');
  dialogo.showModal();
}

// Función para cerrar la ventana de diálogo
function cerrarDialogo() {
  const dialogo = document.getElementById('miDialogo');
  dialogo.close();
}

const saveButton = document.querySelector('.btn-success');
saveButton.addEventListener('click', saveMessage);

function saveMessage() {
  publication = document.querySelector('#text').textContent;

  $.ajax({
    url: '../services/save_publication.php',
    method: 'POST',
    data: { publication: publication },
    dataType: 'json',
    success: function (response) {
      //alert(response.message);
      if (response.success === true) {
        cerrarDialogo();
        //cargarPublication();
      }
    },
    error: function (xhr, status, error) {
      console.log('Error al guardar los datos:', error);
      //window.location.href = "/Academy/pages/calendar_error.php";
    }
  });
}

function loadComment() {
  comment();
}

function comment() {
  $.ajax({
    url: '../services/obtain_comment.php',
    method: 'POST',
    data: { publication: pub },
    dataType: 'json',
    success: function (response) {
      $('#comment').html('');
      if (response.length > 0) {
        cargarCommnet(response);
      }
    },
    error: function (xhr, status, error) {
      console.log('Error al guardar los datos:', error);
    }
  });
}


const commentButtons = document.querySelectorAll('.comment-button');

commentButtons.forEach(button => {
  button.addEventListener('click', () => {
    const post = button.closest('.post');
    pub = post.getAttribute('id');
    comment();
  });
});

function cargarCommnet(response) {
  const all = document.querySelector('#comment');
  const scroll = document.createElement('scroll-container');

  $.each(response, function (index, com) {
    const comment = document.createElement('div');

    if (com.response !== null) {
      btnRes = ""

      res = `<div class="comment-response">
              <div style="display:flex; justify-content:start; gap: 5px;">
                <h6 style = "color: lightgreen; font-size:70%;"> Departamento: </h6>
                <h6 style = "color: white; font-size:70%; "> ${com.response}</h6>
              </div>
            </div>`
    } else {
      btnRes = `
        <div id="${com.id}" class="response">
          <div style="display:flex; justify-content:start; gap: 5px;">
            <input type="text" class="text-response" id="${com.id}" name="res" value placeholder="Escribe tu respuesta...">
            <button class="btn-sm btn-primary btnResponse">Enviar</button>
          </div>
        </div>
      `;
      res = "";
    }

    comment.innerHTML = `
      <div class="comment-user">
        <div style="display:flex; justify-content:flex-start; gap: 5px;">
          <h6 style = "color: lightgreen; font-size:70%;"> ${com.first_name}: </h6>
          <h6 style = "color: white; font-size:70%;"> ${com.comment} </h6>
        </div>
        ${btnRes}
      </div>
      ${res}
       `;

    scroll.append(comment);
  });

  all.append(scroll);

  const responseButton = document.querySelectorAll('.btnResponse');
  const responseInput = document.querySelectorAll('.text-response');

  responseButton.forEach(button => {

    button.addEventListener('click', () => {
      const post = button.closest('.response');
      const id = post.getAttribute('id');

      let response = "";
      for (let i = 0; i < responseInput.length; i++) {
        if (responseInput[i].getAttribute('id') === id) {
          response = responseInput[i].value;
          break;
        }
      }

      $.ajax({
        url: '../services/update_comment.php',
        method: 'POST',
        data: { id: id, response: response },
        dataType: 'json',
        success: function (response) {
          alert(response.message);
          if (response.success === true) {
            comment();
          }
        },
        error: function (xhr, status, error) {
          console.log('Error al guardar los datos:', error);
        }
      });

    });
  });



}

const likeButtons = document.querySelectorAll('.like-button');

likeButtons.forEach(button => {
  button.addEventListener('click', () => {
    const post = button.closest('.post');
    const postId = post.getAttribute('id');

    if (post.classList.contains('liked')) {
      console.log(`La publicación con ID ${postId} ha sido liked.`);
    } else {
      console.log(`La publicación con ID ${postId} ya no está liked.`);
    }

    post.classList.toggle('liked');

  });
});





