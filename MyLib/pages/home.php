<br><br><br>
<?php
$g = '@';
if ($_SESSION['gender'] == 'M') {
    $g = 'o';
} else if ($_SESSION['gender'] == 'F') {
    $g = 'a';
}

echo "<h1>Bienvenid$g " . $_SESSION['user_name'] . " al software</h1>";
?>
<br>
<div class="card-group">


    <div class="card">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/40/Intypedia_-_Biblioteca.png" class="card-img-top"
            alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>
    <div class="card">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/40/Intypedia_-_Biblioteca.png" class="card-img-top"
            alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>
    <div class="card">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/40/Intypedia_-_Biblioteca.png" class="card-img-top"
            alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content. This card has even longer content than the first to show that equal height action.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>
</div>