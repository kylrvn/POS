<?php
main_header(['kanban']);

for ($i = 0; $i < 287; $i++) { ?>
    <?=uniqeid_generator()?><br>
<?php
}
main_footer();
?>