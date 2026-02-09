
<?php view('partials/head.php', [
'pageTitle' => 'Home'
]); ?>
<?php view('partials/nav.php'); ?>


  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <li>
        <?= '<b>' . htmlspecialchars($note['body'])  . '</b>' . ' by ' . '<i>' . $note['username'] . '</i>'?>
        
        </li>

        <p class="mt-7 text-blue-500 hover:underline">
          <a href="/notes/all" >go back...</a>
        </p>

        <footer class="mt-3" style="display: flex;align-items:start;gap:1rem;">

          <p class="mt-6 text-blue-500 hover:underline" >
           <a href="/notes/edit?id=<?=$note['id']?>">edit</a>
         </p>
  
         <form action="/note" class="mt-6" method="POST">
           <input type="hidden" name="_method" value="DELETE">
           <input type="hidden" name="id" id="" value="<?= $note['id'] ?>">
           <button class="text-sm text-red-500">Delete</button>
         </form>
        </footer>
        
    </div>

  </main>

<?php view('partials/footer.php'); ?>

