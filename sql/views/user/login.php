<?php include('views/header.php'); ?>


<h1 class="text-center">Page de login</h1>

<?php if ($error) : ?>
    <span> <?= $error ?> </span>
<?php endif ?>


<form action="" method="post">
    <fieldset>
        <legend>Formulaire de login</legend>

        <!-- <div class="form-group row">
           
            
        </div> -->

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>




        <button type="submit" name="valider" class="btn btn-primary">Submit</button>
    </fieldset>
</form>



<?php include('views/footer.php'); ?>