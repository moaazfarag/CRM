<?php
$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);

$trans = $environment->getTranslator();
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <ul class="pager">
        <?php
        echo $presenter->getPrevious($trans->trans('main.Last'));
        ?>

        <?php echo $presenter->render(); ?>

        <?php
        echo $presenter->getNext($trans->trans('main.Next'));

        ?>
    </ul>
<?php endif; ?>