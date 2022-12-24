<div class="large-9 medium-8 columns">
    <?php if ($currentUser) { ?>
    <h1>Welcome</h1>

    <p>Hallo <em><?= $currentUser['username'] ?></em>, glad you're here!</p>

    <?php } ?>
</div>
