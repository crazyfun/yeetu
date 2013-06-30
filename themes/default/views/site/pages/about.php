<h1>About</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <tt><?php echo __FILE__; ?></tt>.</p>
<div id='test'></div>
<script>
    jQuery(document).ready(function(){
        alert(1);
        $("#test").load("http://www.ejee2.com/index.php?r=site/auction");
    });
</script>
