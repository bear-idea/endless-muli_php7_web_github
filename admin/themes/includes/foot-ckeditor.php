
<?php
    if ($_SESSION['MM_UserGroup'] == 'superadmin') {
        $CKEtoolbar = 'Advanced';
    } else {
        if ($ManageAboutEditorSelect == '1') {
            $CKEtoolbar = 'Full';
        } else if ($ManageAboutEditorSelect == '2') {
            $CKEtoolbar = 'Basic';
        } else {
        }
    }
?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    window.onload = function()
    {
        CKEDITOR.env.isCompatible = true;
        if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
        CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
    };
</script>
