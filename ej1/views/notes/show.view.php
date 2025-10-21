<?php require __DIR__ . '/../partials/head.php' ?>
<?php require __DIR__.'/../partials/nav.php' ?>
<?php require __DIR__.'/../partials/banner.php' ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p class="mb-6">
                <a href="/notes" class="text-blue-500 hover:underline">go back...</a>
            </p>
            <p><?= htmlspecialchars($note['body']) ?></p>

            <footer class="mt-6">
                <a href="/note/edit?id=<?= $note['id'] ?>" class="text-gray-500 border-current px-4 py-2 rounded">Edit</a>
            </footer>
            <!--<form class="mt-6" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?php /*= $note['id'] */?>">
                <button class="text-sm text-red-500">Delete</button>
            </form>-->
        </div>
    </main>
<?php require __DIR__.'/../partials/footer.php' ?>