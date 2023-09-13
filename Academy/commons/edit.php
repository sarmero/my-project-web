<div>
    <fieldset class="border rounded-3 p-3">
        <legend class="float-none w-auto px-3">Edit</legend>
        <article class=" blog-post">
            <form class="needs-validation" novalidate>

                <label for="codeEdit" class="form-label">Code:</label>
                <input type="text" class="form-control" name="codeEdit" id="codeEdit" required>
                <div class="invalid-feedback">
                    Please select a valid code.
                </div>
                <br>
                <label for="newName" class="form-label">New name:</label>
                <input type="text" class="form-control" name="newName" id="newName" required>
                <div class="invalid-feedback">
                    Please select a valid name.
                </div>

                <br>
                <button class="w-100 btn btn-primary align-middle" type="button">Edit</button>

            </form>
        </article>
    </fieldset>
</div>