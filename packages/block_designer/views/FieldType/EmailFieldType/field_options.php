<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div class="content-field-options">
    <div class="form-group">
        <label for="fields[{{id}}][anchor_field]">
            <input type="checkbox" class="anchor_field" name="fields[{{id}}][anchor_field]" value="1" id="fields[{{id}}][anchor_field]" {{#xif " this.anchor_field == '1' " }}checked="checked"{{/xif}}>
            <?php  echo t("Output email as 'mailto' anchor (i.e.: %s)", '<a href="mailto:the@email.com?subject=The email subject">test@email.com</a>'); ?>
        </label>
    </div>

    <div class="form-group anchor_field-values hidden">
        <div class="form-group">
            <label for="fields[{{id}}][class]" class="control-label">
                <?php  echo t('Class(es)'); ?>
                <small><?php  echo t("Class(es) to be added to your email anchor, i.e. '%s'", 'email-anchor'); ?></small>
            </label>
            <input type="text"
                   name="fields[{{id}}][class]"
                   id="fields[{{id}}][class]"
                   value="{{class}}"
                   data-validation-optional="true"
                   data-validation="custom"
                   data-validation-length="min3"
                   data-validation-regexp="^([a-zA-Z]+)([a-zA-Z-0-9_ ]+)$"
                   class="form-control"/>
        </div>
        <div class="form-group">
            <label for="fields[{{id}}][subject]" class="control-label">
                <?php  echo t('Email subject'); ?>
                <small><?php  echo t('The email subject when sending the email (some applications/email clients may not support this)'); ?></small>
            </label>
            <input type="text"
                   name="fields[{{id}}][subject]"
                   id="fields[{{id}}][subject]"
                   value="{{subject}}"
                   data-validation-optional="true"
                   class="form-control"/>
        </div>
    </div>
</div>