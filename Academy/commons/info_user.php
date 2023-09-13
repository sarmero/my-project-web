<fieldset class="border rounded-3 p-3">
    <legend class="float-none w-auto px-3">Information of User</legend>
    <article class=" blog-post">
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Names</label>
                <input type="text" class="form-control" id="firstName" name="name" placeholder="" value="" required>
                <div class="invalid-feedback">
                    Valid Name is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Last names</label>
                <input type="text" class="form-control" name="last" id="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                    Valid last name is required.
                </div>
            </div>

            <div class="col-sm-7">
                <label for="username" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">code</span>
                    <input type="text" class="form-control" name="usr" id="username" placeholder="Username" required>
                    <div class="invalid-feedback">
                        Your username is required.
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option value="">Choose...</option>
                    <option value="M" selected>Hombre</option>
                    <option value="F" selected>Muger</option>
                </select>
                <div class="invalid-feedback">
                    Please provide a valid gender.
                </div>
            </div>

            <div class="col-sm-8">
                <label for="email" class="form-label">Email </label>
                <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

            <div class="col-sm-4">
                <label for="phone" class="form-label">phone </span></label>
                <input type="phone" class="form-control" name="phone" id="phone" placeholder="3124445566">
                <div class="invalid-feedback">
                    Please enter a valid phone address for shipping updates.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="state" class="form-label">state</label>
                <select class="form-select" name="state" id="state" required>
                    <option value="">Choose...</option>
                    <?php
                    $d = $db->prepare("SELECT * FROM public.states ORDER BY state ASC");

                    $d->execute();
                    $dr = $d->fetchAll();

                    foreach ($dr as $c) {
                        echo '<option value="' . $c['id'] . '">' . $c['state'] . '</option>';
                    }

                    ?>

                </select>
                <div class="invalid-feedback">
                    Please provide a valid state.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="region" class="form-label">Region</label>
                <select class="form-select" name="region" id="region" required>
                    <option value="">Choose...</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid region.
                </div>
            </div>

            <!--<hr class="my-4">-->
        </div>
    </article>
</fieldset>

