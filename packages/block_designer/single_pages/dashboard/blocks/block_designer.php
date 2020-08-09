<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div class="block-designer-container">
    <?php 
    if (isset($errors) && !empty($errors)) {
        ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php 
            foreach ($errors as $errorMessage) {
                echo '<div>' . $errorMessage . '</div>';
            } ?>
        </div>
        <?php 
    } ?>

    <div id="json_fields" data-attr-content="<?php  echo htmlspecialchars(
        json_encode(
            array(
                'fields' => $post_data['fields'],
                'order'  => array_keys((array)$post_data['fields']),
            )
        )
    ); ?>"></div>

    <form action="<?php  echo $this->action(''); ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="row">
                <div class="col-lg-4">
                    <h3><?php  echo t('Block info'); ?></h3>

                    <div class="alert alert-info">
                        <i class="fa fa-info"></i>
                        <?php  echo t('Create a new block type by entering some basic info and adding one or more fields (fields section).'); ?>
                    </div>

                    <div id="horizontalTab" class="hidden">
                        <ul>
                            <li><a href="#tab-basics"><?php  echo t('Basics'); ?></a></li>
                            <li><a href="#tab-interface"><?php  echo t('Interface'); ?></a></li>
                            <li><a href="#tab-advanced"><?php  echo t('Advanced'); ?></a></li>
                        </ul>

                        <div id="tab-basics">
                            <div class="form-group">
                                <label for="block_handle" class="control-label"><?php  echo t('Handle'); ?>
                                    <small><?php  echo t('Lowercase letters and underscores only (without starting/ending with underscores) and a minimum of 3 characters'); ?></small>
                                </label>

                                <?php  echo $form->text('block_handle', $post_data['block_handle'], array('data-validation' => 'custom', 'data-validation-regexp' => '^([a-z]+)([a-z_]+)[a-z]$')); ?>
                            </div>

                            <div class="form-group">
                                <label for="block_name" class="control-label"><?php  echo t('Name'); ?>
                                    <small><?php  echo t('Human-readable name'); ?></small>
                                </label>

                                <?php  echo $form->text('block_name', $post_data['block_name'], array('data-validation' => 'required')); ?>
                            </div>

                            <div class="form-group">
                                <label for="block_description" class="control-label">
                                    <?php  echo t('Description'); ?>
                                </label>

                                <?php  echo $form->textarea('block_description', $post_data['block_description'], array('data-validation' => '', 'rows' => 3)); ?>
                            </div>
                        </div>

                        <div id="tab-interface">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="interface_width" class="control-label"><?php  echo t('Width'); ?>
                                                <small><?php  echo t('Between %s and %s', 400, 1800); ?></small>
                                            </label>

                                            <?php  echo $form->text('interface_width', $post_data['interface_width'], array('data-validation' => 'number', 'data-validation-allowing' => 'range[400;1800]', 'data-validation-optional' => 'true')); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="interface_height"
                                                   class="control-label"><?php  echo t('Height'); ?>
                                                <small><?php  echo t('Between %s and %s', 500, 1000); ?></small>
                                            </label>

                                            <?php  echo $form->text('interface_height', $post_data['interface_height'], array('data-validation' => 'number', 'data-validation-allowing' => 'range[500;1000]', 'data-validation-optional' => 'true')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="block_image" class="control-label">
                                    <?php  echo t('Icon'); ?>
                                    <small><?php  echo t('Ideally a 50x50 pixels image to be used to distinguish this block from others'); ?></small>
                                </label>

                                <input type="file" id="block_image" name="block_image" class="form-control" data-validation="mime" data-validation-allowing="png"/>
                            </div>

                            <div class="form-group">
                                <label for="block_install"><?php  echo t('Direct install'); ?></label>

                                <?php  echo $form->select('block_install', $yesNo, $post_data['block_install'], array()); ?>
                            </div>

                            <div class="form-group" id="form-group-default_set">
                                <label for="default_set" class="control-label">
                                    <?php  echo t('Default block type set'); ?>
                                    <small>
                                        <?php  echo t("Lowercase letters and underscores only. Choose from %s or one of your own set handles.", 'basic, navigation, form, social, multimedia'); ?>
                                    </small>
                                </label>

                                <?php  echo $form->text('default_set', $post_data['default_set'], array('data-validation-regexp' => '^([a-z]+)([a-z_]+)[a-z]$', 'data-validation' => 'custom', 'data-validation-optional' => 'true')); ?>
                            </div>

                            <div class="form-group" id="form-group-block_type_set">
                                <label for="block_type_set"><?php  echo t('Block type set'); ?></label>

                                <?php  echo $form->select('block_type_set', $block_type_sets, $post_data['block_type_set'], array()); ?>
                            </div>
                        </div>

                        <div id="tab-advanced">
                            <div class="alert alert-danger">
                                <i class="fa fa-warning"></i>

                                <?php  echo t('For advanced users only. Default values should be OK for all usages.'); ?>
                            </div>

                            <div class="form-group">
                                <label for="ignore_page_theme_grid_framework_container"><?php  echo t('Ignore Page Theme Grid Framework Container'); ?></label>

                                <?php  echo $form->select('ignore_page_theme_grid_framework_container', $yesNo, $post_data['ignore_page_theme_grid_framework_container'], array()); ?>
                            </div>

                            <div class="form-group">
                                <label for="cache_block_record"><?php  echo t('Cache block record'); ?></label>

                                <?php  echo $form->select('cache_block_record', $yesNo, $post_data['cache_block_record'], array()); ?>
                            </div>

                            <div class="form-group">
                                <label for="cache_block_output"><?php  echo t('Cache block output'); ?></label>

                                <?php  echo $form->select('cache_block_output', $yesNo, $post_data['cache_block_output'], array()); ?>
                            </div>

                            <div class="form-group">
                                <label for="cache_block_output_on_post">
                                    <?php  echo t('Cache block output on post'); ?>
                                </label>

                                <?php  echo $form->select('cache_block_output_on_post', $yesNo, $post_data['cache_block_output_on_post'], array()); ?>
                            </div>

                            <div class="form-group">
                                <label for="cache_block_output_for_registered_users">
                                    <?php  echo t('Cache block output for registered users'); ?>
                                </label>

                                <?php  echo $form->select('cache_block_output_for_registered_users', $yesNo, $post_data['cache_block_output_for_registered_users'], array()); ?>
                            </div>

                            <div class="form-group">
                                <label for="cache_block_output_lifetime">
                                    <?php  echo t('Cache block output lifetime'); ?>
                                </label>

                                <?php  echo $form->text('cache_block_output_lifetime', $post_data['cache_block_output_lifetime'], array('data-validation' => 'number', 'data-validation-allowing' => 'range[0;999999]', 'data-validation-optional' => 'true')); ?>
                            </div>

                            <div class="form-group">
                                <label for="table_prefix" class="control-label"><?php  echo t('Table prefix'); ?>
                                    <small><?php  echo t('Lowercase and uppercase letters only, with a minimum of %s and maximum of %s characters', 2, 15); ?></small>
                                </label>

                                <?php  echo $form->text('table_prefix', $post_data['table_prefix'], array('data-validation-optional' => 'true', 'data-validation' => 'custom', 'data-validation-regexp' => '^[a-zA-Z]{2,15}$')); ?>
                            </div>

                            <div class="form-group">
                                <label for="view_css" class="control-label">
                                    <?php  echo t('View CSS'); ?>
                                </label>

                                <?php  echo $form->textarea('view_css', $post_data['view_css'], array('data-validation' => '', 'rows' => 3)); ?>
                            </div>

                            <div class="form-group">
                                <label for="view_js" class="control-label">
                                    <?php  echo t('View JavaScript'); ?>
                                </label>

                                <?php  echo $form->textarea('view_js', $post_data['view_js'], array('data-validation' => '', 'rows' => 3)); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <script id="contentField" type="text/x-handlebars-template">
                        <div class="content-field" data-id="{{id}}" data-type="{{type}}">
                            <input type="hidden" name="fields[{{id}}][type]" value="{{type}}"/>

                            <div class="header">
                                <span class="collapse-toggle"></span>

                                <a href="#" class="delete" title="<?php  echo t('Delete'); ?>">
                                    <span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>
                                </a>

                                <span>{{{type_name}}} (<?php  echo t('Row'); ?>: #{{id}})</span>

                                <div class="handle"><span></span><span></span><span></span></div>
                            </div>

                            <div class="options">
                                <?php  Loader::packageElement('content_field', $package_handle, array('field_types' => $field_types)); ?>
                            </div>
                        </div>
                    </script>

                    <h3><?php  echo t('Fields'); ?></h3>

                    <div class="content-fields">
                        <div class="alert alert-warning">
                            <i class="fa fa-warning"></i>

                            <?php  echo t('There are no fields added yet. Start adding one by clicking one of the field types below.'); ?>
                        </div>
                    </div>

                    <div class="content-fields-links hidden">
                        <a href="#" class="collapse-all">
                            <i class="fa fa-minus-square"></i>
                            <?php  echo t('Collapse All'); ?>
                        </a>
                        <a href="#" class="expand-all">
                            <i class="fa fa-plus-square"></i>
                            <?php  echo t('Expand All'); ?>
                        </a>
                        <a href="#" class="scroll-to-top">
                            <i class="fa fa-angle-double-up"></i>
                            <?php  echo t('Scroll To Top'); ?>
                        </a>
                    </div>

                    <div id="add-a-field">
                        <h3><?php  echo t('Add a field'); ?></h3>

                        <?php 
                        if (!empty($field_types)) {
                            ?>
                            <ul class="field-types"><?php 
                            foreach ($field_types as $key => $value) {
                                $title = trim($value['description']) != '' ? 'title="' . $value['description'] . '"' : null;
                                $canRepeat = array_key_exists('repeatable', $field_types) && $value['class']->getCanRepeat() === true ? true : false;
                                $useBaseFields = $value['class']->getUseBaseFields() === false ? false : true;
                                $note = method_exists($value['class'], 'getFieldNote') && trim($fieldNote = $value['class']->getFieldNote()) != '' ? ' <i class="fa fa-info" title="' . $fieldNote . '"></i>' : null;
                                echo '<li><a href="#" data-use-base-fields="' . var_export($useBaseFields, true) . '" data-use-can-repeat="' . var_export($canRepeat, true) . '" data-type="' . $key . '" ' . $title . '><span class="icon"><img src="' . $value['icon'] . '" alt="icon" /></span>' . $value['name'] . '</a>' . $note . '</li>';
                            } ?>
                            </ul>
                            <?php 
                        } else {
                            ?>
                            <div class="alert alert-danger">
                                <?php  echo t('There are no field types (yet). Please update your package or <a href="%s" target="_blank">get help</a>.', 'https://www.concrete5.org/marketplace/addons/block-designer/support'); ?>
                            </div>
                            <?php 
                        } ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button class="make-block btn btn-primary btn-block btn-lg" disabled="disabled">
                        <?php  echo t('Make the block!'); ?>
                    </button>

                    <div class="copyright">
                        <?php  echo t('Developed by'); ?>
                        <a href="http://www.devoda.nl/en?ref=<?php  echo $package_handle; ?>" target="_blank">Devoda</a>
                        &copy; <?php  echo date('Y'); ?> - <?php  echo t('Version'); ?> <?php  echo $pkg->getPackageVersion(); ?>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>