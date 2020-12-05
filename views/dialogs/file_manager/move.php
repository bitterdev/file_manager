<?php
/**
 * @project:   File Manager
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    X.X.X
 */

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Form\Service\Form;
use Concrete\Core\Support\Facade\Application;
use Concrete\Package\FileManager\Controller\Dialog\FileManager\Move;

$app = Application::getFacadeApplication();
/** @var Form $form */
$form = $app->make(Form::class);
/** @var Move $controller */
/** @var string $file */
?>

<form method="post" data-dialog-form="file-manager-move" action="<?php echo $controller->action('move') ?>">
    <?php echo $form->hidden("src", $file); ?>
    <?php echo $form->hidden("dest", null); ?>

    <div id="tree"></div>

    <div class="dialog-buttons">
        <button class="btn btn-default pull-left" data-dialog-action="cancel">
            <?php echo t('Cancel') ?>
        </button>

        <button type="button" data-dialog-action="submit" class="btn btn-primary pull-right">
            <?php echo t('Move') ?>
        </button>
    </div>
</form>

<!--suppress JSUnresolvedVariable -->
<script type="text/javascript">
    (function ($) {
        $(function () {
            $("#tree").fancytree({
                tabindex: null,
                extensions: ["glyph"],
                glyph: {
                    map: {
                        folder: "fa fa-folder",
                        folderOpen: "fa fa-folder-open",
                        doc: "fa fa-file-o",
                        docOpen: "fa fa-file-o",
                        checkbox: "fa fa-square-o",
                        checkboxSelected: "fa fa-check-square-o",
                        checkboxUnknown: "fa fa-share-square",
                        dragHelper: "fa fa-share",
                        dropMarker: "fa fa-angle-right",
                        error: "fa fa-warning",
                        expanderClosed: "fa fa-plus-square-o",
                        expanderLazy: "fa fa-plus-square-o",
                        expanderOpen: "fa fa-minus-square-o",
                        loading: "fa fa-spin fa-refresh"
                    }
                },
                source: {
                    url: "<?php echo $controller->action('get_items') ?>"
                },
                selectMode: 2,
                checkbox: false,
                lazyLoad: function (event, data) {
                    data.result = {
                        url: "<?php echo $controller->action('get_items') ?>",
                        data: {
                            file: data.node.key
                        },
                        cache: false
                    };
                },
                activate: function (event, data) {
                    $("#dest").val(data.node.key);
                }
            });

        });
    })(jQuery);
</script>