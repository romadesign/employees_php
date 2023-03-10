<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>
    <?php 
  if ( isset($_COOKIE["login_status"]) != "" || isset($_COOKIE["login_status"]) == "false") {?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hello word</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li> -->
                </ul>
                <?php
  if ($_COOKIE['type_user'] == 'admin') { ?>
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Create user
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Create New user</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo create_user_adm() ?>" method="post"
                                    enctype="multipart/form-data">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <h6>Username</h6>
                                                <input type="text" class="form-control" name="username"
                                                    placeholder="username:" required>
                                            </div>
                                            <div class="mb-3">
                                                <h6>Password</h6>
                                                <input type="password" class="form-control" name="password"
                                                    id="password">
                                            </div>
                                            <div class="form-floating">
                                                <h6>Type user</h6>
                                                <select name="role" id="role" class="form-select" id="floatingSelect"
                                                    required>
                                                    <option value="usuario" selected>Usuario</option>
                                                    <option value="colaborador">colaborador</option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-floating">
                                            <h6>Status user</h6>
                                            <select name="verfication" id="verfication" class="form-select"
                                                id="floatingSelect" required>
                                                <option class="btn btn-light" value="white" selected>Sin revisar
                                                </option>
                                                <option class="btn btn-success" value="green">Datos completos</option>
                                                <option class="btn btn-danger" value="red">Faltan llenar datos</option>
                                                <option class="btn btn-warning" value="yellow">Faltan llenar datos
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-floating">
                                            <h6>Status completed</h6>
                                            <select name="data_completed" id="data_completed" class="form-select"
                                                id="floatingSelect" required>
                                                <option class="btn btn-light" value="incomplete" selected>Datos
                                                    incompletos</option>
                                                <option class="btn btn-success" value="complete">Datos completos
                                                </option>
                                            </select>
                                        </div>
                                        <div class="d-flex p-2">
                                            <button type="submit" name="createuser"
                                                class="btn btn-sm btn-success w-100"> Create
                                            </button>
                                            <button type="button" class="btn btn-danger  w-100"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <?php } ?>
                <form action="logout.php" method="post" >
                    <button class="btn btn-outline-primary ms-3" type="submit">Log out</button>
                </form>
            </div>
        </div>
    </nav>
    <?php }
  
  ?>