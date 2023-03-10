<?php
function create_user_adm()
{
  include('db/dbconnect.php');
  if (isset($_POST['createuser'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $verfication = $_POST["verfication"];
    $data_completed = $_POST["data_completed"];
    $role = $_POST["role"];

    $query = "INSERT INTO users (username, password, role, verfication) 
                  VALUES ('$username', '$password','$role','$verfication')";

    $resultado = mysqli_query($conn, $query);

    $user_id = mysqli_insert_id($conn);

    $queryuserdata = "INSERT INTO user_data (user_id, data_completed) 
                  VALUES ('$user_id', '$data_completed')";

    $result = mysqli_query($conn, $queryuserdata);

    header("Location: ./users.php");
  }
}
?>


<?php
function getUserssadmin()
{
  include('db/dbconnect.php');


  if ($_COOKIE['type_user'] == 'admin'){
    $sql = "SELECT * FROM users LEFT JOIN user_data ON users.id = user_data.user_id";
  }elseif($_COOKIE['type_user'] == 'colaborador'){
    $sql = "SELECT * FROM users LEFT JOIN user_data ON users.id = user_data.user_id 
    WHERE users.role != 'admin';";
  }elseif($_COOKIE['type_user'] == 'usuario'){
    $user_id = $_COOKIE['user_id'];
    $sql = "SELECT * FROM users LEFT JOIN user_data ON users.id = user_data.user_id  WHERE id = $user_id";
  }
  $result = mysqli_query($conn, $sql);

  
?>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#Id</th>
        <th scope="col">Type User</th>
        <th scope="col">Username</th>
        <th scope="col">Status</th>
        <th scope="col">Data complete</th>
        <th scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $username = $row['username'];
        $verfication = $row['verfication'];
        $data_completed =  $row['data_completed'];
        $role = $row['role'];
      ?>
        <tr class="content_data_get">
          <th scope="row"><?php echo $row['id'] ?></th>
          <td><?php echo $role ?></td>
          <td>
            <p class="card-text fst-italic "><?php echo $username ?> </p>
          </td>
          <td>
            <?php
            if ($verfication == 'white') {
              echo '<p class="card-text fst-italic "><button type="button" class="btn btn-light">Sin revisar</button> </p>';
            } elseif ($verfication == 'green') {
              echo '<p class="card-text fst-italic "><button type="button" class="btn btn-success">Datos completos</button> </p>';
            } elseif ($verfication == 'red') {
              echo '<p class="card-text fst-italic "><button type="button" class="btn btn-danger">Faltan llenar datos</button> </p>';
            } elseif ($verfication == 'yellow') {
              echo '<p class="card-text fst-italic "><button type="button" class="btn btn-warning">Faltan llenar datos</button> </p>';
            }
            ?>
          </td>
          <td>
            <?php
              if ($data_completed == NULL) {
                echo ' <p class="card-text fst-italic btn btn-danger"> Incomplete asd </p>';
              } if ($data_completed == 'incomplete') {
                echo ' <p class="card-text fst-italic btn btn-danger"> Incomplete </p>';
              } elseif ($data_completed == 'complete') {
                echo ' <p class="card-text fst-italic btn btn-success"> Complete </p>';
              }
            ?>
          </td>
          <td>
            <?php
            if ($_COOKIE['type_user'] == 'admin') { ?>
             <button type="button" class="btn btn-primary" onclick="openEditModal(<?php echo $id ?>)">
                <i class="fas fa-edit"> </i>
              </button>
              <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo $id ?>)">
                <i class="fas fa-trash"> </i>
              </button>
            <?php } elseif ($_COOKIE['type_user'] == 'colaborador' | $_COOKIE['type_user'] == 'usuario') { ?>
              <button type="button" class="btn btn-primary" onclick="openEditModal(<?php echo $id ?>)">
                <i class="fas fa-edit"> </i>
              </button>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <!-- Modal -->
  <div id="editmodals">
    <div class="modal-body" id="edit_modals_user">
      <!-- Aquí se cargará el formulario de edición -->
    </div>
  </div>
<?php
}
