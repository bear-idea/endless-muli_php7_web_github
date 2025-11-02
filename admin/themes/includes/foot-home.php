<script src="<?php echo $SiteAdminPath; ?>assets/plugins/freewall/freewall.js"></script>
<script src="<?php echo $SiteAdminPath; ?>assets/plugins/freewall/centering.js"></script>

<script>
    jQuery( document ).ready( function () {
        var wall = new Freewall( "#container_freewall" );
        wall.reset( {
            selector: '.Menu_ListView_Icon_Board',
            animate: true,
            cellW: 116,
            cellH: 116,
            delay: 1,
            onResize: function () {
                wall.fitWidth();
            }
        } );

        wall.fitZone();
        // for scroll bar appear;
        //$(window).trigger("resize");
    } );
</script>

<script type="text/javascript">
    function openKCFinder( textarea ) {
        window.KCFinder = {
            callBackMultiple: function ( files ) {
                window.KCFinder = null;
                textarea.value = "";
                for ( var i = 0; i < files.length; i++ )
                    textarea.value += files[ i ] + "\n";
            }
        };
        window.open( '../ckeditor/kcfinder/browse.php?type=images',
            'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
            'directories=0, resizable=1, scrollbars=0, width=800, height=600'
        );
    }
</script>

<script>
    $(document).ready(function() {
        //App.init();
        //Highlight.init();
        $('#datepicker-inline').datepicker({
            todayHighlight: true
        });
        $(".colorbox_iframe").colorbox({iframe:!0,width:"90%",height:"90%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_small").colorbox({iframe:!0,width:"1000px",height:"80%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_cd").colorbox({iframe:!0,width:"99%",height:"99%",fixed:!0,rel:"nofollow"});$(".youtube").colorbox({iframe:true, innerWidth:900, innerHeight:506});
    });
</script>