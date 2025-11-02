<?php switch($magic_background) {  case "0":  break; case "1": ?>
<?php break; ?>
<?php case "2": ?>
<?php break; ?>
<?php case "3": ?>
<?php break; ?>
<?php case "4": ?>

<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>rotate3Di.min.js" type="text/javascript"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>3d-falling-leaves.min.js" type="text/javascript"></script>


<?php 
$octoberLeavesImage = array("a.png","b.png","c.png","d.png","e.png","f.png","g.png","h.png","i.png","j.png","k.png","l.png","m.png","n.png","o.png");
$octoberLeavesNum = array("4","8","8","8","4","8","8","8","8","8","8","4","4","8","8");
$octoberLeavesSize = array("40","20","20","20","40","20","20","20","20","20","20","40","40","20","20");
$octoberLeavesRotation = array("1","1","1","1","1","1","0","1","0","1","0","1","1","1","1");
?>

<style>
.october-leaf {
position: absolute;
background-color: transparent;
background-image: url('<?php echo $SiteBaseUrl; ?>images/flower/<?php echo $octoberLeavesImage[$magic_flower]; ?>');
-webkit-transform: translateZ(0);
-moz-transform: translateZ(0);
transform: translateZ(0);
}
</style>

<script> 
jQuery(document).octoberLeaves({
leafStyles: <?php echo $octoberLeavesNum[$magic_flower]; ?>,      // Number of leaf styles in the sprite (leaves.png)
speedC: 2,  // Speed of leaves
rotation: <?php echo $octoberLeavesRotation[$magic_flower]; ?>,// Define rotation of leaves
rotationTrue: <?php echo $octoberLeavesRotation[$magic_flower]; ?>,    // Whether leaves rotate (1) or not (0)
numberOfLeaves: 15, // Number of leaves
size: <?php echo $octoberLeavesSize[$magic_flower]; ?>,   // General size of leaves, final size is calculated randomly (with this number as general parameter)
cycleSpeed: 30      // <a href="https://www.jqueryscript.net/animation/">Animation</a> speed (Inverse frames per second) (10-100)
}) 
</script>


<?php break; ?>
<?php case "5": ?>
<?php } ?>
