<?php 
$count = wp_count_posts('directory-item');
$onModeration = getCountFormPending();
?>

<div class="border-[3px] border-blue-400 rounded-md pb-3 pl-2 pr-2 pt-1 mb-6">
    <h3 class="font-bold mb-4 text-lg">Статистика</h3>
    <div class="text-sm">
        <div class="mb-2">
            Сайтів в каталозі: <?=$count->publish;?>
        </div>
        <div>
            Сайтів на модерації: <?=$onModeration;?>
        </div>
    </div>
</div>