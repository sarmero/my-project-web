let id;

function openChat(chat) {
  id = chat;

  const nm = document.querySelector('#name');
  const elem = document.createElement('div');

  elem.innerHTML = `
    <h6 style = "color: yellow; font-size:70%;"> </h6>
  `;

  nm.append(elem);
  obtainChat();
}

function obtainChat() {
  $.ajax({
    url: '../services/obtain_message.php',
    method: 'POST',
    data: { id: id },
    dataType: 'json',
    success: function (response) {
      $('#message').html('');
      if (response.length > 0) {
        cargarMessages(response);
      }
    },
    error: function (xhr, status, error) {
      console.log('Error al guardar los datos:', error);
    }
  });
}

function cargarMessages(response) {
  const all = document.querySelector('#message');
  const scroll = document.createElement('div');
  scroll.classList.add('scroller');

  $.each(response, function (index, msg) {
    const message = document.createElement('div');

    if (msg.type === '1') {
      clss = 'message-user';
    } else {
      clss = 'message-response';
    }

    message.innerHTML = `
      <div class="${clss}">
        <div style="display:flex; justify-content:flex-start;">
          <h6 style = "color: white; font-size:70%;"> ${msg.message} </h6>
        </div>
      </div>`;

    scroll.append(message);
  });

  all.append(scroll);

  const res = document.querySelector('#response-chat');

  res.innerHTML = `
    <div style="display:flex; justify-content:start; gap: 5px;">
      <input type="text" class="text-response" id="text" name="res" value placeholder="Escribe tu respuesta...">
      <button class="btn-sm btn-primary btnResponse">Enviar</button>
    </div>
  `;

  const sendButton = document.querySelector('.btn-primary');
  sendButton.addEventListener('click', saveMessage);
}


function saveMessage() {
  const message = document.querySelector('#text').value;
  const type = 0;

  $.ajax({
    url: '../services/save_message.php',
    method: 'POST',
    data: { message: message, id: id, type: type },
    dataType: 'json',
    success: function (response) {
      //alert(response.message);
      if (response.success === true) {
        obtainChat();
        document.getElementById("text").value = "";
      }
    },
    error: function (xhr, status, error) {
      console.log('Error al guardar los datos:', error);
    }
  });
}



