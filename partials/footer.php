    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/script.js"></script>
    <!-- Flash message delete-->
    <script>
<?php 
if($_SESSION['delete']){
    ?>
swal({
    title: "MERCI",
    text: "Votre élement a été bien supprimé",
    icon: "success",
    button: "Continue!",
});

<?php
unset($_SESSION['delete']);
}
?>
    </script>


    <!-- Flash update delete-->
    <script>
<?php 
if($_SESSION['update']){
    ?>
swal({
    title: "MERCI",
    text: "Votre élement a été bien modifié",
    icon: "success",
    button: "Continue!",
});
<?php
unset($_SESSION['update']);
}
?>
    </script>
    <!-- Flash Send delete-->
    <script>
<?php 
if($_SESSION['send']){
    ?>
swal({
    title: "MERCI",
    text: "Votre demande a bien été envoyé",
    icon: "success",
    button: "Continue!",
});

<?php
unset($_SESSION['send']);
}
?>
    </script>
    </body>

    </html>