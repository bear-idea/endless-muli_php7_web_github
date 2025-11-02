<?php
push_script($scripts, '<script src="' . $SiteBaseUrl . 'ckeditor/ckeditor.js"></script>');
push_script($scripts, " <script type='text/javascript'> window.onload = function() { CKEDITOR.env.isCompatible = true; if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); } CKEDITOR.replace('content', { width: '100%', toolbar: 'Full' }); }; </script> ");

