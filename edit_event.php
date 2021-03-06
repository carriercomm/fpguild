<?php
/**
 * File              : edit_event.php
 * Copyright         : (C) 2015 BlackBlade Software. All Rights Reserved.
 *
 * Last Modified By  : $Author$
 * Last Modified Date: $Date$
 * File Version:     : $Revision$
 *
 * $Id$
 */

$fpg_root_path = "./";
include $fpg_root_path . "includes/funcs.php";
include $fpg_root_path . "includes/write_dkp.php";
include $fpg_root_path . "includes/read_dkp.php";
include $fpg_root_path . "header.php";

if ($request->variable('edit', 0)) {
    $err = edit_event($request->variable('event_id', ''), $request->get_super_global(\phpbb\request\request_interface::POST));

    if (!$err) {
        header("Location: events.php");
        exit;
    }
}

read_event($request->variable('event_id', ''), $event_info);
?>
    <div id="body">
        <div class="header_title">DKP: Edit Event</div>
        <div class="body_style">
            <?php
            if ($err) {
                ?>
                <div class="error">ERROR:&nbsp;<?php echo $err; ?></div>
            <?php
            }
            ?>
            <form action="edit_event.php?event_id=<?php echo $request->variable('event_id', ''); ?>&edit=1" method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="25%" class="text_normal">Event Name</td>
                        <td width="75%" class="text_normal"><input type="text" name="event_name" size="30" maxlength="50" value="<?php echo ($request->variable('edit', 0) ? $request->variable('event_name', '') : $event_info["event_name"]); ?>" /></td>
                    </tr>
                    <tr>
                        <td class="text_normal">Signups</td>
                        <td class="text_normal">
                            <select name="event_no_signup">
                                <option value="0"<?php echo (($request->variable('edit', 0) ? $request->variable('event_no_signup', '') == 0 : $event_info["event_no_signup"] == 0) ? " selected=\"selected\"" : ""); ?>>Disabled</option>
                                <option value="1"<?php echo (($request->variable('edit', 0) ? $request->variable('event_no_signup', '') == 1 : $event_info["event_no_signup"] == 1) ? " selected=\"selected\"" : ""); ?>>Enabled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text_normal">Date/Time</td>
                        <td class="text_normal"><input id="datetime" type="text" name="event_date" size="20" maxlength="20" value="<?php echo date("m/d/Y g:i a", ($request->variable('edit', 0) ? $request->variable('event_date', '') : $event_info["event_date"])); ?>" /></td>
                    </tr>
                    <tr>
                        <td class="text_normal">Date/Time Signups Start</td>
                        <td class="text_normal"><input id="datetimestart" type="text" name="event_signup_start" size="20" maxlength="20" value="<?php echo ($event_info["event_signup_start"] == 0 ? '' : date("m/d/Y g:i a", ($request->variable('edit', 0) ? $request->variable('event_signup_start', '') : $event_info["event_signup_start"]))); ?>" /><br /><span class="text_small">If left blank, signups will be accepted immediately</span></td>
                    </tr>
                    <tr>
                        <td class="text_normal">Date/Time Signups End</td>
                        <td class="text_normal"><input id="datetimeend" type="text" name="event_signup_end" size="20" maxlength="20" value="<?php echo ($event_info["event_signup_end"] == 0 ? '' : date("m/d/Y g:i a", ($request->variable('edit', 0) ? $request->variable('event_signup_end', '') : $event_info["event_signup_end"]))); ?>" /><br /><span class="text_small">If left blank, signups end at the start time of the event</span></td>
                    </tr>
                    <tr>
                        <td class="text_normal">Maximum  Signups</td>
                        <td class="text_normal"><input type="text" name="event_max_signup" size="3" maxlength="3" value="<?php echo ($request->variable('edit', 0) ? $request->variable('event_max_signup', '') : $event_info["event_max_signup"]); ?>" /><br /><span class="text_small">If left at 0 (zero), signups will be unlimited</span></td>
                    </tr>
                    <tr>
                        <td class="text_normal" valign="top">Description</td>
                        <td class="text_normal"><textarea name="event_desc" cols="35" rows="5"><?php echo ($request->variable('edit', 0) ? $request->variable('event_desc', '') : $event_info["event_desc"]); ?></textarea></td>
                    </tr>
                </table>
                <input class="form_button" type="submit" value="Save" />
            </form>
        </div>
    </div>
<?php
include $fpg_root_path . "footer.php";
?>