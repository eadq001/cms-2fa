<?php view('partials/head.php', [
'pageTitle' => 'Home'
]); ?>

<?php view('partials/nav.php'); ?>
 <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
     Hello, <b><?= $username ?></b>.  what's up?
    </div>
  </main>
<?php view('partials/footer.php'); ?>