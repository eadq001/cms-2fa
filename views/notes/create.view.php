<?php view('partials/head.php', [
'pageTitle' => 'Create Notes'
]); ?>
<?php view('partials/nav.php'); ?>
<main>
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    
    <form method="POST" action="/notes/create">

      <div class="col-span-full">
        <label for="body" class="block text-sm/6 font-medium text-gray-900">Description</label>
        <div class="mt-2">
          <textarea id="about" name="body" rows="3"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" style="width:900px;height:250px;"><?=trim($_POST['body'] ?? '') ?></textarea>
        </div>
      </div>

      <?php if (isset(\Core\Session::get('errors')['body'])): ?>
        <p class="text-red-500 text-sm mt-4">
          <?= \Core\Session::get('errors')['body'] ?>
        </p>
      <?php endif ?>


      <div class="mt-6 flex items-center justify-start gap-x-6">
        <button type="submit"
          class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
      </div>
    </form>
</main>

<?php view('partials/footer.php'); ?>
