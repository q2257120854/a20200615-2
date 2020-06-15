<?php
if (!defined('IN_CRONLITE')) exit();
$classhide = explode(',', $siterow['class']);
?>
<?php
if ($conf['ui_shop'] > 0) { ?>
    <div id="goodTypeContent" <?php if (!isset($_GET['cid'])){ ?>style="display: none"<?php } ?>>
        <input type="hidden" name="cid" id="cid" value="<?php echo empty($invite_row['cid']) ? 0 : $invite_row['cid']; ?>"/>
        <select name="tid" id="tid" hidden onchange="getPoint();">
            <option value="<?php echo empty($invite_row['tid']) ? 0 : $invite_row['cid']; ?>" selected></option>
        </select>
        <div id="inputsname"></div>
        <div id="alert_frame" class="alert alert-success animated rubberBand"
             style="display:none;background: linear-gradient(to right,#71D7A2,#5ED1D7);font-weight: bold;color:white;"></div>
    </div>
    <?php
} else {
    ?>
    <div id="goodTypeContents">
        <input type="hidden" name="cid" id="cid" value="<?php echo empty($invite_row['cid']) ? 0 : $invite_row['cid']; ?>"/>
        <select name="tid" id="tid" hidden onchange="getPoint();">
            <option value="<?php echo empty($invite_row['tid']) ? 0 : $invite_row['cid']; ?>" selected></option>
        </select>
        <div id="inputsname"></div>
        <div id="alert_frame" class="alert alert-success animated rubberBand" style="display:none;background: linear-gradient(to right,#71D7A2,#5ED1D7);font-weight: bold;color:white;"></div>
    </div>
<?php } ?>