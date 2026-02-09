<?php view('partials/head.php', [
'pageTitle' => 'Edit Note'
]); ?>
<?php view('partials/nav.php'); ?>

<main>
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    
    <form method="POST" action="/note">
      <input type="hidden" value="PATCH" name="_method">
      <input type="hidden" value=<?=$note['id']?> name="id">
      <div class="col-span-full">
        <label for="body" class="block text-sm/6 font-medium text-gray-900">Description</label>
        <div class="mt-2">
          <textarea id="about" name="body" rows="3"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" style="width:900px;height:250px;"><?=trim($note['body'])?></textarea>
        </div>
      </div>

      <?php if (isset($errors['body'])): ?>
        <p class="text-red-500 text-sm mt-4">
          <?= $errors['body'] ?>
        </p>
      <?php endif ?>


      <div class="mt-6 flex items-center justify-end gap-x-6" style="width: 900px;">
        <a href="/notes"
          class="rounded-md bg-gray-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</a>
        <button type="submit"
          class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
      </div>
    </form>
</main>

<?php view('partials/footer.php'); ?>
