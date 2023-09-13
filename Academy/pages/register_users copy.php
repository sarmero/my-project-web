<?php
session_start();
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

include_once "$root/Academy/commons/db.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academy</title>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/checkout.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main-profile.css">
</head>

<body>
    <br><br>
    <div class="row g-5">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <h4 class="mb-3 text-center">Register user</h4>
            <h4 class="mb-3">information User</h4>
            <form class="needs-validation" novalidate>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Names</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid Name is required.
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Last names</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">code</span>
                            <input type="text" class="form-control" id="username" placeholder="Username" required>
                            <div class="invalid-feedback">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email <span
                                class="text-body-secondary">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" id="department" required>
                            <option value="">Choose...</option>
                            <option>Nariño</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" id="city" required>
                            <option value="">Choose...</option>
                            <option>United States</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>


                </div>

                <hr class="my-4">

                <h4 class="mb-3">information Academy</h4>

                <div class="row g-3">
                    <div class="col-12">
                        <label for="faculty" class="form-label">Faculty</label>
                        <select class="form-select" id="faculty" required>
                            <option value="">Choose...</option>
                            <option>Nariño</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="departments" class="form-label">Department</label>
                        <select class="form-select" id="departments" required>
                            <option value="">Choose...</option>
                            <option>Sistema</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="formation" class="form-label">Formation</label>
                        <select class="form-select" id="formation" required>
                            <option value="">Choose...</option>
                            <option>Pregrado</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>

                    <div class="col-12">
                    <label for="program" class="form-label">Program</label>
                        <select class="form-select" id="program" required>
                            <option value="">Choose...</option>
                            <option>Ingenieria de sistema</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>

                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
                <br><br>
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    <script src="../js/checkout.js"></script>
</body>

</html>