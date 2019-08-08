<?php include('views/header.php'); ?>


<h1 class="text-center">Page d'inscription</h1>

<?php if ($error) : ?>
    <span> <?= $error ?> </span>
<?php endif ?>


<form action="" method="post">
    <fieldset>
        <legend>Formulaire d'inscription</legend>

        <!-- <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="email@example.com">
            </div>
        </div> -->

        <div class="form-group">
            <label for="firstName">Prénom</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="votre prénom ..">

        </div>

        <div class="form-group">
            <label for="lastName">Nom</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="votre nom ..">

        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>




        <button type="submit" name="valider" class="btn btn-primary">Submit</button>
    </fieldset>
</form>
<?php include('views/footer.php'); ?>