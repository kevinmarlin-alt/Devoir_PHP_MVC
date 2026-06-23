<?php
use App\Core\Banner;

/** @var ?array $banner */
if($banner = Banner::get()) : ?>
    <script src="/assets/javascript/index.js" type="text/javascript" defer></script>
    <div id="banner" class="alert alert-<?= $banner['type'] ?> mt-4">
        <?= htmlspecialchars($banner['message']) ?>
    </div>
<?php endif; ?>