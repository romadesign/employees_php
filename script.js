
function openEditModal (id) {
  var modal = document.getElementById('editmodals')
  // hacer una petición AJAX para obtener los datos del usuario
  var xhttp = new XMLHttpRequest()
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // si se obtienen los datos, cargarlos en el modal
      modal.querySelector('.modal-body').innerHTML = this.responseText
      modal.style.display = 'block'
    }
  }
  xhttp.open('GET', 'get_user_data.php?id=' + id, true)
  xhttp.send()
}

function hideEditModal () {
  var modal = document.getElementById('editmodals')
  modal.style.display = 'none'
}

function hideEditModal () {
  var modal = document.getElementById('editmodals')
  modal.style.display = 'none'
}


function confirmDelete(userId) {
    if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
      // Envía la solicitud de eliminación al servidor utilizando AJAX
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Actualiza la lista de usuarios en la página sin recargarla
          document.getElementById("userList").innerHTML = this.responseText;
        }
      };
      xhttp.open("POST", "delete_user.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("id=" + userId);
      window.location.reload()
    }
  }

 