<?php view('partials/head.php', [
'pageTitle' => 'Notes'
]); ?>
<?php view('partials/nav.php'); ?>

  <main class = "mt-15">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 ">
      
      <ul>
      <?php foreach ($notes as $note): ?> 
        <li>
          <a href="/note?id=<?= $note['id'] ?>" class="text-blue-700  hover:underline mt-5">
        <?= htmlspecialchars($note['body']) ?>
        </a>
        </li>
        <?php endforeach ?>
        </ul>
        <p class="mt-10">
          <a href="/notes/create" class="text-blue-800 hover:underline">Create Note</a>
        </p>
    </div>
  </main>

<?php view('partials/footer.php'); ?>

