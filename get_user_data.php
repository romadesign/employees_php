<?php
include('db/dbconnect.php');
if (isset($_GET['id'])) {
  $id = (int) $_GET['id']; // validar y castear el id como integer

  $sql = "SELECT * FROM users 
          LEFT JOIN user_data ON user_data.user_id = users.id
          WHERE users.id = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $username = htmlspecialchars($row['username']); 
  $cod_scanner = htmlspecialchars($row['cod_scanner']);
  $cod_biometric = htmlspecialchars($row['cod_biometric']);
  $cod_ipmac = htmlspecialchars($row['cod_ipmac']);
  $role = htmlspecialchars($row['role']);
  $verfication = $row["verfication"];
  $data_completed = $row["data_completed"];

  if (isset($_POST['updateadmin']) && $_COOKIE['type_user'] == 'admin') {
    $username = $_POST["username"];
    $role = $_POST["role"];
    $verfication = $_POST["verfication"];
    $data_completed = $_POST["data_completed"];

    $sql = "UPDATE users SET username = ?, role = ?, verfication = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $role, $verfication, $id);
    $stmt->execute();

    //update user_data table
    $sql_user_data = "UPDATE user_data SET data_completed = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql_user_data);
    $stmt->bind_param("si", $data_completed, $id);
    $stmt->execute(); 

    
    // Si la actualización se realizó correctamente
    header("Location: users.php");
    exit(); 
  }

  if (isset($_POST['updatecolaborador']) && $_COOKIE['type_user'] == 'colaborador') {
    $username_c = $_POST["username"];
    $verfication_c = $_POST["verfication"];
    $data_completed_c = $_POST["data_completed"];

    $sql = "UPDATE users SET username = ?, verfication = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username_c, $verfication_c, $id);
    $stmt->execute();

    //update user_data table
    $sql_user_data = "UPDATE user_data SET data_completed = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql_user_data);
    $stmt->bind_param("si", $data_completed_c, $id);
    $stmt->execute();

    
    // Si la actualización se realizó correctamente
    header("Location: users.php");
    exit();
  }

  if (isset($_POST['updateuser']) && $_COOKIE['type_user'] == 'usuario') {
    $username_c = $_POST["username"];
    $cod_scanner = $_POST["cod_scanner"];
    $cod_biometric = $_POST["cod_biometric"];
    $cod_ipmac = $_POST["cod_ipmac"];

    $sql = "UPDATE users SET username = ?, cod_scanner = ?, cod_biometric = ?, cod_ipmac = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username_c, $cod_scanner, $cod_biometric, $cod_ipmac, $id);
    $stmt->execute();


    // Si la actualización se realizó correctamente
    header("Location: users.php");
    exit();
  }
?>
  

  <?php  
  // form para admin
  if ($_COOKIE['type_user'] == 'admin'){?>
    <form id="modal_edit" action="get_user_data.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
      <h5>Edit user <?php echo $username ?></h5>
      <h6>Username</h6>
      <input type='text' id='username' name='username' value='<?php echo $username ?>'>
      <div class="form-floating">
        <h6>Type user</h6>
        <select name="role" id="role" class="form-select" id="floatingSelect" required>
          <option value="<?php echo $role ?>" selected><?php echo $role ?></option>
          <option value="colaborador">colaborador</option>
          <option value="admin">Admin</option>
          <option value="usuario">Usuario</option>
        </select>
      </div>
      <div class="form-floating">
        <h6>Status user</h6>
        <select name="verfication" id="verfication" class="form-select" id="floatingSelect" required>
          <option value="<?php echo $verfication ?>" selected><?php echo $verfication ?></option>
          <option class="btn btn-light" value="white">Sin revisar</option>
          <option class="btn btn-success" value="green">Datos completos</option>
          <option class="btn btn-danger" value="red">Faltan llenar datos</option>
          <option class="btn btn-warning" value="yellow">Faltan llenar datos</option>
        </select>
      </div>
      <div class="form-floating">
        <h6>Status completed</h6>
        <select name="data_completed" id="data_completed" class="form-select" id="floatingSelect" required>
          <option value="<?php echo $data_completed ?>" selected><?php echo $data_completed ?></option>
          <option class="btn btn-success" value="incomplete">Incomplete</option>
          <option class="btn btn-danger" value="complete">Complete</option>
        </select>
      </div>
      <input type="submit" class="btn btn-success" name="updateadmin" value="edit">
      <button type="button" class="btn btn-primary" onclick="hideEditModal()">
        cancel
      </button>
    </form>
 <?php }
  ?>


<?php  
  // form para colaborador
  if ($_COOKIE['type_user'] == 'colaborador'){?>
    <form id="modal_edit" action="get_user_data.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
      <h5>Edit user <?php echo $username ?></h5>
      <h6>Username</h6>
      <input type='text' id='username' name='username' value='<?php echo $username ?>'>
      <div class="form-floating">
        <h6>Status user</h6>
        <select name="verfication" id="verfication" class="form-select" id="floatingSelect" required>
          <option value="<?php echo $verfication ?>" selected><?php echo $verfication ?></option>
          <option class="btn btn-light" value="white">Sin revisar</option>
          <option class="btn btn-success" value="green">Datos completos</option>
          <option class="btn btn-danger" value="red">Faltan llenar datos</option>
          <option class="btn btn-warning" value="yellow">Faltan llenar datos</option>
        </select>
      </div>
      <div class="form-floating">
        <h6>Status completed</h6>
        <select name="data_completed" id="data_completed" class="form-select" id="floatingSelect" required>
          <option value="<?php echo $data_completed ?>" selected><?php echo $data_completed ?></option>
          <option class="btn btn-success" value="incomplete">Incomplete</option>
          <option class="btn btn-danger" value="complete">Complete</option>
        </select>
      </div>
      <input type="submit" class="btn btn-success" name="updatecolaborador" value="edit">
      <button type="button" class="btn btn-primary" onclick="hideEditModal()">
        cancel
      </button>
    </form>
 <?php }
  ?>



<?php  
  // form para colaborador
  if ($_COOKIE['type_user'] == 'usuario'){?>
    <form id="modal_edit" action="get_user_data.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
      <h5>Edit user <?php echo $username ?></h5>
      <h6>Username</h6>
      <input type='text' id='username' name='username' value='<?php echo $username ?>'>
      <h6>Cod scanner</h6>
      <input type='text' id='cod_scanner' name='cod_scanner' value='<?php echo $cod_scanner ?>'>
      <h6>Cod biometric</h6>
      <input type='text' id='cod_biometric' name='cod_biometric' value='<?php echo $cod_biometric ?>'>
      <h6>Cod ip</h6>
      <input type='text' id='cod_ipmac' name='cod_ipmac' value='<?php echo $cod_ipmac ?>'>
      
      <input type="submit" class="btn btn-success" name="updateuser" value="edit">
      <button type="button" class="btn btn-primary" onclick="hideEditModal()">
        cancel
      </button>
    </form>
 <?php }
  ?>


  

<?php } ?>
